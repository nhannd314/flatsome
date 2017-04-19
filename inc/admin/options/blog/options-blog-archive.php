<?php 

Flatsome_Option::add_section( 'blog-archive', array(
	'title'       => __( 'Blog Archive', 'flatsome-admin' ),
	'panel' => 'blog',
	'description' => __( 'Set custom layouts for archive pages like Categories, Search etc.', 'flatsome-admin' ),
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'blog_archive_title',
	'label'       => __( 'Enable Blog Archive Title', 'flatsome-admin' ),
	'section'     => 'blog-archive',
	'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'blog_style_archive',
	'label'       => __( 'Posts Layout', 'flatsome-admin' ),
	'section'     => 'blog-archive',
	'default'     => '',
	'choices'     => array(
		'' => $image_url . 'blog-default.svg',
		'normal' => $image_url . 'blog-normal.svg',
		'inline' => $image_url . 'blog-inline.svg',
		'2-col' => $image_url . 'blog-two-col.svg',
		'3-col' =>$image_url . 'blog-three-col.svg',
		'list' => $image_url . 'blog-list.svg',
	),
));