<?php
/**
 * PHPUnit bootstrap file
 *
 * @package ux-builder
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = 'tmp/wordpress-develop/tests/phpunit';
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function load_ux_builder_plugin() {
	require dirname( dirname( __FILE__ ) ) . '/ux-builder.php';
}
tests_add_filter( 'muplugins_loaded', 'load_ux_builder_plugin' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
