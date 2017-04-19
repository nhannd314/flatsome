<?php

$args = array(
	'posts_per_page' => 5,
	'post__in'  => get_option('sticky_posts'),
	'ignore_sticky_posts' => 0
);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) : ?>

<?php
	// Create IDS
	$ids = array();
	while ( $the_query->have_posts() ) : $the_query->the_post();
		array_push($ids, get_the_ID());
	endwhile; // end of the loop.

	// Set ids
	$ids = implode(',', $ids);

	$readmore = __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'flatsome' );
?>

<?php echo do_shortcode('[blog_posts class="featured-posts" slider_nav_style="circle" style="shade" show_category="text" text_align="center" text_padding="5% 15% 5% 15%" title_size="xlarge" readmore="'.$readmore.'" image_height="'.intval(flatsome_option('blog_featured_height')).'px" type="slider-full" depth="'.flatsome_option('blog_posts_depth').'" depth_hover="'.flatsome_option('blog_posts_depth_hover').'" columns="2" ids="'.$ids.'"]'); ?>

<?php endif; ?>