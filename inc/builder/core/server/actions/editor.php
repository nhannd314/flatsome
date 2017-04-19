<?php

$priority = 1000;

add_action( 'init', function () {
  remove_action( 'init', 'ckeditor_init' ); // ckeditor is not supported
}, -$priority );

/**
* Render editor template.
*
* @param string $page_template
*/
add_action( 'current_screen', function ( $page_template ) {
  $post_types = get_ux_builder_post_types();
  $post = ux_builder('editing-post')->post();

  // Render template for registered post types only.
  if ( array_key_exists( $post->post_type, $post_types ) ) {
    ux_builder_render( 'editor-' . ux_builder_mode() ); die;
  }

  wp_die( "The <em>$post->post_type</em> post type is not available for UX Builder." );
} );

/**
 * Modify the language attributes. Force ltr text direction.
 */
add_filter( 'language_attributes', function ( $output, $doctype ) {
  return str_replace( 'dir="rtl"', 'dir="ltr"', $output );
}, $priority, 2 );

/**
* Remove unwanted actions and assets in the «admin_enqueue_scripts»
* then enqueue scripts for the builder.
*/
add_action( 'admin_enqueue_scripts', function () {
  // remove unwanted styles and scripts here
  wp_dequeue_style( 'woocommerce_admin_menu_styles' );
  wp_dequeue_style( 'woocommerce_admin_styles' );
  wp_dequeue_script( 'woocommerce_settings' );

//   _ux_builder_filter_scripts();
//   _ux_builder_filter_styles();
//   _ux_builder_keep_actions( 'admin_enqueue_scripts', array(
//     'wp_auth_check_load',
//     'ux_builder_enqueue_scripts',
//   ) );
   do_action( 'ux_builder_enqueue_scripts', 'editor' );
}, $priority );

/**
 * Removes unwanted actions and assets in the «admin_print_scripts» action.
 */
// add_action( 'admin_print_scripts', function () {
//   _ux_builder_filter_scripts();
//   _ux_builder_filter_styles();
//   _ux_builder_keep_actions( 'admin_print_scripts', array(
//     'print_head_scripts',
//   ) );
// }, $priority );

/**
 * Removes unwanted actions and assets in the «admin_print_scripts» action.
 */
// add_action( 'admin_print_styles', function () {
//   _ux_builder_filter_scripts();
//   _ux_builder_filter_styles();
//   _ux_builder_keep_actions( 'admin_print_styles', array(
//     'print_admin_styles',
//   ) );
// }, $priority );

/**
 * Removes unwanted actions and assets in the «admin_head» action.
 */
// add_action( 'admin_head', function () {
//   _ux_builder_filter_scripts();
//   _ux_builder_filter_styles();
//   _ux_builder_keep_actions( 'admin_head', array(
//     '_wp_render_title_tag',
//     'wp_enqueue_scripts',
//     'wp_print_styles',
//     'wp_print_head_scripts',
//     'ux_builder_enqueue_scripts',
//   ) );
// }, $priority );

/**
 * Removes unwanted actions and assets in the «admin_footer» action.
 */
add_action( 'admin_footer', function () {
  // _ux_builder_filter_scripts();
  // _ux_builder_filter_styles();
  // _ux_builder_keep_actions( 'admin_footer', array(
  //   'wp_print_footer_scripts',
  // ) );

  // Add media modal
  // wp_print_media_templates();

}, -$priority );


/**
 * Removes unwanted actions and assets in
 * the «admin_print_footer_scripts» action.
 * Then prints all builder data.
 */
add_action( 'admin_print_footer_scripts', function () {
  // _ux_builder_filter_scripts();
  // _ux_builder_filter_styles();
  // _ux_builder_keep_actions( 'admin_print_footer_scripts', array(
  //   '_wp_footer_scripts',
  //   '_WP_Editors::enqueue_scripts',
  //   '_WP_Editors::editor_js',
  // ) );

  $current_post = ux_builder( 'current-post' );
  $editing_post = ux_builder( 'editing-post' );
  $post_id = $editing_post->post()->ID;
  $post_status = $editing_post->post()->post_status;
  $can_edit = current_user_can( 'edit_post', $post_id );
  $can_publish = current_user_can( 'publish_post', $post_id );

  // Get the back URL. Redirect to admin page if user came
  // from admin or to the post if user came from some other place.
  $back_url = isset( $_SERVER['HTTP_REFERER'] )
    ? $_SERVER['HTTP_REFERER']
    : $current_post->permalink();

  // Go back to admin edit screen if not published.
  if ( $editing_post->post()->post_status != 'publish' &&
    strpos( $back_url, 'preview=true' ) == false) {
    $back_url = admin_url( 'post.php?post=' . $editing_post->post()->ID . '&action=edit' );
  }

  if ( $can_publish ) {
    $save_button = $post_status != 'publish'
      ? __( 'Publish', 'wordpress' )
      : __( 'Update', 'wordpress' );
  } else {
    $save_button = $post_status == 'pending'
      ? __( 'Submit for Review', 'wordpress' )
      : __( 'Save draft', 'wordpress' );
  }

  $data = apply_filters( 'ux_builder_data', array(
    'loading' => true,
    'initialized' => false,
    'nonce' => wp_create_nonce( 'ux-builder-' . $editing_post->post()->ID ),
    'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    'iframeUrl' => ux_builder_iframe_url(),
    'backUrl' => $back_url,
    'editUrl' => $current_post->editlink(),
    'postUrl' => $current_post->permalink(),
    'post' => $editing_post->to_array(),
    'saveButton' => $save_button,
    'showSidebar' => true,
    'breakpoints' => array(
      'current' => get_default_ux_builder_breakpoint(),
      'default' => get_default_ux_builder_breakpoint(),
      'all' => get_ux_builder_breakpoints(),
    ),
    'permissions' => array(
      'exit' => true,
      'edit' => true,
      'save' => true,
      'upload' => true,
    ),
    'clipboard' => array(
      'options' => (object) array(),
      'shortcode' => (object) array(),
    ),
    'shortcodes' => ux_builder( 'elements' )->to_array(),
    'modules' => apply_filters( 'ux_builder_modules', array() ),
    'shortcode' => (object) array(),
    'states' => (object) array(),
    'tools' => (object) array(),
    'cache' => (object) array(),
    'actions' => array(),
    'targets' => array(),
    '$$events' => (object) array(),
    '$$filters' => (object) array(),
    '$$actions' => (object) array(),
  ) );

  // Get templates for current post type.
  $data['templates'] = array_filter( ux_builder( 'templates' )->to_array(), function ( $template ) {
    return in_array( ux_builder( 'editing-post' )->post()->post_type, $template['post_types'] );
  } );

  echo '<script id="ux-builder-data" type="text/javascript">';
  echo 'var uxBuilderData = ' . json_encode( $data ) . ';';
  echo '</script>';
}, -$priority );

/**
* Add buttons to TinyMCE editor.
*/
add_action( 'media_buttons', function () {
  echo '<button type="button" ng-click="$ctrl.hide()" class="button button-primary"><span class="dashicons dashicons-yes"></span>OK</button>';
  echo '<button type="button" ng-click="$ctrl.discard()" class="button"><span class="dashicons dashicons-no-alt"></span>Cancel</button>';
  echo '<span class="separator"></span>';
}, 0 );

/**
 * Enqueue scripts and styles.
 */
add_action( 'ux_builder_enqueue_scripts', function ( $context ) {
  $version = UX_BUILDER_VERSION;
  wp_enqueue_media();
  //wp_enqueue_style( 'wp-admin' );
  wp_enqueue_style( 'dashicons' );
  wp_enqueue_style( 'forms' );
  wp_enqueue_style( 'buttons' );
  wp_enqueue_style( 'jquery-sortable' );
  // wp_enqueue_script('editor');
  wp_enqueue_script( 'ux-builder-vendors', ux_builder_asset( 'js/builder/core/vendors.js' ), null, $version, true );
  wp_enqueue_style( 'ux-builder-core', ux_builder_asset( 'css/builder/core/editor.css' ), null, $version );
  wp_enqueue_script( 'ux-builder-core', ux_builder_asset( 'js/builder/core/editor.js' ), null, $version, true );
}, 0 );

function _ux_builder_keep_actions( $name, $keep_array ) {
  global $wp_filter;
  foreach ( $wp_filter[$name] as $priority => $actions ) {
    foreach ( $actions as $function => $action ) {
      $check_name = is_array( $action['function'] ) && is_object( $action['function'][0] )
        ? get_class( $action['function'][0] ) . '::' . $action['function'][1]
        : $function;
      if ( ! in_array( $check_name, $keep_array ) ) {
        // $wp_filter[$name] is an instance of ArrayAccess after WordPress 4.7.
        if ( $wp_filter[$name] instanceof ArrayAccess ) {
          unset( $wp_filter[$name]->callbacks[$priority][$function] );
        } else {
          unset( $wp_filter[$name][$priority][$function] );
        }
      }
    }
  }
};

function _ux_builder_filter_scripts() {
  $wp_scripts = wp_scripts();
  $keep_scripts = array(
    'media-editor',
    'media-audiovideo',
    'mce-view',
    'wplink',
    'wp-auth-check',
    'wp-lists',
    'editor',
  );
  foreach ( $wp_scripts->queue as $script ) {
    if( strpos( $script, 'ux-builder' ) === 0 ) continue;
    if( ! in_array( $script, $keep_scripts ) ) {
      wp_dequeue_script( $script );
    }
  }
}

// function _ux_builder_filter_styles() {
//   $wp_styles = wp_styles();
//   $keep_styles = array(
//     'wp-core-ui',
//     'wp-core-ui-colors',
//     'media-views',
//     'imgareaselect',
//   );
//   foreach ( $wp_styles->queue as $style ) {
//     if( strpos( $style, 'ux-builder' ) === 0 ) continue;
//     if( ! in_array( $style, $keep_styles ) ) {
//       wp_dequeue_style( $style );
//     }
//   }
// }
