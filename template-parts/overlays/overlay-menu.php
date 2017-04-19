<!-- Mobile Sidebar -->
<div id="main-menu" class="mobile-sidebar no-scrollbar mfp-hide">
    <div class="sidebar-menu no-scrollbar <?php if(get_theme_mod('mobile_overlay') == 'center') echo 'text-center';?>">
        <ul class="nav nav-sidebar <?php if(get_theme_mod('mobile_overlay') == 'center') echo 'nav-anim';?> nav-vertical nav-uppercase">
              <?php flatsome_header_elements('mobile_sidebar','sidebar'); ?>
        </ul>
    </div><!-- inner -->
</div><!-- #mobile-menu -->
