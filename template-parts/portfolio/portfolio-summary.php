<?php if(!flatsome_option('portfolio_title')) { ?>
	<div class="featured_item_cats breadcrumbs mb-half">
		<?php echo get_the_term_list( get_the_ID(), 'featured_item_category', '', '<span class="divider">|</span>', '' ); ?>
	</div>
	<h1 class="entry-title uppercase"><?php the_title(); ?></h1>
<?php } ?>

<?php the_excerpt();?>

<div class="portfolio-share">
	<?php echo do_shortcode('[share style="small"]')?>
</div>

<?php if(get_the_term_list( get_the_ID(), 'featured_item_tag')) { ?>
<div class="item-tags is-small bt pt-half uppercase">
	<strong><?php _e('Tags','woocommerce'); ?>:</strong>
	<?php echo strip_tags (get_the_term_list( get_the_ID(), 'featured_item_tag', '', ' / ', '' )); ?>
</div>
<?php } ?>
