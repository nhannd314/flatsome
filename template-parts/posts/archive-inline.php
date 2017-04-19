<?php if ( have_posts() ) : ?>
<div id="post-list">

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-inner <?php flatsome_blog_article_classes(); ?>">
		
		<header class="entry-header">
		  		<div class="entry-header-text text-<?php echo flatsome_option('blog_posts_title_align');?>">
				   	<?php get_template_part( 'template-parts/posts/partials/entry', 'title');  ?>
				</div><!-- .entry-header -->
		</header><!-- post-header -->
		<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
		<div class="entry-image-float">
	 		<?php get_template_part( 'template-parts/posts/partials/entry-image', 'default'); ?>
	 		<?php get_template_part( 'template-parts/posts/partials/entry', 'post-date'); ?>
	 	</div>
 		<?php } ?>
		<?php get_template_part('template-parts/posts/content', 'default' ); ?>
		<div class="clearfix"></div>
		<?php get_template_part('template-parts/posts/partials/entry-footer', 'default' ); ?>
	</div><!-- .article-inner -->
</article><!-- #-<?php the_ID(); ?> -->

<?php endwhile; ?>

<?php flatsome_posts_pagination(); ?>

</div>

<?php else : ?>

	<?php get_template_part( 'template-parts/posts/content','none'); ?>

<?php endif; ?>