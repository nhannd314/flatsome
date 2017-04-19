<?php  if(get_theme_mod('portfolio_next_prev',1) == 0) return; ?>
<div class="row">
<div class="large-12 col pb-0">
	<div class="flex-row flex-has-center next-prev-nav bt bb">
		<div class="flex-col flex-left text-left">
			<?php flatsome_previous_post_link_portfolio(); ?>
		</div>
		<div class="flex-col flex-right text-right">
		    <?php flatsome_next_post_link_portfolio(); ?>
		</div>
	</div>
</div>
</div>
