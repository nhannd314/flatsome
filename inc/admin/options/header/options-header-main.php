<?php

/*************
 * Header Main
 *************/

Flatsome_Option::add_section( 'main_bar', array(
	'title'       => __( 'Header Main', 'flatsome-admin' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'flatsome-admin' ),
) );

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_header_layout',
    'label'       => __( '', 'flatsome-admin' ),
    'section'     => 'main_bar',
    'default'     => '<div class="options-title-divider">Layout</div>',
) );


Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'header_width',
	'label'       => __( 'Header Width', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'default'     => 'container',
	'transport' => 'postMessage',
	'choices'     => array(
		'container' => $image_url . 'container.svg',
		'full-width' => $image_url . 'full-width.svg'
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'header_height',
	'label'       => __( 'Height', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'default'     => 100,
	'choices'     => array(
		'min'  => 30,
		'max'  => 500,
		'step' => 1
	),
	'transport' => 'postMessage'
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'header_color',
	'label'       => __( 'Text color', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'default'     => 'light',
	'transport' => 'postMessage',
	'choices'     => array(
		'dark' => $image_url . 'text-light.svg',
		'light' => $image_url . 'text-dark.svg'
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'color-alpha',
    'alpha' => true,
    'settings'     => 'header_bg',
    'label'       => __( 'Background Color', 'flatsome-admin' ), 
    'section'     => 'main_bar',
	'default'     => 'rgba(255,255,255,0.9)',
	'transport' => 'postMessage'
));


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'image',
    'settings'     => 'header_bg_img',
    'label'       => __( 'Background Image', 'flatsome-admin' ),
    'help' => __( 'Image is added to .header container. Try set a header background with opacity if you can not see the background image. (Drag the alpha slider in the background selector)', 'flatsome-admin' ),
    'section'     => 'main_bar',
	'default'     => "",
	'transport' => 'postMessage',
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'header_bg_img_repeat',
	'label'       => __( 'Background Repeat', 'flatsome-admin' ),
	//'description' => __( 'This is the control description', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'default'     => 'repeat',
	'choices'     => $bg_repeat,
	'transport' => 'postMessage',
	'required'  => array(
        array( 'settings'  => 'header_bg_img', 'operator' => '==', 'value' => true),
    ),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'box_shadow_header',
	'label'       => __( 'Add Shadow', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'transport' => 'postMessage',
	'default'     => 0,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'header_divider',
	'label'       => __( 'Add Divider', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'transport' => $transport,
	'default'     => 1,
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'html_after_header',
	'label'       => __( 'HTML after header', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'default'     => '',
	'sanitize_callback' => 'flatsome_custom_sanitize',
));


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_nav',
    'label'       => __( '', 'flatsome-admin' ),
    'section'     => 'main_bar',
    'default'     => '<div class="options-title-divider">Navigation</div>',
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'nav_style',
	'label'       => __( 'Navigation Style', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'default'     => '',
	'transport' => $transport,
	'choices'     => $nav_styles_img
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'nav_size',
	'label'       => __( 'Nav Size', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'transport' => $transport,
	'default'     => '',
	'choices'     => $nav_sizes
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'nav_spacing',
	'label'       => __( 'Nav Spacing', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'transport' => $transport,
	'default'     => '',
	'choices'     => $nav_sizes
));


Flatsome_Option::add_field( 'option',  array(
		'type'        => 'checkbox',
		'settings'     => 'nav_uppercase',
		'label'       => __( 'Uppercase', 'flatsome-admin' ),
		'section'     => 'main_bar',
	    'transport' => $transport,
		'default'     => 1,
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'nav_height',
	'label'       => __( 'Nav Height', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'default' => 16,
	'choices'     => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1
	),
	'transport' => 'postMessage',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'nav_push',
	'label'       => __( 'Nav Push', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'default' => 0,
	'choices'     => array(
		'min'  => -50,
		'max'  => 50,
		'step' => 1
	),
	'transport' => 'postMessage',
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'type_nav_color',
    'label'       => __( 'Nav Color', 'flatsome-admin' ),
	'section'     => 'main_bar',
    'transport' => $transport
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'type_nav_color_hover',
    'label'       => __( 'Nav Color:hover', 'flatsome-admin' ),
	'section'     => 'main_bar',
    'transport' => $transport
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'color-alpha',
    'alpha' => true,
    'settings'     => 'header_icons_color',
    'label'       => __( 'Icons Color', 'flatsome-admin' ), 
    'section'     => 'main_bar',
	'default'     => '',
	'transport' => $transport
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'color-alpha',
    'alpha' => true,
    'settings'     => 'header_icons_color_hover',
    'label'       => __( 'Icons Color :hover', 'flatsome-admin' ), 
    'section'     => 'main_bar',
	'default'     => '',
	'transport' => $transport
));



Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_transparent',
    'label'       => __( '', 'flatsome-admin' ),
    'section'     => 'main_bar',
    'default'     => '<div class="options-title-divider">Transparent Header</div>',
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'header_height_transparent',
	'label'       => __( 'Height - Transparent Header', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'default'     => '',
	'transport' => 'postMessage',
	'choices'     => array(
		'min'  => 30,
		'max'  => 500,
		'step' => 1
	),
));


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color-alpha',
    'settings'     => 'header_bg_transparent',
    'label'       => __( 'Transparent Header Background Color', 'flatsome-admin' ),
    'section'     => 'main_bar',
	'default'     => '',
	'transport' => 'postMessage',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
    'settings'     => 'header_bg_transparent_shade',
	'label'       => __( 'Add Shade', 'flatsome-admin' ),
	'section'     => 'main_bar',
	'transport' => 'postMessage',
	'default'     => 0,
));
