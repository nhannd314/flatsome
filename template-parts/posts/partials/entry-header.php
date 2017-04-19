<header class="entry-header">
	<div class="entry-header-text entry-header-text-top  text-<?php echo flatsome_option('blog_posts_title_align');?>">
	   	<?php get_template_part( 'template-parts/posts/partials/entry', 'title');  ?>
	</div><!-- .entry-header -->

    <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
	<div class="entry-image relative">
	   <?php get_template_part( 'template-parts/posts/partials/entry-image', 'default'); ?>
	   <?php get_template_part( 'template-parts/posts/partials/entry', 'post-date'); ?>
	</div><!-- .entry-image -->
	<?php } ?>
</header><!-- post-header -->

