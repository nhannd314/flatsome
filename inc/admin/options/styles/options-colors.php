<?php

/*************
 * Style & Colors
 *************/

Flatsome_Option::add_panel( 'style', array(
	'title'       => __( 'Style', 'flatsome-admin' ),
) );


Flatsome_Option::add_section( 'colors', array(
	'title'       => __( 'Colors', 'flatsome-admin' ),
	'panel'       => 'style',
) );


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_colors_main',
    'label'       => __( '', 'flatsome-admin' ),
    'section'     => 'colors',
    'default'     => '<div class="options-title-divider">Main Colors</div>',
) );


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'color_primary',
    'label'       => __( 'Primary Color', 'flatsome-admin' ),
    'description' => __('Change primary color.', 'flatsome-admin'),
    'section'     => 'colors',
    'default'    => '#446084',
    'transport' => $transport
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'color_secondary',
    'transport' => $transport,
    'label'       => __( 'Secondary Color', 'flatsome-admin' ),
    'description' => __('Change secondary color.', 'flatsome-admin'),
    'default'     => '#d26e4b',
    'section'     => 'colors',
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'color_success',
    'transport' => $transport,
    'label'       => __( 'Success Color', 'flatsome-admin' ),
    'description' => __('Change the success color. Used for global success messages.', 'flatsome-admin'),
    'section'     => 'colors',
    'default'     => '#7a9c59'
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'color_alert',
    'transport' => $transport,
    'label'       => __( 'Alert Color', 'flatsome-admin' ),
    'description' => __('Change the alert color. Used for global error messages etc.', 'flatsome-admin'),
    'section'     => 'colors',
    'default'     => '#b20000'
));
#d26e4b

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_color_type',
    'label'       => __( '', 'flatsome-admin' ),
    'section'     => 'colors',
    'default'     => '<div class="options-title-divider">Type</div>',
) );

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'color_texts',
    'label'       => __( 'Base Color', 'flatsome-admin' ),
    'description' => __('Used for all normal texts.', 'flatsome-admin'),
    'section'     => 'colors',
    'default'     => '#777',
    'transport' => $transport
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'type_headings_color',
    'label'       => __( 'Headline Color', 'flatsome-admin' ),
    'description' => __('Used for all headlines on white backgrounds. (H1, H2, H3 etc.)', 'flatsome-admin'),
    'section'     => 'colors',
    'default'     => '#555',
    'transport' => $transport
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color-alpha',
    'settings'     => 'color_divider',
    'label'       => __( 'Divider Color', 'flatsome-admin' ),
    'description' => __('Used for dividers.', 'flatsome-admin'),
    'section'     => 'colors',
));

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_type_links',
    'label'       => __( '', 'flatsome-admin' ),
    'section'     => 'colors',
    'default'     => '<div class="options-title-divider">Links</div>',
) );

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'color_links',
    'label'       => __( 'Link Colors', 'flatsome-admin' ),
    'section'     => 'colors',
    'default'     => '#4e657b',
    'transport' => $transport
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'color_links_hover',
    'label'       => __( 'Link Colors:hover', 'flatsome-admin' ),
    'section'     => 'colors',
    'default'     => '#111',
    'transport' => $transport
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'color_widget_links',
    'label'       => __( 'Widget Link Colors', 'flatsome-admin' ),
    'section'     => 'colors',
    'default'     => '',
    'transport' => $transport
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'color',
    'settings'     => 'color_widget_links_hover',
    'label'       => __( 'Widget Link Colors:Hover', 'flatsome-admin' ),
    'section'     => 'colors',
    'default'     => '',
    'transport' => $transport
));

if(is_woocommerce_activated()){
    Flatsome_Option::add_field( '', array(
        'type'        => 'custom',
        'settings' => 'custom_title_colors_shop',
        'label'       => __( '', 'flatsome-admin' ),
        'section'     => 'colors',
        'default'     => '<div class="options-title-divider">Shop Colors</div>',
    ) );


    Flatsome_Option::add_field( 'option',  array(
        'type'        => 'color',
        'settings'     => 'color_checkout',
        'label'       => __( 'Add to cart / Checkout buttons', 'flatsome-admin' ),
        'description' => __( 'Change color for checkout buttons. Default is Secondary color', 'flatsome-admin' ),
        'section'     => 'colors',
        'transport' => $transport
    ));

    Flatsome_Option::add_field( 'option',  array(
        'type'        => 'color',
        'settings'     => 'color_sale',
        'label'       => __( 'Sale bubble', 'flatsome-admin' ),
        'description' => __( 'Change color of sale bubble. Default is Secondary color', 'flatsome-admin' ),
        'section'     => 'colors',
        'transport' => $transport
    ));

    Flatsome_Option::add_field( 'option',  array(
        'type'        => 'color',
        'settings'     => 'color_new_bubble',
        'label'       => __( 'New bubble', 'flatsome-admin' ),
        'description' => __( 'Change color of the "New" bubble.', 'flatsome-admin' ),
        'section'     => 'colors',
        'transport' => $transport
    ));

    Flatsome_Option::add_field( 'option',  array(
        'type'        => 'color',
        'settings'     => 'color_review',
        'label'       => __( 'Review Stars', 'flatsome-admin' ),
        'description' => __( 'Change color of review stars', 'flatsome-admin' ),
        'section'     => 'colors',
        'transport' => $transport
    ));
}