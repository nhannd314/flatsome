<div class="page-title portfolio-featured-title featured-title no-overflow">

	<div class="page-title-bg fill">
		<div class="title-bg fill bg-fill" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>');" data-parallax-container=".page-title" data-parallax="-2" data-parallax-background></div>
		<div class="title-overlay fill" style="background-color: rgba(0,0,0,.6)"></div>
	</div>

	<div class="page-title-inner container  flex-row  dark">
	 	<div class="flex-col flex-center text-center">
	 		<div class="featured_item_cats breadcrumbs pb-0 op-7">
				<?php echo get_the_term_list( get_the_ID(), 'featured_item_category', '', ', ', '' ); ?>
			</div>
			<h1 class="entry-title is-xlarge uppercase"><?php the_title(); ?></h1>
			<?php do_action('flatsome_portfolio_title_after'); ?>
	 	</div>
	</div><!-- flex-row -->
</div><!-- .page-title -->
