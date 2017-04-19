<?php


// Option links
function flatsome_admin_bar_helper(){


global $wp_admin_bar;

$panel_url = get_admin_url().'admin.php?page=flatsome-panel';
$advanced_url = get_admin_url().'admin.php?page=optionsframework&tab=';
$permalink = get_permalink();
if(is_admin()) $permalink = get_home_url();
$optionUrl_panel = get_admin_url().'customize.php?url='.$permalink.'&autofocus%5Bpanel%5D=';
$optionUrl_section = get_admin_url().'customize.php?url='.$permalink.'&autofocus%5Bsection%5D=';
$icon_style = 'font-size:20px; -webkit-font-smoothing: antialiased; font-weight:400!important; padding-right:4px; font-family:dashicons!important;margin-top:-2px;';
$flatsome_icon = '<svg style="width:20px; margin-top:-4px; height:20px;vertical-align:middle;" width="184px" height="186px" viewBox="0 0 184 186" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <!-- Generator: Sketch 3.8.1 (29687) - http://www.bohemiancoding.com/sketch --> <title>Logo-white</title> <desc>Created with Sketch.</desc> <defs></defs> <g id="Logo" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Logo-white" fill="#FFFFFF"> <g id="Group"> <path d="M92.6963305,153.35517 L69.6726254,130.331465 L92.6963305,107.30776 L92.6963305,66.7055226 L49.3715069,110.030346 L32.472925,93.1317642 L92.6963305,32.9083587 L92.6963305,0.803652143 L0.106126393,93.3938562 L92.6963305,185.98406 L92.6963305,153.35517 Z" id="Combined-Shape"></path> </g> <g id="Group" opacity="0.502623601" transform="translate(136.800003, 93.000000) scale(-1, 1) translate(-136.800003, -93.000000) translate(90.300003, 0.000000)"> <path d="M92.6963305,153.35517 L69.6726254,130.331465 L92.6963305,107.30776 L92.6963305,66.7055226 L49.3715069,110.030346 L32.472925,93.1317642 L92.6963305,32.9083587 L92.6963305,0.803652143 L0.106126393,93.3938562 L92.6963305,185.98406 L92.6963305,153.35517 Z" id="Combined-Shape" opacity="0.387068563"></path> </g> </g> </g> </svg>';

$wp_admin_bar->add_menu( array(
 'id' => 'flatsome_panel',
 'title' => $flatsome_icon.' Flatsome',
 'href' => $panel_url
));

$wp_admin_bar->add_menu( array(
 'id' => 'theme_options',
 'parent' => 'flatsome_panel',
 'title' => '<span class="dashicons dashicons-admin-generic" style="'.$icon_style.'"></span> Theme Options',
 'href' => $optionUrl_panel
));

$wp_admin_bar->add_menu( array(
 'parent' => 'flatsome_panel',
 'id' => 'options_advanced',
 'title' => '<span class="dashicons dashicons-admin-tools" style="'.$icon_style.'"></span> Advanced',
 'href' =>  $advanced_url.''
));

$wp_admin_bar->add_menu( array(
 'parent' => 'flatsome_panel',
 'id' => 'flatsome_panel_license',
 'title' => 'Theme License',
 'href' => $panel_url
));

$wp_admin_bar->add_menu( array(
 'parent' => 'flatsome_panel',
 'id' => 'flatsome_panel_support',
 'title' => 'Help & Guides',
 'href' => $panel_url.'-support'
));

/*
$wp_admin_bar->add_menu( array(
 'parent' => 'flatsome_panel',
 'id' => 'flatsome_panel_plugins',
 'title' => 'Plugins',
 'href' => $panel_url.'-plugins'
)); */

$wp_admin_bar->add_menu( array(
 'parent' => 'flatsome_panel',
 'id' => 'flatsome_panel_changelog',
 'title' => 'Change log',
 'href' => $panel_url.'-changelog'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'flatsome_panel',
 'id' => 'flatsome_panel_setup_wizard',
 'title' => 'Setup Wizard',
 'href' => admin_url().'admin.php?page=flatsome-setup'
));

if(!flatsome_is_theme_enabled()){
  $wp_admin_bar->add_menu( array(
   'id' => 'flatsome-activate',
   'title' => '<span class="dashicons dashicons-unlock" style="'.$icon_style.'"></span>Activate Theme',
   'href' => admin_url() . 'admin.php?page=flatsome-panel',
  ));
}

$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_header',
 'title' => '<span class="dashicons dashicons-arrow-up-alt dashicons-header" style="'.$icon_style.'"></span> Header',
 'href' =>  $optionUrl_panel.'header'
));


$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_layout',
 'title' => '<span class="dashicons dashicons-editor-table" style="'.$icon_style.'"></span> Layout',
 'href' =>  $optionUrl_section.'layout'
));


$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_static_front_page',
 'title' => '<span class="dashicons dashicons-admin-home" style="'.$icon_style.'"></span> Homepage',
 'href' =>  $optionUrl_section.'static_front_page'
));


$wp_admin_bar->add_menu( array(
 'parent' => 'options_header',
 'id' => 'options_header_presets',
 'title' => 'Presets',
 'href' =>  $optionUrl_section.'header-presets'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_header',
 'id' => 'options_header_logo',
 'title' => 'Logo & Site Identity',
 'href' =>  $optionUrl_section.'title_tagline'
));


$wp_admin_bar->add_menu( array(
 'parent' => 'options_header',
 'id' => 'options_header_top',
 'title' => 'Top Bar',
 'href' =>  $optionUrl_section.'top_bar'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_header',
 'id' => 'options_header_main',
 'title' => 'Header Main',
 'href' =>  $optionUrl_section.'main_bar'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_header',
 'id' => 'options_header_bottom',
 'title' => ' Header Bottom',
 'href' =>  $optionUrl_section.'bottom_bar'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_header',
 'id' => 'options_header_mobile',
 'title' => ' Header Mobile',
 'href' =>  $optionUrl_section.'header_mobile'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_header',
 'id' => 'options_header_sticky',
 'title' => ' Sticky Header',
 'href' =>  $optionUrl_section.'header_sticky'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_header',
 'id' => 'options_header_dropdown',
 'title' => 'Dropdown Style',
 'href' =>  $optionUrl_section.'header_dropdown'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_style',
 'title' => '<span class="dashicons dashicons-admin-appearance" style="'.$icon_style.'"></span> Style',
 'href' =>  $optionUrl_panel.'style'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_style',
 'id' => 'options_style_colors',
 'title' => 'Colors',
 'href' =>  $optionUrl_section.'colors'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_style',
 'id' => 'options_style_global',
 'title' => 'Global Styles',
 'href' =>  $optionUrl_section.'global-styles'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_style',
 'id' => 'options_style_type',
 'title' => 'Typography',
 'href' =>  $optionUrl_section.'type'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_style',
 'id' => 'options_style_css',
 'title' => 'Custom CSS',
 'href' =>  $optionUrl_section.'custom-css'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_style',
 'id' => 'options_style_lightbox',
 'title' => 'Image Lightbox',
 'href' =>  $optionUrl_section.'lightbox'
));

if(is_woocommerce_activated()) {

$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_shop',
 'title' => '<span class="dashicons dashicons-cart" style="'.$icon_style.'"></span> Shop',
 'href' =>  $optionUrl_panel.'shop'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_shop',
 'id' => 'options_shop_category_page',
 'title' => 'Shop / Category Page',
 'href' =>  $optionUrl_section.'category-page'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_shop',
 'id' => 'options_shop_product_page',
 'title' => 'Product Page',
 'href' =>  $optionUrl_section.'product-page'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_shop',
 'id' => 'options_shop_my_account',
 'title' => 'My Account',
 'href' =>  $optionUrl_section.'fl-my-account'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_shop',
 'id' => 'options_shop_cart_checkout',
 'title' => 'Cart and Checkout',
 'href' =>  $optionUrl_section.'cart-checkout'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_shop',
 'id' => 'options_shop_payment_icons',
 'title' => 'Payment Icons',
 'href' =>  $optionUrl_section.'payment-icons'
));

}


$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_layout',
 'title' => '<span class="dashicons dashicons-editor-table" style="'.$icon_style.'"></span> Layout',
 'href' =>  $optionUrl_section.'layout'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_pages',
 'title' => '<span class="dashicons dashicons-admin-page" style="'.$icon_style.'"></span> Pages',
 'href' =>  $optionUrl_section.'pages'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_blog',
 'title' => '<span class="dashicons dashicons-edit" style="'.$icon_style.'"></span> Blog',
 'href' =>  $optionUrl_panel.'blog'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_portfolio',
 'title' => '<span class="dashicons dashicons-portfolio" style="'.$icon_style.'"></span> Portfolio',
 'href' =>  $optionUrl_section.'fl-portfolio'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_footer',
 'title' => '<span class="dashicons dashicons-arrow-down-alt" style="'.$icon_style.'"></span> Footer',
 'href' =>  $optionUrl_section.'footer'
));


$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_menus',
 'title' => '<span class="dashicons dashicons-menu " style="'.$icon_style.'"></span> Menus',
 'href' =>  $optionUrl_panel.'nav_menus'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_menus',
 'id' => 'options_menus_backend',
 'title' => 'Back-end editor',
 'href' =>  admin_url().'nav-menus.php'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_widgets',
 'title' => '<span class="dashicons dashicons-welcome-widgets-menus" style="'.$icon_style.'"></span> Widgets',
 'href' =>  $optionUrl_panel.'widgets'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_widgets',
 'id' => 'options_widgets_backend',
 'title' => 'Back-end editor',
 'href' =>  admin_url().'widgets.php'
));


$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_share',
 'title' => '<span class="dashicons dashicons-share" style="'.$icon_style.'"></span> Share',
 'href' =>  $optionUrl_section.'share'
));


$wp_admin_bar->add_menu( array(
 'parent' => 'theme_options',
 'id' => 'options_reset',
 'title' => '<span class="dashicons dashicons-admin-generic" style="'.$icon_style.'"></span> Reset',
 'href' =>  $optionUrl_section.'advanced'
));


$wp_admin_bar->add_menu( array(
 'parent' => 'options_advanced',
 'id' => 'options_advanced_custom_scripts',
 'title' => 'Global Settings',
 'href' =>  $advanced_url.'of-option-globalsettings'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_advanced',
 'id' => 'options_advanced_custom_css',
 'title' => 'Custom CSS',
 'href' =>  $advanced_url.'of-option-customcss'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_advanced',
 'id' => 'options_advanced_custom_lazyloading',
 'title' => 'Lazy Loading',
 'href' =>  $advanced_url.'of-option-lazyloading'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_advanced',
 'id' => 'options_advanced_site_loader',
 'title' => 'Site Loader',
 'href' =>  $advanced_url.'of-option-siteloader'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_advanced',
 'id' => 'options_advanced_site_search',
 'title' => 'Site Search',
 'href' =>  $advanced_url.'of-option-sitesearch'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_advanced',
 'id' => 'options_advanced_google_apis',
 'title' => 'Google APIs',
 'href' =>  $advanced_url.'of-option-googleapis'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_advanced',
 'id' => 'options_advanced_maintenance',
 'title' => 'Maintenance',
 'href' =>  $advanced_url.'of-option-maintenancemode'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_advanced',
 'id' => 'options_advanced_custom_fonts',
 'title' => 'Custom Fonts',
 'href' =>  $advanced_url.'of-option-customfonts'
));

if(is_woocommerce_activated()) {
  $wp_admin_bar->add_menu( array(
   'parent' => 'options_advanced',
   'id' => 'options_advanced_woocommerce',
   'title' => 'WooCommerce',
   'href' =>  $advanced_url.'of-option-woocommerce'
  ));
}
$wp_admin_bar->add_menu( array(
 'parent' => 'options_advanced',
 'id' => 'options_advanced_catalog_mode',
 'title' => 'Catalog Mode',
 'href' =>  $advanced_url.'of-option-catalogmode'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_advanced',
 'id' => 'options_advanced_portfolio',
 'title' => 'Portfolio',
 'href' =>  $advanced_url.'of-option-portfolio'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_advanced',
 'id' => 'options_advanced_integrations',
 'title' => 'Integrations',
 'href' =>  $advanced_url.'of-option-integrations'
));

$wp_admin_bar->add_menu( array(
 'parent' => 'options_advanced',
 'id' => 'options_advanced_backup',
 'title' => 'Backup / Import',
 'href' =>  $advanced_url.'of-option-backupandimport'
));

// HELPERS


if(is_category() || is_home()){
	$wp_admin_bar->add_menu( array(
	       'parent' => 'customize',
	       'id' => 'admin_bar_helper',
	       'title' => 'Blog Layout',
 		    'href' =>  $optionUrl_panel.'blog'
	));
}

if(is_woocommerce_activated()) {

 if(is_checkout() || is_cart() ){
         $wp_admin_bar->add_menu( array(
             'parent' => 'customize',
             'id' => 'admin_bar_helper',
             'title' => 'Cart / Checkout layout',
     		 'href' =>  $optionUrl_section.'cart-checkout'
         ));
  }

  if(is_product()){
         $wp_admin_bar->add_menu( array(
             'parent' => 'customize',
             'id' => 'admin_bar_helper',
             'title' => 'Product Page',
 			 'href' =>  $optionUrl_section.'product-page'
         ));
  }


    if(is_account_page()){
         $wp_admin_bar->add_menu( array(
             'parent' => 'customize',
             'id' => 'admin_bar_helper',
             'title' => 'My Account Page',
 			 'href' =>  $optionUrl_section.'fl-my-account'
         ));
     }

      if(is_shop() || is_product_category()){
          $wp_admin_bar->add_menu( array(
             'parent' => 'customize',
             'id' => 'admin_bar_helper_flatsome',
             'title' => 'Category Page',
 			'href' =>  $optionUrl_section.'category-page'
         ));
  	}

}

}
add_action( 'admin_bar_menu', 'flatsome_admin_bar_helper' , 35);
