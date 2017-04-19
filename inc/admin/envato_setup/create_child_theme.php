<?php

function make_child_theme( $new_theme_title, $new_theme_description, $new_theme_author ) {
		$parent_theme_title = get_current_theme();
		$parent_theme_template = get_template(); //Doesn't play nice with the grandkids
		$parent_theme_name = get_stylesheet();
		$parent_theme_dir = get_stylesheet_directory();

		// Turn a theme name into a directory name
		$new_theme_name = sanitize_title( $new_theme_title );
		$theme_root = get_theme_root();

		// Validate theme name
		$new_theme_path = $theme_root.'/'.$new_theme_name;
		if ( file_exists( $new_theme_path ) ) {
			return new WP_Error( 'exists', __( 'Theme directory already exists!', self::_SLUG ) );
		}

		mkdir( $new_theme_path );

		// Make style.css
		ob_start();
		require $this->_pluginDir.'/templates/child-theme-css.php';
		$css = ob_get_clean();
		file_put_contents( $new_theme_path.'/style.css', $css );

		// "Generate" functions.php 
		copy( $this->_pluginDir.'/templates/functions.php', $new_theme_path.'/functions.php' );

		// RTL support
		$rtl_theme = ( file_exists( $parent_theme_dir.'/rtl.css' ) )
			? $parent_theme_name
			: 'twentyfifteen'; //use the latest default theme rtl file
		ob_start();
		require $this->_pluginDir.'/templates/rtl-css.php';
		$css = ob_get_clean();
		file_put_contents( $new_theme_path.'/rtl.css', $css );

		// Copy screenshot
		if ( $screenshot_filename = $this->_scanForScreenshot( $parent_theme_dir ) ) {
			copy(
				$parent_theme_dir.'/'.$screenshot_filename,
				$new_theme_path.'/'.$screenshot_filename
			);
		} // removed grandfather screenshot check (use mshot instead, rly)

		// Make child theme an allowed theme (network enable theme)
		$allowed_themes = get_site_option( 'allowedthemes' );
		$allowed_themes[ $new_theme_name ] = true;
		update_site_option( 'allowedthemes', $allowed_themes );

		return array(
			'parent_template'    => $parent_theme_template,
			'parent_theme'       => $parent_theme_name,
			'new_theme'          => $new_theme_name,
			'new_theme_path'     => $new_theme_path,
			'new_theme_title'	 => $new_theme_title,
		);
		
		// switch_theme( $result['parent_template'], $result['new_theme'] );
}