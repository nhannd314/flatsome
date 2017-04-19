<?php get_template_part('template-parts/portfolio/portfolio-title', flatsome_option('portfolio_title')); ?>

<div class="portfolio-top">
	<div id="portfolio-content" role="main" class="page-wrapper">
		<div class="portfolio-inner">
			<?php get_template_part('template-parts/portfolio/portfolio-content'); ?>
		</div><!-- .portfolio-inner -->
	</div><!-- #portfolio-content -->

	<div class="row">
	<div class="large-12 col">
		<div class="portfolio-summary entry-summary">
			<?php get_template_part('template-parts/portfolio/portfolio-summary','full'); ?>
		</div><!-- .portfolio-summary .entry-summary -->
	</div><!-- .large-12 -->
	</div><!-- .row -->
</div><!-- portfolio-top -->

<div class="portfolio-bottom">
	<?php get_template_part('template-parts/portfolio/portfolio-next-prev'); ?>
	<?php get_template_part('template-parts/portfolio/portfolio-related'); ?>
</div>