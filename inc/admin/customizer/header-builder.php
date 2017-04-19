<?php

/* Add Header builder */
function flatsome_customizer_header_builder(){
    global $nav_elements;
    ?>
    <div class="header-builder">
      <h3>
        <span class="title left">Header Builder</span>
        <span class="center display-toggle">
            <a class="button button-primary enable-desktop">Desktop</a>
            <a class="button button-primary enable-tablet">Mobile / Tablet</a>
        </span>
        <span class="right">
            <a class="button button-secondary header-preset-button" data-section="header-presets" style="margin-right: 5px;">Presets</a>
            <a href="//www.youtube.com/watch?v=YE-lOavbrjU" target="_blank" class="button" style="margin-right: 5px;">Tutorial</a>
            <a class="button header-clear-button" style="margin-right: 5px;">Clear All</a>
            <a class="button header-close-button" style="margin-right: 10px;">✕ Close</a>
        </span>
      </h3>

      <div class="hb-wrapper hb-wrapper-desktop">

        <div class="hb-wrap hb-desktop">

            <div class="hb hb-top">
                <div class="hb-tooltip" data-section="top_bar">Top bar <i class="dashicons dashicons-admin-generic"></i></div>

                <div class="hb-left hb-drop"
                    data-id="topbar_elements_left">
                </div>
                <div class="hb-center hb-drop"
                    data-id="topbar_elements_center">
                </div>
                <div class="hb-right hb-drop"
                    data-id="topbar_elements_right">
                </div>
            </div>
            <div class="hb hb-main">
                <div class="hb-tooltip" data-section="main_bar">Header Main <i class="dashicons dashicons-admin-generic"></i></div>
                <div class="hb-logo" data-tooltip="Logo" data-section="title_tagline">
                     <strong>Logo <i class="dashicons dashicons-admin-generic"></i></strong>
                </div>
                <div class="hb-left hb-drop" data-id="header_elements_left">
                </div>
                <div class="hb-right hb-drop" data-id="header_elements_right">
                </div>
            </div>
            <div class="hb hb-bottom">
                <div class="hb-tooltip" data-section="bottom_bar">Header Bottom <i class="dashicons dashicons-admin-generic"></i></div>
                <div class="hb-left hb-drop"
                    data-id="header_elements_bottom_left">
                </div>
                <div class="hb-center hb-drop"
                    data-id="header_elements_bottom_center">
                </div>
                <div class="hb-right hb-drop"
                    data-id="header_elements_bottom_right">
                </div>
            </div>

        </div>
         <div class="hb hb-avaiable hb-avaiable-desktop">
         <div class="hb-tooltip">Not in use</div>
                <div class="hb-list hb-drop">
                    <?php
                        foreach ($nav_elements as $key => $value) {
                           echo '<span data-id="'.$key.'">'.$value.'<i class="dashicons dashicons-admin-generic"></i></span>';
                        }
                    ?>
                </div>
            </div>
        </div><!-- .hb-wrapper -->

        <div class="hb-wrapper hb-wrapper-mobile">

        <div class="hb-wrap hb-mobile">
            <div class="hb hb-top">
                <div class="hb-center hb-drop-mobile"
                data-id="header_mobile_elements_top">
                </div>
            </div>
            <div class="hb hb-main">
                <div class="hb-tooltip" data-section="header_mobile">Header Mobile<i class="dashicons dashicons-admin-generic"></i></div>
                <div class="hb-logo"
                data-tooltip="Logo"
                data-section="title_tagline">
                LOGO</div>
                <div class="hb-left hb-drop-mobile"
                    data-id="header_mobile_elements_left">
                </div>
                <div class="hb-right hb-drop-mobile"
                data-id="header_mobile_elements_right">
                </div>
            </div>
            <div class="hb hb-bottom">
                <div class="hb-full hb-center hb-drop-mobile"
                data-id="header_mobile_elements_bottom">
                </div>
            </div>

        </div><!-- Mobile -->

        <div class="hb hb-avaiable hb-avaiable-mobile">
        <div class="hb-tooltip">Not in use</div>
                <div class="hb-list hb-drop-mobile">
                    <?php
                        foreach ($nav_elements as $key => $value) {
                           echo '<span data-id="'.$key.'">'.$value.'<i class="dashicons dashicons-admin-generic"></i></span>';
                        }
                    ?>
                </div>
        </div>

        </div><!-- .mobile wrap -->
        </div><!-- .hb-wrapper -->

    </div>
    <?php
}
add_action('customize_controls_print_footer_scripts', 'flatsome_customizer_header_builder');
