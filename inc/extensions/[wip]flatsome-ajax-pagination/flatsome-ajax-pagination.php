<?php

if ( ! class_exists( 'FL_LazyLoad_Images' ) ) :
class FL_LazyLoad_Images {
	const version = '1.0';
	protected static $enabled = true;
	static function init() {
		if ( is_admin() )
			return;
		if ( ! apply_filters( 'lazyload_is_enabled', true ) ) {
			self::$enabled = false;
			return;
		}
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'add_scripts' ) );
		add_action( 'wp_head', array( __CLASS__, 'setup_filters' ), 9999 ); // we don't really want to modify anything in <head> since it's mostly all metadata, e.g. OG tags
	}
	static function setup_filters() {
		add_filter( 'the_content', array( __CLASS__, 'add_image_placeholders' ), 99 ); // run this later, so other content filters have run, including image_add_wh on WP.com
		add_filter( 'post_thumbnail_html', array( __CLASS__, 'add_image_placeholders' ), 11 );
		add_filter( 'get_avatar', array( __CLASS__, 'add_image_placeholders' ), 11 );
		add_filter( 'woocommerce_single_product_image_html', array( __CLASS__, 'add_image_placeholders' ), 99 );
		add_filter( 'woocommerce_single_product_image_thumbnail_html', array( __CLASS__, 'add_image_placeholders' ), 99 );
	}
	static function add_scripts() {
	//	wp_enqueue_script( 'wpcom-lazy-load-images',  self::get_url( 'js/lazy-load.js' ), array( 'jquery', 'jquery-sonar' ), self::version, true );
	//	wp_enqueue_script( 'jquery-sonar', self::get_url( 'js/jquery.sonar.min.js' ), array( 'jquery' ), self::version, true );
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

		$search = array();
		$replace = array();

		$i = 0;
		foreach ( $matches[0] as $imgHTML ) {

			// don't to the replacement if a skip class is provided and the image has the class, or if the image is a data-uri
			if ( ! preg_match( "/src=['\"]data:image/is", $imgHTML ) && ! preg_match( "/src=.*lazy_placeholder.gif['\"]/s", $imgHTML ) ) {
				$i++;
				// replace the src and add the data-src attribute
				$replaceHTML = '';
				$replaceHTML = preg_replace( '/<img(.*?)src=/is', '<img$1src="" data-src=', $imgHTML );
				$replaceHTML = preg_replace( '/<img(.*?)srcset=/is', '<img$1srcset="" data-srcset=', $replaceHTML );

				// add the lazy class to the img element
				if ( preg_match( '/class=["\']/i', $replaceHTML ) ) {
					$replaceHTML = preg_replace( '/class=(["\'])(.*?)["\']/is', 'class=$1lazy-load $2$1', $replaceHTML );
				} else {
					$replaceHTML = preg_replace( '/<img/is', '<img class="lazy-load"', $replaceHTML );
				}

				if ( $include_noscript ) {
					$replaceHTML .= '<noscript>' . $imgHTML . '</noscript>';
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
	static function get_url( $path = '' ) {
		return plugins_url( ltrim( $path, '/' ), __FILE__ );
	}
}
function lazyload_images_add_placeholders( $content ) {
	return FL_LazyLoad_Images::add_image_placeholders( $content );
}
add_action( 'init', array( 'FL_LazyLoad_Images', 'init' ) );
endif;