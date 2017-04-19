<div class="wrap" id="of_container">

	<div id="of-popup-save" class="of-save-popup">
		<div class="of-save-save">Options Updated</div>
	</div>
	
	<div id="of-popup-fail" class="of-save-popup">
		<div class="of-save-fail">Error!</div>
	</div>
	
	<span style="display: none;" id="hooks"><?php echo json_encode(of_get_header_classes_array()); ?></span>
	<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />

	<form id="of_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >
		
		<div id="main">
		
			<div id="of-nav">

				<div class="logo">
				<h3>Advanced Options<span><?php echo ('Version: '. THEMEVERSION); ?></span></h3>
				</div>
						<div class="save_bar"> 
						<button id ="of_save" type="button" class="button-primary"><?php _e('Save All Changes', 'flatsome-admin');?></button>			
						<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
			
					</div><!--.save_bar--> 
				<ul>
				  <?php echo $options_machine->Menu ?>
				</ul>

				<?php if(function_exists('pll_get_post')) { 
					$url = get_admin_url().'options-general.php?page=mlang&tab=strings';
					?>
					<div style="padding:18px">
						<h3>Translate theme options</h3>
						<a href="<?php echo $url; ?>">Click here to translate Theme Options Strings</a><br><br>
						<small>NB: You need to translate Theme Options strings once more if you have changed them.</small>
					</div>
				<?php } ?>
		
			</div>

			<div id="content">
		  		<?php echo $options_machine->Inputs /* Settings */ ?>
	  			<div class="save_bar" style="padding-left:0;"> 

					<button id="of_save" type="button" class="button-primary"><?php _e('Save All Changes', 'flatsome-admin');?></button>
					<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />

				</div><!--.save_bar--> 
		  	</div>
		  	
			<div class="clear"></div>
			
		</div>
		
 
	</form>

</div><!--wrap-->