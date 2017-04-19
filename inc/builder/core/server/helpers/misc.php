<?php

function ux_builder_parse_args( &$a, $b ) {
	$a = (array) $a;
	$b = (array) $b;
	$r = $b;

	foreach ( $a as $k => &$v ) {
		if ( is_array( $v ) && isset( $r[ $k ] ) ) {
			$r[ $k ] = ux_builder_parse_args( $v, $r[ $k ] );
		} else {
			$r[ $k ] = $v;
		}
	}

	return $r;
}
