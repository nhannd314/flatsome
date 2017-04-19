<?php

/* Check if support is expired */
function flatsome_is_support_expired($slug){

  $date = date('m/d/Y h:i:s a', time());

  if(strtotime($date) > strtotime(get_option( $slug . '_wup_supported_until', '' ))){
    return true;
  }
}

/* Check if theme is enabled */
function flatsome_is_theme_enabled(){
  $slug = basename( get_template_directory() );
  $purchase_code = sanitize_text_field( get_option( $slug . '_wup_purchase_code', '' ) );
  if($purchase_code){
    return true;
  }
}

/* Automagical updates */
function wupdates_check_JQ9eJ( $transient ) {
  // Nothing to do here if the checked transient entry is empty
  if ( empty( $transient->checked ) ) {
    return $transient;
  }

  // Let's start gathering data about the theme
  // First get the theme directory name (the theme slug - unique)
  $slug = basename( get_template_directory() );
  // Then WordPress version
  include( ABSPATH . WPINC . '/version.php' );
  $http_args = array (
    'body' => array(
      'slug' => $slug,
      'url' => home_url(), //the site's home URL
      'version' => 0,
      'locale' => get_locale(),
      'phpv' => phpversion(),
      'child_theme' => is_child_theme(),
      'data' => null, //no optional data is sent by default
    ),
    'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url()
  );

  // If the theme has been checked for updates before, get the checked version
  if ( isset( $transient->checked[ $slug ] ) && $transient->checked[ $slug ] ) {
    $http_args['body']['version'] = $transient->checked[ $slug ];
  }

  // Use this filter to add optional data to send
  // Make sure you return an associative array - do not encode it in any way
  $optional_data = apply_filters( 'wupdates_call_data_request', $http_args['body']['data'], $slug, $http_args['body']['version'] );

  // Encrypting optional data with private key, just to keep your data a little safer
  // You should not edit the code bellow
  $optional_data = json_encode( $optional_data );
  $w=array();$re="";$s=array();$sa=md5('9bbe8289465e1493f734035eb68388eff8573724');
  $l=strlen($sa);$d=$optional_data;$ii=-1;
  while(++$ii<256){$w[$ii]=ord(substr($sa,(($ii%$l)+1),1));$s[$ii]=$ii;} $ii=-1;$j=0;
  while(++$ii<256){$j=($j+$w[$ii]+$s[$ii])%255;$t=$s[$j];$s[$ii]=$s[$j];$s[$j]=$t;}
  $l=strlen($d);$ii=-1;$j=0;$k=0;
  while(++$ii<$l){$j=($j+1)%256;$k=($k+$s[$j])%255;$t=$w[$j];$s[$j]=$s[$k];$s[$k]=$t;
  $x=$s[(($s[$j]+$s[$k])%255)];$re.=chr(ord($d[$ii])^$x);}
  $optional_data=bin2hex($re);

  // Save the encrypted optional data so it can be sent to the updates server
  $http_args['body']['data'] = $optional_data;

  // Check for an available update
  $url = $http_url = set_url_scheme( 'https://wupdates.com/wp-json/wup/v1/themes/check_version/JQ9eJ', 'http' );
  if ( $ssl = wp_http_supports( array( 'ssl' ) ) ) {
    $url = set_url_scheme( $url, 'https' );
  }

  $raw_response = wp_remote_post( $url, $http_args );
  if ( $ssl && is_wp_error( $raw_response ) ) {
    $raw_response = wp_remote_post( $http_url, $http_args );
  }
  // We stop in case we haven't received a proper response
  if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
    return $transient;
  }

  $response = (array) json_decode($raw_response['body']);
  if ( ! empty( $response ) ) {
    // You can use this action to show notifications or take other action
    do_action( 'wupdates_before_response', $response, $transient );
    if ( isset( $response['allow_update'] ) && $response['allow_update'] && isset( $response['transient'] ) ) {
      $transient->response[ $slug ] = (array) $response['transient'];
    }
    do_action( 'wupdates_after_response', $response, $transient );
  }

  return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'wupdates_check_JQ9eJ' );

/* Only allow theme updates with a valid Envato purchase code */
function wupdates_add_purchase_code_field_JQ9eJ( $themes ) {
  $output = '';
  // First get the theme directory name (the theme slug - unique)
  $slug = basename( get_template_directory() );
  if ( ! is_multisite() && isset( $themes[ $slug ] ) ) {
    $output .= "<br/><br/>"; //put a little space above

    //get errors so we can show them
    $errors = get_option( strtolower( $slug ) . '_wup_errors', array() );
    delete_option( strtolower( $slug ) . '_wup_errors' ); //delete existing errors as we will handle them next

    //check if we have a purchase code saved already
    $purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
    //in case there is an update available, tell the user that it needs a valid purchase code
    if ( empty( $purchase_code ) && ! empty( $themes[ $slug ]['hasUpdate'] ) ) {
      $output .= '<div class="notice notice-error notice-alt notice-large">' . __( 'A <strong>valid purchase code</strong> is required for automatic updates.', 'wupdates' ) . '</div>';
    }
    //output errors and notifications
    if ( ! empty( $errors ) ) {
      foreach ( $errors as $key => $error ) {
        $output .= '<div class="error"><p>' . wp_kses_post( $error ) . '</p></div>';
      }
    }
    if ( ! empty( $purchase_code ) ) {
      if ( ! empty( $errors ) ) {
        //since there is already a purchase code present - notify the user
        $output .= '<div class="notice notice-warning notice-alt"><p>' . esc_html__( 'Purchase code not updated. We will keep the existing one.', 'wupdates' ) . '</p></div>';
      } else {
        //this means a valid purchase code is present and no errors were found
        $output .= '<div class="notice notice-success notice-alt notice-large">' . __( 'Your <strong>purchase code is valid</strong>. Thank you! Enjoy one-click automatic updates.', 'wupdates' ) . '</div>';
      }
    }
    $purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
    $output .= '<form class="wupdates_purchase_code" action="" method="post">' .
      '<input type="hidden" name="wupdates_pc_theme" value="' . esc_attr( $slug ) . '" />' .
      '<input type="text" id="' . $purchase_code_key . '" name="' . $purchase_code_key . '"
              value="' . esc_attr( $purchase_code ) . '" placeholder="' . esc_html__( 'Purchase code ( e.g. 9g2b13fa-10aa-2267-883a-9201a94cf9b5 )', 'wupdates' ) . '" style="width:100%"/>' .
      '<p>' . __( 'Enter your purchase code and <strong>hit return/enter</strong>.', 'wupdates' ) . '</p>' .
      '<p class="theme-description">' .
        __( 'Find out how to <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">get your purchase code</a>.', 'wupdates' ) .
        '</p>
      </form>';
  }
  //finally put the markup after the theme tags
  if ( ! isset( $themes[ $slug ]['tags'] ) ) {
    $themes[ $slug ]['tags'] = '';
  }
  $themes[ $slug ]['tags'] .= $output;

  return $themes;
}
add_filter( 'wp_prepare_themes_for_js' ,'wupdates_add_purchase_code_field_JQ9eJ' );

/* Handle the purchase code input for multisite installations */
function wupdates_ms_theme_list_purchase_code_field_JQ9eJ( $theme, $r ) {
  $output = '<br/>';
  $slug = $theme->get_template();
  //get errors so we can show them
  $errors = get_option( strtolower( $slug ) . '_wup_errors', array() );
  delete_option( strtolower( $slug ) . '_wup_errors' ); //delete existing errors as we will handle them next

  //check if we have a purchase code saved already
  $purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
  //in case there is an update available, tell the user that it needs a valid purchase code
  if ( empty( $purchase_code ) ) {
    $output .=  '<p>' . __( 'A <strong>valid purchase code</strong> is required for automatic updates.', 'wupdates' ) . '</p>';
  }
  //output errors and notifications
  if ( ! empty( $errors ) ) {
    foreach ( $errors as $key => $error ) {
      $output .= '<div class="error"><p>' . wp_kses_post( $error ) . '</p></div>';
    }
  }
  if ( ! empty( $purchase_code ) ) {
    if ( ! empty( $errors ) ) {
      //since there is already a purchase code present - notify the user
      $output .= '<p>' . esc_html__( 'Purchase code not updated. We will keep the existing one.', 'wupdates' ) . '</p>';
    } else {
      //this means a valid purchase code is present and no errors were found
      $output .= '<p><span class="notice notice-success notice-alt">' . __( 'Your <strong>purchase code is valid</strong>. Thank you! Enjoy one-click automatic updates.', 'wupdates' ) . '</span></p>';
    }
  }
  $purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
  $output .= '<form class="wupdates_purchase_code" action="" method="post">' .
    '<input type="hidden" name="wupdates_pc_theme" value="' . esc_attr( $slug ) . '" />' .
    '<input type="text" id="' . $purchase_code_key . '" name="' . $purchase_code_key . '"
            value="' . esc_attr( $purchase_code ) . '" placeholder="' . esc_html__( 'Purchase code ( e.g. 9g2b13fa-10aa-2267-883a-9201a94cf9b5 )', 'wupdates' ) . '"/>' . ' ' .
    __( 'Enter your purchase code and <strong>hit return/enter</strong>.', 'wupdates' ) . ' ' .
    __( 'Find out how to <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">get your purchase code</a>.', 'wupdates' ) .
    '</form>';

  echo $output;
}
add_action( 'in_theme_update_message-' . basename( get_template_directory() ), 'wupdates_ms_theme_list_purchase_code_field_JQ9eJ', 10, 2 );

function wupdates_purchase_code_needed_notice_JQ9eJ() {
  global $current_screen;

  $output = '';
  $slug = basename( get_template_directory() );
  //check if we have a purchase code saved already
  $purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );
  //if the purchase code doesn't pass the prevalidation, show notice
  if ( in_array( $current_screen->id, array( 'update-core', 'update-core-network') ) && true !== wupdates_prevalidate_purchase_code_JQ9eJ( $purchase_code ) ) {
    $output .= '<div class="updated"><p>' . sprintf( __( '<a href="%s">Please enter your purchase code</a> to activate Flatsome and get automatic updates.', 'wupdates' ), network_admin_url( 'admin.php?page=flatsome-panel' ) ) . '</p></div>';
  }

  echo $output;
}
add_action( 'admin_notices', 'wupdates_purchase_code_needed_notice_JQ9eJ' );
add_action( 'network_admin_notices', 'wupdates_purchase_code_needed_notice_JQ9eJ' );

function wupdates_process_purchase_code_JQ9eJ() {
  //in case the user has submitted the purchase code form
  if ( ! empty( $_POST['wupdates_pc_theme'] ) ) {
    $errors = array();
    $slug = sanitize_text_field( $_POST['wupdates_pc_theme'] ); // get the theme's slug
    //PHP doesn't allow dots or spaces in $_POST keys - it converts them into underscore; so we do also
    $purchase_code_key = esc_attr( strtolower( str_replace( array(' ', '.'), '_', $slug ) ) ) . '_wup_purchase_code';
    $purchase_code = false;
    if ( ! empty( $_POST[ $purchase_code_key ] ) ) {
      //get the submitted purchase code and sanitize it
      $purchase_code = sanitize_text_field( $_POST[ $purchase_code_key ] );
      //do a prevalidation; no need to make the API call if the format is not right
      if ( true !== wupdates_prevalidate_purchase_code_JQ9eJ( $purchase_code ) ) {
        $purchase_code = false;
      }
    }
    if ( ! empty( $purchase_code ) ) {
      //check if this purchase code represents a sale of the theme
      $http_args = array (
        'body' => array(
          'slug' => $slug, //the theme's slug
          'url' => home_url(), //the site's home URL
          'purchase_code' => $purchase_code,
        )
      );

      //make sure that we use a protocol that this hosting is capable of
      $url = $http_url = set_url_scheme( 'https://wupdates.com/wp-json/wup/v1/front/check_envato_purchase_code/JQ9eJ', 'http' );
      if ( $ssl = wp_http_supports( array( 'ssl' ) ) ) {
        $url = set_url_scheme( $url, 'https' );
      }
      //make the call to the purchase code check API
      $raw_response = wp_remote_post( $url, $http_args );
      if ( $ssl && is_wp_error( $raw_response ) ) {
        $raw_response = wp_remote_post( $http_url, $http_args );
      }
      // In case the server hasn't responded properly, show error
      if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
        $errors[] = __( 'We are sorry but we couldn\'t connect to the verification server. Please try again later.', 'wupdates' ) . '<span class="hidden">' . print_r( $raw_response, true ) . '</span>';
      } else {
        $response = json_decode( $raw_response['body'], true );
        if ( ! empty( $response ) ) {
          //we will only update the purchase code if it's valid
          //this way we keep existing valid purchase codes
          if ( isset( $response['purchase_code'] ) && 'valid' == $response['purchase_code'] ) {


            //all is good, update the purchase code option
            update_option( strtolower( $slug ) . '_wup_purchase_code', $purchase_code );

            // Sold at
            update_option( strtolower( $slug ) . '_wup_sold_at', $response['raw_response']['sold_at'] );

            // Supported until
            update_option( strtolower( $slug ) . '_wup_supported_until', $response['raw_response']['supported_until'] );

            // Buyer
            update_option( strtolower( $slug ) . '_wup_buyer', $response['raw_response']['buyer'] );

            //delete the update_themes transient so we force a recheck
            set_site_transient('update_themes', null);
          } else {
            if ( isset( $response['reason'] ) && ! empty( $response['reason'] ) && 'out_of_support' == $response['reason'] ) {
              $errors[] = esc_html__( 'Your purchase\'s support period has ended. Please extend it to receive automatic updates.', 'wupdates' );
            } else {
              $errors[] = esc_html__( 'Could not find a sale with this purchase code. Please double check.', 'wupdates' );
            }
          }
        }
      }
    } else {
      //in case the user hasn't entered a valid purchase code
      $errors[] = esc_html__( 'Please enter a valid purchase code. Make sure to get all the characters.', 'wupdates' );
    }

    if ( count( $errors ) > 0 ) {
      //if we do have errors, save them in the database so we can display them to the user
      update_option( strtolower( $slug ) . '_wup_errors', $errors );
    } else {
      //since there are no errors, delete the option
      delete_option( strtolower( $slug ) . '_wup_errors' );
    }

    //redirect back to the themes page and open popup
    wp_redirect( esc_url_raw( add_query_arg( 'theme', $slug ) ) );
    exit;
  }
}
add_action( 'admin_init', 'wupdates_process_purchase_code_JQ9eJ' );

function wupdates_send_purchase_code_JQ9eJ( $optional_data, $slug ) {
  //get the saved purchase code
  $purchase_code = sanitize_text_field( get_option( strtolower( $slug ) . '_wup_purchase_code', '' ) );

  if ( null === $optional_data ) { //if there is no optional data, initialize it
    $optional_data = array();
  }
  //add the purchase code to the optional_data so we can check it upon update check
  //if a theme has an Envato item selected, this is mandatory
  $optional_data['envato_purchase_code'] = $purchase_code;

  return $optional_data;
}
add_filter( 'wupdates_call_data_request', 'wupdates_send_purchase_code_JQ9eJ', 10, 2 );

function wupdates_prevalidate_purchase_code_JQ9eJ( $purchase_code ) {
  $purchase_code = preg_replace( '#([a-z0-9]{8})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{12})#', '$1-$2-$3-$4-$5', strtolower( $purchase_code ) );
  if ( 36 == strlen( $purchase_code ) ) {
    return true;
  }
  return false;
}

/* End of Envato checkup code */