<?php
/*
Template name: Page - Left sidebar
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<div  class="page-wrapper page-left-sidebar">
<div class="row">

<div id="content" class="large-9 right col" role="main">
	<div class="page-inner">
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php the_content(); ?>
				
				<?php if ( comments_open() || '0' != get_comments_number() ){
							comments_template(); } ?>

			<?php endwhile; // end of the loop. ?>
	</div><!-- .page-inner -->
</div><!-- end #content large-9 left -->

<div class="large-3 col col-first col-divided">
<?php get_sidebar(); ?>
</div><!-- end sidebar -->

</div><!-- end row -->
</div><!-- end page-right-sidebar container -->


<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
