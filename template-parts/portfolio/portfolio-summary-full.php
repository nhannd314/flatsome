<div class="row">
	<?php if(!flatsome_option('portfolio_title')) { ?>
		<div class="large-4 col col-divided pb-0">

				<div class="featured_item_cats breadcrumbs pt-0">
					<?php echo get_the_term_list( get_the_ID(), 'featured_item_category', '', '<span class="divider">|</span>', '' ); ?> 
				</div>
				<h1 class="entry-title is-xlarge uppercase"><?php the_title(); ?></h1>
				<div class="portfolio-share is-small">
					<?php echo do_shortcode('[share style="small"]')?>
				</div>
		</div><!-- .large-4 -->
	<?php } ?>
	<div class="col col-fit pb-0">
		<?php the_excerpt();?>

	    <?php if(get_the_term_list( get_the_ID(), 'featured_item_tag')) { ?> 
	    <div class="item-tags is-small uppercase bt pb-half pt-half">
			<strong><?php _e('Tags','woocommerce'); ?>:</strong>
			<?php echo strip_tags (get_the_term_list( get_the_ID(), 'featured_item_tag', '', ' / ', '' )); ?>
		</div>
	    <?php } ?>
	    <?php if(flatsome_option('portfolio_title') =='featured') { ?>
			<div class="portfolio-share">
				<?php echo do_shortcode('[share]')?>
			</div>
		<?php } ?>
	</div><!-- .large-6 -->
</div><!-- .row -->