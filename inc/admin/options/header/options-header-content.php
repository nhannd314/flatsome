<?php

/*************
 * HTML content
 *************/

Flatsome_Option::add_section( 'header_content', array(
	'title'       => __( 'HTML', 'flatsome-admin' ),
	'panel'       => 'header',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'header-block-1',
	'transport' => $transport,
	'label'       => __( 'Header Block 1', 'flatsome-admin' ),
	'description' => __( 'Blocks can be edited in the page builder. Select a block, go to a page and open in the the Page Builder.', 'flatsome-admin' ),
	'section'     => 'header_content',
	'choices'	=> $blocks
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'header-block-2',
	'transport' => $transport,
	'label'       => __( 'Header Block 2', 'flatsome-admin' ),
	'description' => __( 'Blocks can be edited in the page builder. Select a block, go to a page and open in the the Page Builder.', 'flatsome-admin' ),
	'section'     => 'header_content',
	'choices'	=> $blocks
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'topbar_left',
	'transport' => $transport,
	'label'       => __( 'HTML 1', 'flatsome-admin' ),
	'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'header_content',
	'sanitize_callback' => 'flatsome_custom_sanitize',
	'default'     => '<strong class="uppercase">Add anything here or just remove it...</strong>',
));



Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'topbar_right',
	'transport' => $transport,
	'label'       => __( 'HTML 2', 'flatsome-admin' ),
	'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'header_content',
	'sanitize_callback' => 'flatsome_custom_sanitize',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'top_right_text',
	'transport' => $transport,
	'label'       => __( 'HTML 3', 'flatsome-admin' ),
	'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	'section'     => 'header_content',
	'sanitize_callback' => 'flatsome_custom_sanitize',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'nav_position_text_top',
	'transport' => $transport,
	'label'       => __( 'HMTL 4', 'flatsome-admin' ),
	'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	'section'     => 'header_content',
	'sanitize_callback' => 'flatsome_custom_sanitize',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'nav_position_text',
	'transport' => $transport,
	'label'       => __( 'HTML 5', 'flatsome-admin' ),
	'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	'section'     => 'header_content',
	'sanitize_callback' => 'flatsome_custom_sanitize',
));

function flatsome_refresh_header_content_partials( WP_Customize_Manager $wp_customize ) {

	if ( ! isset( $wp_customize->selective_refresh ) ) {
	      return;
	  }
	
	$wp_customize->selective_refresh->add_partial( 'top_right_text', array(
	    'selector' => '.html_top_right_text',
	    'settings' => array('top_right_text'),
	    'render_callback' => function() {
	        return flatsome_option('top_right_text');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'nav_position_text_top', array(
	    'selector' => '.html_nav_position_text_top',
	    'settings' => array('nav_position_text_top'),
	    'render_callback' => function() {
	        return flatsome_option('nav_position_text_top');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'topbar_left', array(
	    'selector' => '.html_topbar_left',
	    'settings' => array('topbar_left'),
	    'render_callback' => function() {
	        return flatsome_option('topbar_left');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'topbar_right', array(
	    'selector' => '.html_topbar_right',
	    'settings' => array('topbar_right'),
	    'render_callback' => function() {
	        return flatsome_option('topbar_right');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'nav_position_text', array(
	    'selector' => '.html_nav_position_text',
	    'settings' => array('nav_position_text'),
	    'render_callback' => function() {
	        return flatsome_option('nav_position_text');
	    },
	) );

	
	// Header block
	$wp_customize->selective_refresh->add_partial( 'header-block-1', array(
	    'selector' => '.header-block-1',
	    'settings' => array('header-block-1'),
	    'render_callback' => function() {
	  		return do_shortcode('[block id="'.flatsome_option('header-block-1').'"]');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'header-block-2', array(
	    'selector' => '.header-block-2',
	    'settings' => array('header-block-2'),
	    'render_callback' => function() {
	  		return do_shortcode('[block id="'.flatsome_option('header-block-2').'"]');
	    },
	) );
}
add_action( 'customize_register', 'flatsome_refresh_header_content_partials' );