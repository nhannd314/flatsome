<?php
/*
Template name: Page - Vertical Sub-nav
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<div class="page-wrapper page-vertical-nav">
<div class="row">
<div class="large-3 col col-border">
	<h3 class="uppercase"><?php echo get_the_title($post->post_parent); ?></h3>

	 <?php 
    if ( is_page() && $post->post_parent )
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
	else
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
	if ( $childpages ) {
		$childpages = str_replace("current_page_item","active current_page_item", $childpages);
		$string = '<ul class="tabs-nav nav nav-uppercase nav-vertical nav-line">' . $childpages . '</ul>';
	}

	echo $string;

	?>
</div><!-- .large-3 -->

<div class="large-9 col">
	<div class="tabs-inner active">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->	

			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>

					<?php if ( comments_open() || '0' != get_comments_number() ){
							comments_template(); } ?>
				
				<?php endwhile; // end of the loop. ?>
						
			</div>

	</div><!-- .tabs-inner -->
	</div><!-- .large-9 -->
</div><!-- .row -->
</div><!-- .page-wrapper -->

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>