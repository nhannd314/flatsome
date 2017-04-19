<?php


/*************
 * Header Panel
 *************/

Flatsome_Option::add_panel( 'header', array(
	'title'       => __( 'Header', 'flatsome-admin' ),
	'description' => __( 'Change Theme Header Options here.', 'flatsome-admin' ),
) );


include_once(dirname( __FILE__ ).'/options-header-presets.php');
include_once(dirname( __FILE__ ).'/options-header-layout.php');
include_once(dirname( __FILE__ ).'/options-header-logo.php');
include_once(dirname( __FILE__ ).'/options-header-top.php');
include_once(dirname( __FILE__ ).'/options-header-main.php');
include_once(dirname( __FILE__ ).'/options-header-bottom.php');
include_once(dirname( __FILE__ ).'/options-header-mobile.php');
include_once(dirname( __FILE__ ).'/options-header-sticky.php');
include_once(dirname( __FILE__ ).'/options-header-dropdown.php');
include_once(dirname( __FILE__ ).'/options-header-buttons.php');
include_once(dirname( __FILE__ ).'/options-header-refresh.php');
include_once(dirname( __FILE__ ).'/options-header-account.php');
include_once(dirname( __FILE__ ).'/options-header-cart.php');
include_once(dirname( __FILE__ ).'/options-header-search.php');
include_once(dirname( __FILE__ ).'/options-header-content.php');
include_once(dirname( __FILE__ ).'/options-header-contact.php');
include_once(dirname( __FILE__ ).'/options-header-newsletter.php');

if(class_exists( 'YITH_WCWL' )){
	include_once(dirname( __FILE__ ).'/options-header-wishlist.php');
}