<?php

// If this file is called directly, abort.
if( ! defined( 'WPINC' ) ) die;

// Get flatsome version.
$theme = wp_get_theme( get_template() );
$version = $theme->get( 'Version' );

// Defines
define( 'UX_BUILDER_VERSION', $theme->get( 'Version' ) );
define( 'UX_BUILDER_PATH', get_template_directory() . '/inc/builder/core' );
define( 'UX_BUILDER_URL',  get_template_directory_uri() );

// Required files.
require_once UX_BUILDER_PATH . '/server/helpers/states.php';
require_once UX_BUILDER_PATH . '/server/helpers/breakpoints.php';
require_once UX_BUILDER_PATH . '/server/helpers/posts.php';
require_once UX_BUILDER_PATH . '/server/helpers/elements.php';
require_once UX_BUILDER_PATH . '/server/helpers/urls.php';
require_once UX_BUILDER_PATH . '/server/actions/actions.php';
require_once UX_BUILDER_PATH . '/server/filters/public.php';

// Stop here if the editor is not active.
if ( ! ux_builder_is_active() ) return;

// Register the autoloader.
spl_autoload_register( function ( $class_name ) {
  if ( false !== strpos( $class_name, 'UxBuilder' ) ) {
    $dir_sep = DIRECTORY_SEPARATOR;
    $class_name = str_replace( array( 'UxBuilder', '\\' ), array( 'src', $dir_sep ), $class_name );
    $classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . $dir_sep . 'server' . $dir_sep;
    $class_file = str_replace( '_', $dir_sep, $class_name ) . '.php';
    require_once $classes_dir . $class_file;
  }
} );

function ux_builder( $name = null ) {
  return \UxBuilder\Application::get_instance()->resolve( $name );
}

require_once UX_BUILDER_PATH . '/server/helpers/components.php';
require_once UX_BUILDER_PATH . '/server/helpers/shortcodes.php';
require_once UX_BUILDER_PATH . '/server/helpers/templates.php';
require_once UX_BUILDER_PATH . '/server/helpers/misc.php';
require_once UX_BUILDER_PATH . '/server/helpers/modules.php';
require_once UX_BUILDER_PATH . '/server/helpers/options.php';
require_once UX_BUILDER_PATH . '/server/helpers/page.php';
require_once UX_BUILDER_PATH . '/server/helpers/paths.php';
require_once UX_BUILDER_PATH . '/server/helpers/strings.php';
require_once UX_BUILDER_PATH . '/server/helpers/templating.php';
require_once UX_BUILDER_PATH . '/server/helpers/transformers.php';

// Required for the editor.
require_once UX_BUILDER_PATH . '/server/filters/filters.php';
require_once UX_BUILDER_PATH . '/server/filters/post-options.php';
require_once UX_BUILDER_PATH . '/server/filters/meta-options.php';
require_once UX_BUILDER_PATH . '/server/src/Application.php';
require_once UX_BUILDER_PATH . '/shortcodes/shortcodes.php';
require_once UX_BUILDER_PATH . '/components/components.php';
require_once UX_BUILDER_PATH . '/server/setup.php';

/**
 * Initialize the plugin.
 */
add_action( 'plugins_loaded', array( 'UxBuilder\Application', 'get_instance' ) );
