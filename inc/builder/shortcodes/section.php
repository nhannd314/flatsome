<?php

add_ux_builder_shortcode( 'section', array(
    'type' => 'container',
    'name' => __( 'Section','ux-builder'),
    'category' => __( 'Layout' ),
    'template' => flatsome_ux_builder_template( 'section.html' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'section' ),
    'wrap' => false,
    'info' => '{{ label }}',
    'priority' => -1,
    'styles' => array(
        'flatsome-banner-effect' => get_template_directory_uri() . '/assets/css/effects.css'
    ),

    'presets' => array(
        array(
            'name' => __( 'Default' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/simple-white' ),
            'content' => '[section]  [/section]',
        ),
        array(
            'name' => __( 'Default Dark' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/simple-center' ),
            'content' => '[section bg_color="rgb(40, 40, 40)" dark="true"]  [/section]',
        ),
        array(
            'name' => __('Simple Light'),
             'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/simple-light' ),
            'content' => '[section label="Simple Light" bg_color="rgb(245, 245, 245)" padding="60px" height="300px" border="1px 0px 0px 0px" border_color="rgb(235, 235, 235)"] [row] [col span="4" span__sm="12"] <h2 class="uppercase">This is a headline</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [col span="4" span__sm="12"] <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [col span="4" span__sm="12"] <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [/row] [/section]',
        ),
        array(
            'name' => __('Simple Center'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/simple-center' ),
            'content' => '[section label="Simple Center" bg_color="rgb(245, 245, 245)" padding="60px" height="300px" border_color="rgb(235, 235, 235)"] [row h_align="center"] [col span="10" align="center" span__sm="12"] <h2 class="uppercase">This is a headline</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [/row] [/section]'
         ),
         array(
            'name' => __('Arrow Top'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/arrow-down' ),
            'content' => '[section label="Section with arrow" bg_color="rgb(0, 0, 0)" bg_overlay="rgba(0, 0, 0, 0.4)" dark="true" mask="arrow" padding="59px" height="300px" border="1px 0px 0px 0px" border_color="rgb(235, 235, 235)"] [row] [col span="4" span__sm="12" text_depth="2"] <h2 class="uppercase">This is a headline with arrow on top</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [col span="4" span__sm="12" text_depth="2"] <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [col span="4" span__sm="12" text_depth="2"] <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [/row] [/section]'
        ),
         array(
            'name' => __('Box Right Dark'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/box-right-dark' ),
            'content' => '[section label="Dark section with box right" bg_color="rgb(171, 171, 171)" bg_overlay="rgba(0, 0, 0, 0.64)" padding="59px" height="300px" border="1px 0px 0px 0px" border_color="rgb(235, 235, 235)"] [row style="large" v_align="middle" h_align="center"] [col span="6" span__sm="12" align="center" color="light"] <h2>Dark section with content right</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [col span="6" span__sm="12" padding="15px 15px 15px 15px" align="left" bg_color="rgb(255, 255, 255)" animate="flipInY" depth="2" depth_hover="5"] [/col] [/row] [/section]'
        ),
        array(
            'name' => __('Box Left Dark'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/box-left-dark' ),
            'content' => '[section label="Dark section with box left" bg_color="rgb(171, 171, 171)" bg_overlay="rgba(0, 0, 0, 0.78)" padding="59px" height="300px" border="1px 0px 0px 0px" border_color="rgb(235, 235, 235)"] [row style="large" v_align="middle" h_align="center"] [col span="6" span__sm="12" padding="15px 15px 15px 15px" bg_color="rgb(255, 255, 255)" depth="2" depth_hover="5"] [/col] [col span="6" span__sm="12" align="center" color="light"] <h2>Dark section with content left</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [button text="Add Any content here"] [/col] [/row] [/section]'
        ),
         array(
            'name' => __('Box Right'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/box-right' ),
            'content' => '[section label="Section with box left" bg_color="rgb(228, 228, 228)" padding="59px" height="300px" border="1px 0px 0px 0px" border_color="rgb(235, 235, 235)"] [row style="large" v_align="middle" h_align="center"] [col span="6" span__sm="12" align="center"] <h2>Section with content right</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [col span="6" span__sm="12" padding="15px 15px 15px 15px" bg_color="rgb(255, 255, 255)" depth="2" depth_hover="5"] [/col] [/row] [/section]'
        ),
        array(
            'name' => __('Box Left'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/box-left' ),
            'content' => '[section bg_color="rgb(240, 240, 240)" padding="59px" height="300px" border="1px 0px 0px 0px" border_color="rgb(235, 235, 235)"] [row style="large" v_align="middle" h_align="center"] [col span="6" span__sm="12" padding="15px 15px 15px 15px" bg_color="rgb(255, 255, 255)" depth="2" depth_hover="5"] [/col] [col span="6" span__sm="12" align="center"] <h2>Section with content left</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [/row] [/section]'
        ),
         array(
            'name' => __('Media Left'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/media-left' ),
            'content' => '[section label="Media Left" bg_color="rgb(193, 193, 193)" bg_overlay="rgba(255, 255, 255, 0.85)" padding="60px"] [row style="large" v_align="middle"] [col span="6" span__sm="12"] [ux_image] [/col] [col span="6" span__sm="12" align="left"] <h2>Section with image left</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [button text="Add Any content here"] [/col] [/row] [/section]'
        ),
        array(
            'name' => __('Media Right'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/media-right' ),
            'content' => '[section label="Media Right" bg_color="rgb(193, 193, 193)" bg_overlay="rgba(255, 255, 255, 0.85)" padding="60px"] [row style="large" v_align="middle"] [col span="6" span__sm="12" align="left"] <h2>Section with Image right</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [button text="Add Any content here"] [/col] [col span="6" span__sm="12"] [ux_image] [/col] [/row] [/section]'
        ),
        array(
            'name' => __('Media Left Large'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/media-right-large' ),
            'content' => '[section label="Media Left Large" bg_color="rgb(247, 247, 247)" bg_overlay="rgba(255, 255, 255, 0.85)" padding="0px"] [row style="collapse" width="full-width" v_align="middle"] [col span="6" span__sm="12"] [ux_image] [/col] [col span="6" span__sm="12" padding="10% 10% 10% 10%" align="center" max_width="520px"] <h2>Section with large image left</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [button text="Add Any content here"] [/col] [/row] [/section]'
        ),
        array(
            'name' => __('Media Right Large'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/media-right-large' ),
            'content' => '[section label="Media Right Large" bg_color="rgb(247, 247, 247)" bg_overlay="rgba(255, 255, 255, 0.85)" padding="0px"] [row style="collapse" width="full-width" v_align="middle"] [col span="6" span__sm="12" padding="10% 10% 10% 10%" align="center" max_width="520px"] <h2>Section with large image right</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [col span="6" span__sm="12"] [ux_image] [/col] [/row] [/section]'
        ),

        array(
            'name' => __('Media Right Large Dark'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/media-right-large-dark' ),
            'content' => '[section label="Media right large" bg_color="rgb(64, 64, 64)" bg_overlay="rgba(0, 0, 0, 0.7)" dark="true" padding="0px"] [row style="collapse" width="full-width" v_align="middle"] [col span="6" span__sm="12" padding="5% 5% 5% 0px" align="left" max_width="520px"] <h2>Dark Section with large image right</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [button text="Add Any content here"] [/col] [col span="6" span__sm="12"] [ux_image] [/col] [/row] [/section]'
        ),
        array(
            'name' => __('Media Left Large Dark'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/media-left-large-dark' ),
            'content' => '[section label="Media Left Large" bg_color="rgb(64, 64, 64)" bg_overlay="rgba(0, 0, 0, 0.73)" dark="true" padding="0px"] [row style="collapse" width="full-width" v_align="middle"] [col span="6" span__sm="12"] [ux_image] [/col] [col span="6" span__sm="12" padding="5% 5% 5% 5%" align="left" max_width="520px"] <h2>Dark Section with a large image left</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [button text="Add Any content here"] [/col] [/row] [/section]'
        ),
        array(
            'name' => __('Media Center'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/media-center' ),
            'content' => '[section label="Media Center" bg_color="rgb(193, 193, 193)" bg_overlay="rgba(255, 255, 255, 0.85)"] [row style="large" h_align="center"] [col span="3" span__sm="12" align="right"] <h2>Section with Image center</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [col span="5" span__sm="12"] [ux_image] [/col] [col span="3" span__sm="12" align="left"] <h2>Section with Image center</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [/row] [/section]'
        ),
        array(
            'name' => __('Media Top'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/media-top' ),
            'content' => '[section label="Media Top" bg_color="rgb(193, 193, 193)" bg_overlay="rgba(255, 255, 255, 0.85)" padding="0px"] [row style="large" h_align="center"] [col] [ux_image] [/col] [col span="7" span__sm="12" align="center"] <h2>Section with Image Top</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [/row] [/section]'
        ),
        array(
            'name' => __('Media Bottom'),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'sections/media-bottom' ),
            'content' => '[section label="Media Bottom" bg_color="rgb(208, 208, 208)" bg_overlay="rgba(255, 255, 255, 0.85)" padding="0px"] [row style="collapse" h_align="center"] [col span="6" span__sm="12" padding="50px 0px 50px 0px" align="center"] <h2>Section with Image Bottom</h2> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> [/col] [col] [ux_image] [/col] [/row] [/section]'
        )
    ),

    'options' => array(
        'label' => array(
            'type' => 'textfield',
            'heading' => 'Admin label',
            'placeholder' => 'Enter admin label...'
        ),
        'class' => array(
            'type' => 'textfield',
            'heading' => 'Class',
            'default' => '',
        ),
        'visibility'  => require( __DIR__ . '/commons/visibility.php' ),

        'background_options' => require( __DIR__ . '/commons/background.php' ),
        'layout_options' => array(
            'type' => 'group',
            'heading' => __( 'Layout' ),
            'options' => array(

                'dark' => array(
                    'type' => 'radio-buttons',
                    'heading' => 'Color',
                    'default' => 'false',
                    'options' => array(
                        'true'   => array( 'title' => 'Light'),
                        'false'  => array( 'title' => 'Dark'),
                    ),
                ),

                'sticky' => array(
                    'type' => 'radio-buttons',
                    'heading' => 'Sticky',
                    'default' => '',
                    'options' => array(
                        'true'   => array( 'title' => 'On'),
                        ''  => array( 'title' => 'Off'),
                    ),
                ),

                'mask' => array(
                    'type' => 'select',
                    'heading' => 'Mask',
                    'options' => require( __DIR__ . '/values/masks.php' ),
                 ),

                'padding' => array(
                    'type' => 'scrubfield',
                    'heading' => 'Padding',
                    'responsive' => true,
                    'default' => '30px',
                    'min' => 0,
                    'max' => 500,
                ),

                'height' => array(
                    'type' => 'scrubfield',
                    'heading' => 'Min Height',
                    'responsive' => true,
                    'min' => 0,
                    'max' => 1000,
                ),

                'margin' => array(
                    'type' => 'scrubfield',
                    'heading' => 'Margin',
                    'min' => -500,
                    'max' => 500,
                ),

                'scroll_for_more' => array(
                    'type' => 'checkbox',
                    'heading' => 'Scroll Arrow',
                    'default' => false,
                ),

                'scroll_for_more' => array(
                    'type' => 'radio-buttons',
                    'heading' => 'Scroll For More',
                    'default' => '',
                    'options' => array(
                        ''   => array( 'title' => 'Off'),
                        'true'  => array( 'title' => 'On'),
                    ),
                ),

                'loading' => array(
                    'type' => 'radio-buttons',
                    'heading' => 'Loading Spinner',
                    'default' => '',
                    'options' => array(
                        ''   => array( 'title' => 'Off'),
                        'true'  => array( 'title' => 'On'),
                    ),
                ),
            )
        ),
        'border_options' => require( __DIR__ . '/commons/border.php' ),
        'video_options' => require( __DIR__ . '/commons/video.php' ),
    ),
) );
