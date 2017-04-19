<?php

  $layout = get_theme_mod('category_sidebar', 'left-sidebar');
  if($layout == 'none') return;

  $class = 'show-for-medium';
  if($layout == 'off-canvas') $class = '';
  ?>
  <div class="category-filtering category-filter-row <?php echo $class; ?>">
      <a href="#" data-open="#shop-sidebar"  data-pos="left" class="filter-button uppercase plain">
          <i class="icon-menu"></i>
          <strong> <?php echo __( 'Filter', 'woocommerce' ); ?></strong>
      </a>
      <div class="inline-block">
          <?php the_widget('WC_Widget_Layered_Nav_Filters'); ?>
      </div>
  </div>
<?php
