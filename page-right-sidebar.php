<?php
/*
Template name: Page - Right sidebar
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<div class="page-wrapper page-right-sidebar">
<div class="row">

<div id="content" class="large-9 left col col-divided" role="main">
	<div class="page-inner">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>
				
				<?php if ( comments_open() || '0' != get_comments_number() ){
							comments_template(); } ?>

			<?php endwhile; // end of the loop. ?>

	</div><!-- .page-inner -->
</div><!-- .#content large-9 left -->

<div class="large-3 col">
	<?php get_sidebar(); ?>
</div><!-- .sidebar -->

</div><!-- .row -->
</div><!-- .page-right-sidebar container -->

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>