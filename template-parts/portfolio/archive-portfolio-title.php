<div class="page-title">
	<div class="page-title-inner container flex-row">
	 	<div class="flex-col flex-grow">
			<h1 class="entry-title uppercase mb-0">
				<?php
				if(is_tax()){
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					echo $term->name;
				} else { the_title(); } ?>
			</h1>
	 	</div>
	</div><!-- flex-row -->
</div><!-- .page-title -->