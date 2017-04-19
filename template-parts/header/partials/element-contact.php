<li class="header-contact-wrapper">
	<?php
		$class = '';
		$icon_size = flatsome_option('contact_icon_size');
		$class_link = 'tooltip';
		$nav = 'nav-divided nav-uppercase';
		$label = true;

		if(flatsome_option('contact_style') == 'icons'){
			$label = false;
		}
	?>
	<ul id="header-contact" class="nav <?php echo $nav; ?> header-contact">
		<?php if(flatsome_option('contact_location')){ ?>
			<li class="<?php echo $class; ?>">
			  <a target="_blank" href="https://maps.google.com/?q=<?php echo flatsome_option('contact_location'); ?>" title="<?php echo flatsome_option('contact_location'); ?>" class="<?php echo $class_link;?>">
			  	 <?php echo get_flatsome_icon('icon-map-pin-fill',$icon_size); ?>
			     <span>
			     	<?php 
			     	$location_label = flatsome_option('contact_location_label');
		       		if($location_label && $label){
		       			echo $location_label;
		       		} else if($label){
		       			echo _e('Location','flatsome');
			    	} ?>
			     </span>
			  </a>
			</li>
			<?php } ?>

			<?php
			 $contact_email = get_theme_mod('contact_email','youremail@gmail.com');
			 if($contact_email){ ?>
			<li class="<?php echo $class; ?>">
			  <a href="mailto:<?php echo $contact_email; ?>" class="<?php echo $class_link;?>" title="<?php echo  $contact_email; ?>">
				  <?php echo get_flatsome_icon('icon-envelop',$icon_size); ?>
			       <span>
			       	<?php
			       	$contact_label = get_theme_mod('contact_email_label');
		       		if($contact_label && $label) {
		       			echo $contact_label;
		       		} else if($label){
		       			echo _e('Contact','flatsome');
			    	} ?>
			       </span>
			  </a>
			</li class="icon">
			<?php } ?>
		
			<?php
			$contact_hours = get_theme_mod('contact_hours','08:00 - 17:00');
			if($contact_hours){
				$contact_hours_details = get_theme_mod('contact_hours_details');
			?>
			<li class="<?php echo $class; ?>">
			  <a class="<?php echo $class_link;?>" title="<?php echo $contact_hours; ?><?php if($contact_hours_details) echo ' | '.$contact_hours_details; ?> ">
			  	   <?php echo get_flatsome_icon('icon-clock',$icon_size); ?>
			        <span><?php if($label) echo $contact_hours; ?></span>
			  </a>
			 </li>
			<?php } ?>

			<?php if(flatsome_option('contact_phone')){ ?>
			<li class="<?php echo $class; ?>">
			  <a href="tel:<?php echo flatsome_option('contact_phone'); ?>" class="<?php echo $class_link;?>" title="<?php echo flatsome_option('contact_phone'); ?>">
			     <?php echo get_flatsome_icon('icon-phone',$icon_size); ?>
			      <span><?php if($label) echo flatsome_option('contact_phone'); ?></span>
			  </a>
			</li>
			<?php } ?>
	</ul>
</li>