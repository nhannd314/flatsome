<?php while ( have_posts() ) : the_post(); ?>
  <div class="page-title blog-featured-title featured-title no-overflow">

  	<div class="page-title-bg fill">
  		<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
  		<div class="title-bg fill bg-fill bg-top" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large'); ?>');" data-parallax-fade="true" data-parallax="-2" data-parallax-background data-parallax-container=".page-title"></div>
  		<?php } ?>
  		<div class="title-overlay fill" style="background-color: rgba(0,0,0,.5)"></div>
  	</div>

  	<div class="page-title-inner container  flex-row  dark is-large" style="min-height: 300px">
  	 	<div class="flex-col flex-center text-center">
  			<?php get_template_part( 'template-parts/posts/partials/entry', 'title');  ?>
  	 	</div>
  	</div><!-- flex-row -->
  </div><!-- .page-title -->
<?php endwhile; ?>
