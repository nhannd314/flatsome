<?php

Flatsome_Option::add_panel( 'blog', array(
	'title'       => __( 'Blog', 'flatsome-admin' ),
) );

include_once(dirname( __FILE__ ).'/options-blog-layout.php');
include_once(dirname( __FILE__ ).'/options-blog-archive.php');
include_once(dirname( __FILE__ ).'/options-blog-single.php');
include_once(dirname( __FILE__ ).'/options-blog-featured.php');


function flatsome_refresh_blog_partials( WP_Customize_Manager $wp_customize ) {

  // Abort if selective refresh is not available.
  if ( ! isset( $wp_customize->selective_refresh ) ) {
      return;
  }

	$wp_customize->selective_refresh->add_partial( 'blog-layout', array(
	    'selector' => '.blog-wrapper.blog-archive',
	    'settings' => array('blog_posts_depth_hover','blog_posts_depth','blog_layout','blog_layout_divider','blog_show_excerpt'),
	    'render_callback' => function() {
	        return get_template_part( 'template-parts/posts/layout', get_theme_mod('blog_layout','right-sidebar') );
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'blog-layout-single', array(
	    'selector' => '.blog-wrapper.blog-single',
	    'settings' => array('blog_posts_depth_hover','blog_posts_depth','blog_post_layout','blog_post_style','blog_author_box','blog_share'),
	    'render_callback' => function() {
	        return get_template_part( 'template-parts/posts/layout', get_theme_mod('right-sidebar') );
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'blog-featured-posts', array(
	    'selector' => '.featured-posts',
	    'container_inclusive' => true,
	    'settings' => array('blog_featured_height'),
	    'render_callback' => function() {
	        return get_template_part('template-parts/posts/featured-posts');
	    },
	) );

}
add_action( 'customize_register', 'flatsome_refresh_blog_partials' );
