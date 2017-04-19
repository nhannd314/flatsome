<?php

function ux_builder_add_component( $type, $options ) {
  ux_builder( 'components' )->set( $type, $options );
}

function ux_builder_edit_component( $type, $options ) {
  ux_builder( 'components' )->modify( $type, $options );
}

function ux_builder_remove_component( $type ) {
  ux_builder( 'components' )->remove( $type );
}
