<?php

Flatsome_Option::add_section( 'blog-single', array(
	'title'       => __( 'Blog Single Post', 'flatsome-admin' ),
	'panel' => 'blog',
) );


// Single Posts
Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'blog_post_layout',
	'label'       => __( 'Blog Post Single Layout', 'flatsome-admin' ),
	'section'     => 'blog-single',
	'default'     => 'right-sidebar',
	'choices'     => array(
		'right-sidebar' => $image_url . 'layout-right.svg',
		'left-sidebar' => $image_url . 'layout-left.svg',
		'no-sidebar' => $image_url . 'layout-no-sidebar.svg',
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'blog_post_style',
	'label'       => __( 'Title Layout', 'flatsome-admin' ),
	'section'     => 'blog-single',
	'default'     => 'default',
	'choices'     => array(
		'default' => $image_url . 'blog-single.svg',
		'top' => $image_url . 'blog-single-full.svg',
		'inline' =>$image_url . 'blog-single-inline.svg',
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'blog_single_transparent',
	'label'       => __( 'Transparent Header', 'flatsome-admin' ),
	'section'     => 'blog-single',
	'default'     => 0,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'blog_author_box',
	'label'       => __( 'Enable Blog Author Box', 'flatsome-admin' ),
	'section'     => 'blog-single',
	'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'blog_share',
	'label'       => __( 'Enable Share Icons', 'flatsome-admin' ),
	'section'     => 'blog-single',
	'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'blog_after_post',
	'label'       => __( 'HTML after blog posts', 'flatsome-admin' ),
	'section'     => 'blog-single',
	'description' => 'Enter HTML or shortcodes that will be visible after blog posts. (Before comment box). Shortcodes are allowed',
	'sanitize_callback' => 'flatsome_custom_sanitize',
	'default'     => '',
));
