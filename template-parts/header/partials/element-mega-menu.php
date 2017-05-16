<div id="mega-menu-wrap">
    <div id="mega-menu-title"><i class="fa fa-bars"></i> <?php esc_html_e( 'DANH MỤC SẢN PHẨM', 'flatsome' ) ?></div>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'mega_menu',
        'container'       => false,
        'menu_id' => 'mega_menu',
        'depth'           => 0
    ));
    ?>
</div>