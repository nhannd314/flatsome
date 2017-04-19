<?php if(!class_exists( 'YITH_WCWL' )) return; ?>
<li class="header-wishlist-icon has-icon">
  <a href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>" class="wishlist-link">
    <i class="wishlist-icon icon-<?php echo flatsome_option('wishlist_icon');?>"
    <?php if(YITH_WCWL()->count_products() > 0){ ?>data-icon-label="<?php echo YITH_WCWL()->count_products() ; ?>" <?php } ?>>
    </i>   
  </a>
</li>