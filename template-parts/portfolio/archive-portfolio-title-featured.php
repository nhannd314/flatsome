<div class="page-title portfolio-featured-title featured-title no-overflow">

	<div class="page-title-bg">
		<div class="title-bg fill bg-fill" data-parallax-container=".page-title" data-parallax-background  data-parallax="-4"
		<?php if(get_theme_mod('portfolio_archive_bg')) echo 'style="background-image:url('.do_shortcode(get_theme_mod('portfolio_archive_bg')).')"'; ?>>
		</div>
		<div class="title-overlay fill" style="background-color: rgba(0,0,0,.6)"></div>
	</div>

	<div class="page-title-inner container  flex-row  dark">
	 	<div class="flex-col flex-grow">
	 		<?php do_action('flatsome_portfolio_title_left'); ?>
	 	</div>
	 	<div class="flex-col flex-center text-center" data-parallax="-1" data-parallax-fade="true">
			<h1 class="entry-title is-xlarge uppercase">
				<?php
				if(is_tax()){
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					echo $term->name;
				} else { the_title(); } ?>
			</h1>
			<?php do_action('flatsome_portfolio_title_after'); ?>
	 	</div>
	 	<div class="flex-col flex-grow text-right">
			<?php do_action('flatsome_portfolio_title_right'); ?>
	 	</div>
	</div><!-- flex-row -->
</div><!-- .page-title -->
