<!DOCTYPE html>
<!--[if lte IE 9 ]><html class="ie lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>
<body>
	<?php if(flatsome_option('maintenance_mode_page')){ 
			$post = get_post(flatsome_option('maintenance_mode_page')); 
			echo do_shortcode($post->post_content);
		} else { ?>
	<?php
	 $logo_url = do_shortcode(flatsome_option('site_logo'));
	 echo do_shortcode('[ux_banner bg_color="#fff" bg_overlay="rgba(255,255,255,.9)" height="100%"] [text_box animate="fadeInUp" text_color="dark"] [ux_image id="'.$logo_url.'" width="70%"] [divider] <p class="lead">'.flatsome_option('maintenance_mode_text').'</p> [/text_box] [/ux_banner]'); ?>
	 <?php } ?>
</body>
	<?php wp_footer(); ?>
</html>