<?php while ( have_posts() ) : the_post(); ?>
		<?php if(get_the_content()) {the_content();} else {
			the_post_thumbnail('large');
		}; ?>
<?php endwhile; wp_reset_query(); // end of the loop. ?>