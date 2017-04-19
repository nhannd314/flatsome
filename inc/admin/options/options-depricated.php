<?php

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textfield',
	'settings'     => 'nav_position',
	'label'       => __( 'Nav Position', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textfield',
	'settings'     => 'search_pos',
	'label'       => __( 'Search Position', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'default'     => '',
));