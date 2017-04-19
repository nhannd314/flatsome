<?php if ( have_posts() ) : ?>

<?php
	// Create IDS
	$ids = array();
	while ( have_posts() ) : the_post();
		array_push($ids, get_the_ID());
	endwhile; // end of the loop.
	$ids = implode(',', $ids);

	$readmore = __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'flatsome' );
?>

<?php echo do_shortcode('[blog_posts type="masonry" depth="'.flatsome_option('blog_posts_depth').'" depth_hover="'.flatsome_option('blog_posts_depth_hover').'" text_align="left" columns="3" ids="'.$ids.'"]'); ?>

<?php flatsome_posts_pagination(); ?>

<?php else : ?>

	<?php get_template_part( 'template-parts/posts/content','none'); ?>

<?php endif; ?>