<?php
/**
 * Welcome screen getting started template
 */

?>
<div id="tab-activate" class="col cols panel flatsome-panel">
	<div class="inner-panel">
		<h3>Theme Purchase code</h3>
		<?php

    $slug = basename( get_template_directory() );

    $output = '';

    //get errors so we can show them
    $errors = get_option( $slug . '_wup_errors', array() );
    delete_option( $slug . '_wup_errors' ); //delete existing errors as we will handle them next
    //check if we have a purchase code saved already
    $purchase_code = sanitize_text_field( get_option( $slug . '_wup_purchase_code', '' ) );

    //output errors and notifications
    if ( ! empty( $errors ) ) {
      foreach ( $errors as $key => $error ) {
        echo '<div class="notice-error notice-alt"><p>' . $error . '</p></div>';
      }
    }

    if ( ! empty( $purchase_code ) ) {
      if ( ! empty( $errors ) ) {
        //since there is already a purchase code present - notify the user
        $slug = basename( get_template_directory() );
        update_option( strtolower( $slug ) . '_wup_purchase_code', '' );
        $purchase_code = false;
        echo '<div class="notice-warning notice-alt"><p>' . esc_html__( 'Purchase code removed.' ) . '</p></div>';
      } else {
        //this means a valid purchase code is present and no errors were found
       echo '<div class="notice-success notice-alt notice-large" style="margin-bottom:15px!important">' . __( 'Your <strong>purchase code is valid</strong>. Thank you! Enjoy Flatsome Theme and automatic updates.' ) . '</div>';
      }
    }

    if ( empty( $purchase_code ) ) {
    echo '<form class="wupdates_purchase_code" action="" method="post">' .
             __( '<p>Enter your purchase code and <strong>hit return/enter</strong>. Find out how to <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">get your purchase code</a>.</p>' ) .
             '<input type="hidden" name="wupdates_pc_theme" value="' . $slug . '" />' .
             '<input type="text" id="' . sanitize_title( $slug ) . '_wup_purchase_code" name="' . sanitize_title( $slug ) . '_wup_purchase_code"
              value="' . $purchase_code . '" placeholder="Purchase code ( e.g. 9g2b13fa-10aa-2267-883a-9201a94cf9b5 )" style="width:100%; padding:10px;"/><br/><br/><input type="submit" class="button button-large button-primary" value="Activate"/>
      </form>';
  	} else{
    echo '<form class="wupdates_purchase_code" action="" method="post">' .
             '<input type="hidden" name="wupdates_pc_theme" value="' . $slug . '" />' .
             '<input type="text" id="' . sanitize_title( $slug ) . '_wup_purchase_code" name="' . sanitize_title( $slug ) . '_wup_purchase_code"
              value="' . $purchase_code . '" placeholder="Purchase code ( e.g. 9g2b13fa-10aa-2267-883a-9201a94cf9b5 )" style="width:100%; padding:10px;"/><br/><br/><input type="submit" class="button button-large button-primary" value="Update"/>
      </form>';
  	}
?>
  <small style="padding-top: 10px; margin-top: 15px; opacity: .8; display: block; border-top: 1px solid #eee;">A purchase code (license) is only valid for <strong>One Domain</strong>. Are you using this theme on a new domain? Purchase a <a href="//bit.ly/buy-flatsome" target="_blank">new license here</a> to get a new purchase code. To remove a purchase code simply remove the code and click update.</small>
	</div>
  <?php if(flatsome_is_theme_enabled()){ ?>
	<div class="inner-panel">
  <?php

     // Sold at
    $sold = date("F jS, Y",strtotime(get_option( $slug . '_wup_sold_at', '' )));

    // Supported until
    $support_ends = date("F jS, Y",strtotime(get_option( $slug . '_wup_supported_until', '' )));

    $support_message = '<span style="color:green">Active</span';

    // If support expired
    if(flatsome_is_support_expired($slug)){
      $support_message = '<strong style="color:red;">Expired</strong>';
    }

    // Buyer
    $buyer = get_option( $slug . '_wup_buyer', '' )

    ?>
    <h3>License details</h3>
    <style>.license-table{width: 100%;} .license-table td{padding: 10px 0; border-bottom: 1px solid #eee;}</style>
    <table class="license-table">
     <tbody>
      <tr>
        <td><strong>Purchased</strong></td>
        <td><?php echo $sold; ?></td>
      </tr>
      <tr>
        <td>
          <?php if(flatsome_is_support_expired($slug)){ ?>
            <strong>Support ended</strong>
          <?php } else { ?>
            <strong>Support ends</strong>
          <?php } ?>
        </td>
        <td><?php echo $support_ends; ?></td>
      </tr>
     <tr>
        <td><strong>Support Status</strong></td>
        <td><?php echo $support_message; ?></td>
      </tr>
      <tr>
        <td><strong>Username</strong></td>
        <td><?php echo $buyer; ?></td>
      </tr>
      </tbody>
    </table>
    <?php if(flatsome_is_support_expired($slug)){ ?>
        <a target="_blank" href="//bit.ly/flatsome3" class="button button-warning" style="color:red; margin-top: 15px;">+ Extend Support time</a>
        <br><small style="margin-top:10px;opacity: .6;display: block;">Try click the Update button on the left if you have already extended support</small>
    <?php } ?>
	</div>
  <?php } ?>
</div>
