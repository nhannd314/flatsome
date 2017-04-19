<?php

Flatsome_Option::add_section( 'type', array(
    'title' => __( 'Typography', 'flatsome-admin' ),
    'panel'       => 'style',
) );



Flatsome_Option::add_field( 'option',  array(
    'type'        => 'checkbox',
    'settings'     => 'disable_fonts',
    'label'       => __( 'Disable google fonts. No fonts will be loaded from Google.', 'flatsome-admin' ),
    'section'  => 'type',
    'default'     => 0,
));

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_type_headings',
    'label'       => __( '', 'flatsome-admin' ),
    'section'  => 'type',
    'default'     => '<div class="options-title-divider">Headlines</div>',
) );

Flatsome_Option::add_field( 'option', array(
    'type'        => 'typography',
    'settings'    => 'type_headings',
    'description' => 'This is the font for all H1, H2, H3, H5, H6 titles.',
    'label'       => esc_attr__( 'Font', 'flatsome-admin' ),
    'transport' => 'auto',
    'section'  => 'type',
    'default'     => array(
        'font-family'    => 'Lato',
        'variant'        => '700',
    ),
) );




Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_type_base',
    'label'       => __( '', 'flatsome-admin' ),
    'section'  => 'type',
    'default'     => '<div class="options-title-divider">Base</div>',
) );

Flatsome_Option::add_field( 'option', array(
    'type'        => 'typography',
    'settings'    => 'type_texts',
    'label'       => esc_attr__( 'Base Text Font', 'flatsome-admin' ),
    'section'  => 'type',
    'default'     => array(
        'font-family'    => 'Lato',
        'variant' => '400',
    ),
) );

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'slider',
    'settings'     => 'type_size',
    'label'       => __( 'Base Font Size', 'flatsome-admin' ),
    'section'  => 'type',
    'description' => 'Set base font size in %.',
    'default'     => 100,
    'choices'     => array(
        'min'  => 50,
        'max'  => 200,
        'step' => 1
    ),
    'transport' => 'postMessage',
));

Flatsome_Option::add_field( 'option',  array(
    'type'        => 'slider',
    'settings'     => 'type_size_mobile',
    'label'       => __( 'Mobile Base Font Size', 'flatsome-admin' ),
    'section'  => 'type',
    'description' => 'Set mobile base font size in %.',
    'default'     => 100,
    'choices'     => array(
        'min'  => 50,
        'max'  => 200,
        'step' => 1
    ),
    'transport' => 'postMessage',
));

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_type_nav',
    'label'       => __( '', 'flatsome-admin' ),
    'section'  => 'type',
    'default'     => '<div class="options-title-divider">Navigation</div>',
) );

Flatsome_Option::add_field( 'option', array(
    'type'        => 'typography',
    'settings'    => 'type_nav',
    'label'       => esc_attr__( 'Font', 'flatsome-admin' ),
    'section'  => 'type',
    'transport' => $transport,
    'default'     => array(
        'font-family'    => 'Lato',
        'variant'        => '700',
    ),
) );

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_type_alt',
    'label'       => __( '', 'flatsome-admin' ),
    'section'  => 'type',
    'default'     => '<div class="options-title-divider">Alt Fonts</div>',
) );

Flatsome_Option::add_field( 'option', array(
    'type'        => 'typography',
    'settings'    => 'type_alt',
    'description' => 'Alt font can be selected in the Format dropdown in Text Editor.',
    'label'       => esc_attr__( 'Alt font (.alt-font)', 'flatsome-admin' ),
    'section'  => 'type',
    'transport' => $transport,
    'default'     => array(
        'font-family'    => 'Dancing Script',
    ),
) );

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_type_transform',
    'label'       => __( '', 'flatsome-admin' ),
    'section'  => 'type',
    'default'     => '<div class="options-title-divider">Text Transforms</div>',
) );

Flatsome_Option::add_field( 'option', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'text_transform_section_titles',
    'label'       => esc_attr__( 'Section Titles', 'flatsome-admin' ),
    'transport' => 'auto',
    'section'  => 'type',
    'default' => '',
    'choices'     => array(
        ''    => 'UPPERCASE',
        'none' => 'Normal',
    ),
) );

Flatsome_Option::add_field( 'option', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'text_transform_widget_titles',
    'label'       => esc_attr__( 'Widget Titles', 'flatsome-admin' ),
    'transport' => 'auto',
    'section'  => 'type',
    'default' => '',
    'choices'     => array(
        ''    => 'UPPERCASE',
        'none' => 'Normal',
    ),
) );

Flatsome_Option::add_field( 'option', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'text_transform_navigation',
    'label'       => esc_attr__( 'Navigation / Tabs', 'flatsome-admin' ),
    'transport' => 'auto',
    'section'  => 'type',
    'default' => '',
    'choices'     => array(
        ''    => 'UPPERCASE',
        'none' => 'Normal',
    ),
) );

Flatsome_Option::add_field( 'option', array(
    'type'        => 'radio-buttonset',
    'settings'    => 'text_transform_buttons',
    'label'       => esc_attr__( 'Buttons', 'flatsome-admin' ),
    'transport' => 'auto',
    'section'  => 'type',
    'default' => '',
    'choices'     => array(
        ''    => 'UPPERCASE',
        'none' => 'Normal',
    ),
) );
