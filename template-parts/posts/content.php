<div class="entry-content">
	<?php if ( flatsome_option('blog_show_excerpt') || is_search())  { ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<div class="text-<?php echo flatsome_option('blog_posts_title_align');?>">
			<a class="more-link button primary is-outline is-smaller" href="<?php echo get_the_permalink(); ?>"><?php echo _e('Continue reading <span class="meta-nav">&rarr;</span>', 'flatsome'); ?></a>
		</div>
	</div><!-- .entry-summary -->
	<?php } else { ?>
	<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'flatsome' ) ); ?>
	<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'flatsome' ),
			'after'  => '</div>',
		) );
	?>
<?php }; ?>

</div><!-- .entry-content -->