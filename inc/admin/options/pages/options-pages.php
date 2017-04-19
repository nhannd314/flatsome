<?php

/*************
 * Pages Panel
 *************/

Flatsome_Option::add_section( 'pages', array(
    'title'       => __( 'Pages', 'flatsome-admin' ),
    'description' => __( 'Change the default page layout for all pages. You can also override some of these options per page in the page editor.', 'flatsome-admin' ),
) );


Flatsome_Option::add_field( 'option', array(
    'type'        => 'select',
    'settings'     => 'pages_template',
    'label'       => __( 'Default - Page Template', 'flatsome-admin' ),
    'section'     => 'pages',
    'default'     => 'default',
    'choices'     => array(
        'default' => __( 'Container (Default)', 'flatsome-admin' ),
        'blank' => __( 'Full-Width', 'flatsome-admin' ),
        'transparent-header' => __( 'Full-Width - Transparent Header', 'flatsome-admin' ),
        'transparent-header-light' => __( 'Full-Width - Transparent Header Light', 'flatsome-admin' ),
        'right-sidebar' => __( 'Sidebar Right', 'flatsome-admin' ),
        'left-sidebar' => __( 'Sidebar Left', 'flatsome-admin' ),
    ),
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'checkbox',
    'settings'     => 'default_title',
    'label'       => __( 'Show H1 Page title on default page template', 'flatsome-admin' ),
    'section'     => 'pages',
    'default'     => 0,
));

?>