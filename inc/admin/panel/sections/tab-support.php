<?php
/**
 * Welcome screen getting started template
 */

?>
<script>!function(e,o,n){window.HSCW=o,window.HS=n,n.beacon=n.beacon||{};var t=n.beacon;t.userConfig={},t.readyQueue=[],t.config=function(e){this.userConfig=e},t.ready=function(e){this.readyQueue.push(e)},o.config={docs:{enabled:!0,baseUrl:"//uxthemes.helpscoutdocs.com/"},contact:{enabled:!1,formId:"0fec07d3-7b3b-11e6-91aa-0a5fecc78a4d"}};var r=e.getElementsByTagName("script")[0],c=e.createElement("script");c.type="text/javascript",c.async=!0,c.src="https://djtflbt20bdde.cloudfront.net/",r.parentNode.insertBefore(c,r)}(document,window.HSCW||{},window.HS||{});</script>

<script>
  HS.beacon.config({
    modal: true,
    instructions:'This is instructional text that goes above the form.'
  });

  HS.beacon.ready(function() {
  	HS.beacon.suggest([
	    '57036ff9903360288a77fc9a',
	    '57ceb6e0903360649f6e5a39',
	    '57cea07bc6979108399a0722',
  	]);
  	// Open the Beacon as soon as it's ready
  	jQuery('#search-docs').focus(function(){
  		HS.beacon.open();
  	});
  });
</script>

<div id="tab-support" class="coltwo-col panel flatsome-panel">
	<div class="cols">
		<div class="inner-panel" style="text-align: center; padding:0;">
	    	<input type="text" id="search-docs" style="padding:15px;width: 100%; margin:0;" value="Search Documentation..."/>
		</div>
	</div>
	<div class="cols">

	<div class="inner-panel" style="text-align: center;">
		<img style="width:100px; margin:30px 15px 0;" src="<?php echo get_template_directory_uri().'/inc/admin/panel/img/videos.png'; ?>"/>
		<h3>How-to Videos</h3>
		<p>Our How-to videos is perfect for learning about Flatsome and what is possible.</p>
        <a href="https://www.youtube.com/channel/UCeccZ4VQ8b5ZoMI-wU6qgFg" target="_blank" class="button button-primary">
        <?php _e( 'Open Videos', 'flatsome-admin' ); ?></a>
	</div>

	<div class="inner-panel" style="text-align: center;">
		<img style="width:100px; margin:30px 15px 0;" src="<?php echo get_template_directory_uri().'/inc/admin/panel/img/documentation.png'; ?>"/>
		<h3>Online Documentation</h3>
		<p>The first place you should look if you have any problems is our theme documentation.</p>
        <a href="http://uxthemes.helpscoutdocs.com" target="_blank" class="button button-primary">
        <?php _e( 'Open Documentation', 'flatsome-admin' ); ?></a>
	</div>

	<div class="inner-panel" style="text-align: center;">
	<img style="width:100px; margin:30px 15px 0;" src="<?php echo get_template_directory_uri().'/inc/admin/panel/img/emailsupport.png'; ?>"/>			<h3>Premium E-mail Support</h3>
		<p>All customers of Flatsome has access to premium e-mail support.</p>
		<?php if(!flatsome_is_theme_enabled())	{ ?>
			<a href="<?php echo admin_url().'admin.php?page=flatsome-panel';?>" class="button button-primary">Activate Theme to get support</a>
    	<?php } else if(flatsome_is_support_expired(basename( get_template_directory() ))){ ?>
    		<p><strong>Support has expired :(</strong></p>
    		<a target="_blank" href="//themeforest.net/item/flatsome-responsive-woocommerce-theme/5484319?ref=UX-themes" class="button button-warning" style="color:red;">+ Extend Support time</a>
		<?php } else {
			global $current_user;
			?>
		<a href="mailto:support@uxthemes.com?subject=Need help with Flatsome &body=Enter Your Message here...%0D%0A%0D%0A Best regards,%0D%0A <?php echo $current_user->user_firstname.' '; echo $current_user->user_lastname; ?> %0D%0A %0D%0A%0D%0A[Keep this] Theme license: <?php echo sanitize_text_field( get_option( basename( get_template_directory() ) . '_wup_purchase_code', '' ) );?> [Required for support]" class="button button-primary">
			<?php _e( 'Send us a Support Ticket', 'flatsome-admin' ); ?>
		</a>
		<br><br><small><a href="https://themeforest.net/page/item_support_policy" target="_blank">What does support include?</a></small>
		<?php } ?>
	</div>

	</div>

	<div class="cols">

		<div class="inner-panel" style="text-align: center;">
			<h3>Flatsome Community</h3>
			<p>Join our community and get help from other Flatsome Users.</p>
		    <a href="//www.facebook.com/groups/flatsome/" class="button button-primary">
	        <?php _e( 'Join Community', 'flatsome-admin' ); ?></a>
		</div>

		<div class="inner-panel" style="text-align: center;">
			<h3>Beta Testing Group</h3>
			<p>Test new versions of Flatsome before everyone else</p>
		    <a href="//www.facebook.com/groups/flatsomebeta/" class="button button-primary">
	        <?php _e( 'Join Beta Group', 'flatsome-admin' ); ?></a>
		</div>


    <div class="inner-panel" style="text-align: center;">
      <h3>Feature Requests</h3>
      <p>Send Feature Request for Flatsome Theme and vote for the ones you like.</p>
      <a href="//uxthemes.canny.io/flatsome" class="button button-primary">
      <?php _e( 'Feature Requests', 'flatsome-admin' ); ?></a>
    </div>

	</div>

</div>
