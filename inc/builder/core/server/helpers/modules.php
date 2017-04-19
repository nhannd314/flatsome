<?php

function add_ux_builder_module( $name, $type = 'master' ) {
  ux_builder( 'modules' )->add( $name, $type );
}
