<?php

require_once __DIR__ . '/core/ux-builder.php';
require_once __DIR__ . '/actions.php';

// Templates
add_action( 'ux_builder_setup', function () {
  require_once __DIR__ . '/helpers.php';
  require_once __DIR__ . '/shortcodes.php';
  require_once __DIR__ . '/templates/templates.php';
} );
