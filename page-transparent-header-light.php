<?php
/*
Template name: Page - Full Width - Transparent header - Light text
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>
			
			<?php endwhile; // end of the loop. ?>
</div>

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>


