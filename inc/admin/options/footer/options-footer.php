<?php

/*************
 * Header Panel
 *************/

Flatsome_Option::add_section( 'footer', array(
	'title'       => __( 'Footer', 'flatsome-admin' ),
) );

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_custom_footer',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'footer',
    'default'     => '<div class="options-title-divider"  style="margin-bottom:15px">Custom Footer</div>',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'footer_block',
	'label'       => __( 'Custom Footer Block', 'flatsome-admin' ),
	'section'     => 'footer',
	'description'	=> __( 'You can replace the Footer with a Custom Block that you can edit in the Page Builder.', 'flatsome-admin' ),
	'default'     => false,
	'choices'     => $blocks
));

$hide_footer_options = array(
   	 array( 'setting' => 'footer_block', 'operator' => '==', 'value' => false),
);

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_html_footer_widgets',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'footer',
	'active_callback' => $hide_footer_options,
    'default'     => '<div class="options-title-divider" style="margin-bottom:15px">Widgets</div><p>Click the button to go to Footer Widgets</p><div><button style="margin-bottom:15px" class="button button-primary" data-to-panel="widgets">Edit Footer Widgets</button></div>',
) );

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_footer_1',
    'label'       => __( '', 'flatsome-admin' ),
   	'active_callback' => $hide_footer_options,
	'section'     => 'footer',
    'default'     => '<div class="options-title-divider">Footer 1</div>',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'footer_1',
	'active_callback' => $hide_footer_options,
	'transport' => $transport,
	'label'       => __( 'Enable Footer 1', 'flatsome-admin' ),
	'section'     => 'footer',
	'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'footer_1_columns',
	'label'       => __( 'Columns', 'flatsome-admin' ),
	'section'     => 'footer',
	'active_callback' => $hide_footer_options,
	'default'     => '4',
	'transport' => $transport,
	'choices'     => array(
		'6' => __( '6', 'flatsome-admin' ),
		'4' => __( '4', 'flatsome-admin' ),
		'3' => __( '3', 'flatsome-admin' ),
		'2' => __( '2', 'flatsome-admin' ),
		'1' => __( '1', 'flatsome-admin' ),
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'footer_1_color',
	'label'       => __( 'Text color', 'flatsome-admin' ),
	'active_callback' => $hide_footer_options,
	'section'     => 'footer',
	'default'     => 'light',
	'transport' => $transport,
	'choices'     => array(
		'dark' => $image_url . 'text-light.svg',
		'light' => $image_url . 'text-dark.svg'
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'color-alpha',
    'alpha' => true,
	'settings'     => 'footer_1_bg_color',
    'label'       => __( 'Background Color', 'flatsome-admin' ),
	'section'     => 'footer',
	'default'     => '#fff',
	'transport' => $transport,
	 'active_callback' => $hide_footer_options,
));


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'image',
	'settings'     => 'footer_1_bg_image',
    'label'       => __( 'Background Image', 'flatsome-admin' ),
	'section'     => 'footer',
	'default'     => "",
	'transport' => $transport,
	'active_callback' => $hide_footer_options,
));




Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_footer_2',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'footer',
    'default'     => '<div class="options-title-divider">Footer 2</div>',
   	'active_callback' => $hide_footer_options
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'footer_2',
	'transport' => $transport,
	'active_callback' => $hide_footer_options,
	'label'       => __( 'Enable Footer 2', 'flatsome-admin' ),
	'section'     => 'footer',
	'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'footer_2_columns',
	'label'       => __( 'Columns', 'flatsome-admin' ),
	'section'     => 'footer',
	'default'     => '4',
	'transport' => $transport,
	'choices'     => array(
		'6' => __( '6', 'flatsome-admin' ),
		'4' => __( '4', 'flatsome-admin' ),
		'3' => __( '3', 'flatsome-admin' ),
		'2' => __( '2', 'flatsome-admin' ),
		'1' => __( '1', 'flatsome-admin' ),
	),
	'active_callback' => $hide_footer_options,
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'footer_2_color',
	'label'       => __( 'Text color', 'flatsome-admin' ),
	'section'     => 'footer',
	'default'     => 'dark',
	'transport' => $transport,
	'choices'     => array(
		'dark' => $image_url . 'text-light.svg',
		'light' => $image_url . 'text-dark.svg'
	),
	'active_callback' => $hide_footer_options
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'color-alpha',
    'alpha' => true,
	'settings'     => 'footer_2_bg_color',
    'label'       => __( 'Background Color', 'flatsome-admin' ),
	'section'     => 'footer',
	'default'     => '#777',
	'transport' => $transport,
	'active_callback' => $hide_footer_options
));


Flatsome_Option::add_field( 'option',  array(
    'type'        => 'image',
	'settings'     => 'footer_2_bg_image',
    'label'       => __( 'Background Image', 'flatsome-admin' ),
	'section'     => 'footer',
	'default'     => "",
	'transport' => $transport,
	'active_callback' => $hide_footer_options
));


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_footer_absolute',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'footer',
    'default'     => '<div class="options-title-divider">Absolute Footer</div>',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'footer_bottom_text',
	'label'       => __( 'Text color', 'flatsome-admin' ),
	'section'     => 'footer',
	'default'     => 'dark',
	'transport' => $transport,
	'choices'     => array(
		'dark' => $image_url . 'text-light.svg',
		'light' => $image_url . 'text-dark.svg'
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'footer_bottom_align',
	'label'       => __( 'Align', 'flatsome-admin' ),
	'section'     => 'footer',
	'default'     => '',
	'transport' => $transport,
	'choices'     => array(
		'' => __( 'Left/Right', 'flatsome-admin' ),
		'center' => __( 'Center', 'flatsome-admin' ),
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'color-alpha',
    'alpha' => true,
	'settings'     => 'footer_bottom_color',
    'label'       => __( 'Background Color', 'flatsome-admin' ),
	'section'     => 'footer',
	'default'     => '',
	'transport' => $transport,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'footer_left_text',
	'label'       => __( 'Bottom Text - Primary', 'flatsome-admin' ),
	'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'footer',
	'transport' => $transport,
	'sanitize_callback' => 'flatsome_custom_sanitize',
	'default'     => 'Copyright [ux_current_year] &copy; <strong>UX Themes</strong>',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'footer_right_text',
	'label'       => __( 'Bottom Text - Secondary', 'flatsome-admin' ),
	'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	'section'     => 'footer',
	'transport' => $transport,
	'sanitize_callback' => 'flatsome_custom_sanitize',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'back_to_top',
	'transport' => $transport,
	'label'       => __( 'Back To Top Button', 'flatsome-admin' ),
	'section'     => 'footer',
	'default'     => 1,
));


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_footer_html',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'footer',
    'default'     => '<div class="options-title-divider">Footer HTML</div>',
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'html_before_footer',
	'label'       => __( 'HTML before footer', 'flatsome-admin' ),
	'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	'section'     => 'footer',
	'transport' => $transport,
	'sanitize_callback' => 'flatsome_custom_sanitize',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'html_after_footer',
	'label'       => __( 'HTML after footer', 'flatsome-admin' ),
	'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	'section'     => 'footer',
	'transport' => $transport,
	'sanitize_callback' => 'flatsome_custom_sanitize',
	'default'     => '',
));

function flatsome_refresh_footer_partials( WP_Customize_Manager $wp_customize ) {

  // Abort if selective refresh is not available.
  if ( ! isset( $wp_customize->selective_refresh ) ) {
      return;
  }

	$wp_customize->selective_refresh->add_partial( 'footer-layout', array(
	    'selector' => '.footer-wrapper',
	    'settings' => array('footer_2','footer_1','back_to_top','html_before_footer','html_after_footer','footer_2_color','footer_1_color','footer_2_columns','footer_1_columns'),
	    'render_callback' => function() {
	        return get_template_part('template-parts/footer/footer');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'footer-left-text', array(
	    'selector' => '.copyright-footer',
	    'settings' => array('footer_left_text'),
	    'render_callback' => function() {
	        return do_shortcode(flatsome_option('footer_left_text'));
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'footer-right-text', array(
	    'selector' => '.footer-secondary .footer-text',
	    'settings' => array('footer_right_text'),
	    'render_callback' => function() {
	        return do_shortcode(flatsome_option('footer_right_text'));
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'footer-absolute', array(
	    'selector' => '.absolute-footer',
	    'settings' => array('footer_bottom_align','footer_bottom_text'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return get_template_part('template-parts/footer/footer-absolute');
	    },
	) );

		// Refresh custom styling / Colors etc.
	$wp_customize->selective_refresh->add_partial( 'refresh_css_footer', array(
	    'selector' => 'head > style#custom-css',
	    'container_inclusive' => true,
	    'settings' => array('footer_1_bg_image','footer_2_bg_image'),
	    'render_callback' => function() {
	        return 	flatsome_custom_css();
	    },
	) );

}
add_action( 'customize_register', 'flatsome_refresh_footer_partials' );
