<?php

if ( ! class_exists( 'FL_LazyLoad_Images' ) ) :
class FL_LazyLoad_Images {
	const version = '1.0';
	protected static $enabled = true;
	static function init() {
		if ( is_admin() ) return; // Disable for admin
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'add_scripts' ), 99 );
		add_action( 'wp_head', array( __CLASS__, 'setup_filters' ), 99 );
	}
	static function setup_filters() {
		add_filter( 'the_content', array( __CLASS__, 'add_image_placeholders' ), 9999 );
		add_filter( 'post_thumbnail_html', array( __CLASS__, 'add_image_placeholders' ), 11 );
		add_filter( 'get_avatar', array( __CLASS__, 'add_image_placeholders' ), 11 );
		add_filter( 'woocommerce_single_product_image_html', array( __CLASS__, 'add_image_placeholders' ), 9999);
		add_filter( 'flatsome_woocommerce_get_alt_product_thumbnail', array( __CLASS__, 'add_image_placeholders' ), 11 );
		add_filter( 'flatsome_lazy_load_images', array( __CLASS__, 'add_image_placeholders' ), 9999);
		add_filter( 'flatsome_woocommerce_single_product_extra_images', array( __CLASS__, 'add_image_placeholders' ), 9999);
		add_filter( 'woocommerce_single_product_image_thumbnail_html', array( __CLASS__, 'add_image_placeholders' ), 9999);
	}
	static function add_scripts() {
		global $extensions_uri;
		wp_enqueue_script( 'flatsome-lazy', $extensions_uri.'/flatsome-lazy-load/flatsome-lazy-load.js', array( 'flatsome-js' ), self::version, true);
	}
	static function add_image_placeholders( $content ) {

		if ( ! self::is_enabled() )
			return $content;
		// Don't lazyload for feeds, previews, mobile
		if( is_feed() || is_preview() )
			return $content;
		
		// Don't lazy-load if the content has already been run through previously
		if ( false !== strpos( $content, 'data-src' ) )
			return $content;
		
		$matches = array();
		preg_match_all( '/<img[\s\r\n]+.*?>/is', $content, $matches );

		$lazy_image = get_template_directory_uri().'/assets/img/lazy.png';

		$search = array();
		$replace = array();

		$i = 0;
		foreach ( $matches[0] as $imgHTML ) {


			// don't to the replacement if the image is a data-uri
			if ( ! preg_match( "/src=['\"]data:image/is", $imgHTML ) ) {
				$i++;
				// replace the src and add the data-src attribute
				$replaceHTML = '';
				$replaceHTML = preg_replace( '/<img(.*?)src=/is', '<img$1src="'.$lazy_image.'" data-src=', $imgHTML );
				$replaceHTML = preg_replace( '/<img(.*?)srcset=/is', '<img$1srcset="" data-srcset=', $replaceHTML );

				// add the lazy class to the img element
				if ( preg_match( '/class=["\']/i', $replaceHTML ) ) {
					$replaceHTML = preg_replace( '/class=(["\'])(.*?)["\']/is', 'class=$1lazy-load $2$1', $replaceHTML );
				} else {
					$replaceHTML = preg_replace( '/<img/is', '<img class="lazy-load"', $replaceHTML );
				}

				array_push( $search, $imgHTML );
				array_push( $replace, $replaceHTML );
			}
		}

		$search = array_unique( $search );
		$replace = array_unique( $replace );

		$content = str_replace( $search, $replace, $content );

		return $content;
	}
	static function is_enabled() {
		return self::$enabled;
	}
}
add_action( 'init', array( 'FL_LazyLoad_Images', 'init' ) );
endif;