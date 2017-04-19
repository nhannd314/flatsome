<div class="page-title normal-title">
	<div class="page-title-inner container flex-row medium-flex-wrap medium-text-center">
	 	<div class="flex-col flex-grow">
	 		<h1 class="entry-title is-larger uppercase pb-0 pt-0 mb-0">
	 			<?php
				if(is_tax()){
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					echo $term->name;
				} else { the_title(); } ?>
			</h1>
	 	</div>
	 	<div class="flex-col flex-right">
			<?php echo get_flatsome_portfolio_breadcrumbs(); ?>
	 	</div>
	 
	</div><!-- flex-row -->
</div><!-- .page-title -->