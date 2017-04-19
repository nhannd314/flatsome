<?php
$color = get_theme_mod('site_loader_color');
$bg_color = get_theme_mod('site_loader_bg');

if(empty($bg_color) && $color == 'dark'){
	$bg_color = get_theme_mod('color_primary','#446084');
} else if(empty($bg_color)){
	$bg_color = '#fff';
}

?>
<div class="page-loader fixed fill z-top-3 <?php if($color == 'dark') echo 'nav-dark dark'; ?>">
	<div class="page-loader-inner x50 y50 md-y50 md-x50 lg-y50 lg-x50 absolute">
		<div class="page-loader-logo" style="padding-bottom: 30px;">
	    	<?php get_template_part('template-parts/header/partials/element','logo'); ?>
	    </div>
		<div class="page-loader-spin"><div class="loading-spin"></div></div>
	</div>
	<style scope="scope">
		.page-loader{opacity: 0; transition: opacity .3s; transition-delay: .3s;
			background-color: <?php echo $bg_color; ?>;
		}
		.loading-site .page-loader{opacity: .98;}
		.page-loader-logo{max-width: <?php get_theme_mod('logo_width', 200); ?>px; animation: pageLoadZoom 1.3s ease-out; -webkit-animation: pageLoadZoom 1.3s ease-out;}
		.page-loader-spin{animation: pageLoadZoomSpin 1.3s ease-out;}
		.page-loader-spin .loading-spin{width: 40px; height: 40px; }
		@keyframes pageLoadZoom {
		    0%   {opacity:0; transform: translateY(30px);}
		    100% {opacity:1; transform: translateY(0);}
		}
		@keyframes pageLoadZoomSpin {
		    0%   {opacity:0; transform: translateY(60px);}
		    100% {opacity:1; transform: translateY(0);}
		}
	</style>
</div>
