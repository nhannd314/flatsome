<?php

/*************
 * Header Main
 *************/

Flatsome_Option::add_section( 'header-layout', array(
	'title'       => __( 'Elements', 'flatsome-admin' ),
	'panel'       => 'header',
	//'description' => __( 'This is the section description', 'flatsome-admin' ),
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'flatsome_version',
	'label'       => __( 'Flatsome Version', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'topbar_elements_left',
	'label'       => __( '← Left Elements', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'multiple'    => 5,
	'default'     => flatsome_topbar_elements_left(),
	'transport' => $transport,
	'choices'     => $nav_elements
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'topbar_elements_center',
	'label'       => __( 'Center Elements', 'flatsome-admin' ),
	//'description' => __( 'This is the control description', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'multiple'    => 5,
	'default'     => array(),
	'transport' => $transport,
	'choices'     => $nav_elements
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'topbar_elements_right',
	'label'       => __( 'Right Elements →', 'flatsome-admin' ),
	//'description' => __( 'This is the control description', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'multiple'    => 5,
	'transport' => $transport,
	'default'     => flatsome_topbar_elements_right(),
	'choices'     => $nav_elements
));


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_header_layout_main',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'header-layout',
    'default'     => '<div class="options-title-divider">Main Header</div>',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'header_elements_left',
	'label'       => __( 'Left Elements', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'transport' => 'postMessage',
	'multiple' => 5,
	'default'     => flatsome_header_elements_left(),
	'choices'     => $nav_elements
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'header_elements_right',
	'label'       => __( 'Right Elements', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'transport' => 'postMessage',
	'multiple' => 5,
	'default'     => flatsome_header_elements_right(),
	'choices'     => $nav_elements
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'header_elements_bottom_left',
	'label'       => __( 'Left Elements', 'flatsome-admin' ),
	//'description' => __( 'This is the control description', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'multiple'    => 5,
	'default'     => flatsome_header_elements_bottom_left(),
	'transport' => $transport,
	'choices'     => $nav_elements
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'header_elements_bottom_center',
	'label'       => __( 'Left Elements', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'multiple'    => 5,
	'default'     => flatsome_header_elements_bottom_center(),
	'transport' => $transport,
	'choices'     => $nav_elements
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'header_elements_bottom_right',
	'label'       => __( 'Right Elements', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'multiple'    => 5,
	'default'     => flatsome_header_elements_bottom_right(),
	'transport' => $transport,
	'choices'     => $nav_elements
));



Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'header_mobile_elements_top',
	'label'       => __( 'Mobile Top', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'multiple'    => 5,
	'default'     => flatsome_header_mobile_elements_top(),
	'transport' => $transport,
	'choices'     => $nav_elements
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'header_mobile_elements_left',
	'label'       => __( 'Left Elements', 'flatsome-admin' ),
	//'description' => __( 'This is the control description', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'multiple'    => 5,
	'default'     => flatsome_header_mobile_elements_left(),
	'transport' => $transport,
	'choices'     => $nav_elements
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'header_mobile_elements_right',
	'label'       => __( 'Left Elements', 'flatsome-admin' ),
	//'description' => __( 'This is the control description', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'multiple'    => 5,
	'default'     => flatsome_header_mobile_elements_right(),
	'transport' => $transport,
	'choices'     => $nav_elements
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'header_mobile_elements_bottom',
	'label'       => __( 'Left Elements', 'flatsome-admin' ),
	//'description' => __( 'This is the control description', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'header-layout',
	'multiple'    => 5,
	'default'     => array(),
	'transport' => $transport,
	'choices'     => $nav_elements
));