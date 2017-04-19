<?php get_template_part('template-parts/portfolio/portfolio-title', flatsome_option('portfolio_title')); ?>

<div class="portfolio-top">
	<div class="row page-wrapper">

	<div id="portfolio-content" class="large-12 col"  role="main">
		<div class="portfolio-inner pb">
			<?php get_template_part('template-parts/portfolio/portfolio-content'); ?>
		</div><!-- .portfolio-inner -->

		<div class="portfolio-summary entry-summary">
			<?php get_template_part('template-parts/portfolio/portfolio-summary','full'); ?>
		</div><!-- .entry-summary -->
	</div><!-- #portfolio-content .large-12 -->

	</div><!-- .row -->
</div><!-- .portfolio-top -->

<div class="portfolio-bottom">
	<?php get_template_part('template-parts/portfolio/portfolio-next-prev'); ?>
	<?php get_template_part('template-parts/portfolio/portfolio-related'); ?>
</div>