<?php

function flatsome_uber_menu(){ ?>
	<?php if(!get_theme_mod('flatsome_uber_menu', 1)) return; ?>
	<div id="flatsome-uber-menu" class="header-ubermenu-nav relative" style="z-index: 9">
	  <div class="full-width">
 		<?php ubermenu( 'main' , array( 'theme_location' => 'primary' ) ); ?>
	  </div>
	</div>
<?php
}
add_action('flatsome_after_header_bottom','flatsome_uber_menu', 10);

