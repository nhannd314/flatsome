<?php

add_ux_builder_shortcode( 'row', array(
    'type' => 'container',
    'name' => __( 'Row' , 'ux-builder' ),
    'image' => '',
    'category' => __( 'Layout' ),
    'template' => flatsome_ux_builder_template( 'row.html' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row' ),
    'tools' => 'shortcodes/row-tools.directive.html',
    'info' => '{{ label }}',
    'allow' => array( 'col' ),
    'nested' => true,
    'wrap'   => false,
    'priority' => -1,

    'presets' => array(
        array(
            'name' => __( '3 Columns' ),
            'content' => '[row][col span="4" span__sm="12"][/col][col span="4" span__sm="12"][/col][col span="4" span__sm="12"][/col]][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-3-col' ),
        ),
        array(
            'name' => __( '2 Columns' ),
            'content' => '[row][col span="6" span__sm="12"][/col][col span="6" span__sm="12"][/col][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-2-col' ),
        ),
        array(
            'name' => __( '4 Columns' ),
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-4-col' ),
            'content' => '[row][col span="3" span__sm="6"][/col][col span="3" span__sm="6"][/col][col span="3" span__sm="6"][/col][col span="3" span__sm="6"][/col][/row]'
        ),
        array(
            'name' => __( 'One Column' ),
            'content' => '[row][col span="12" span__sm="12"][/col][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-1-col' ),
        ),
        array(
            'name' => __( 'Large Right' ),
            'content' => '[row][col span="4" span__sm="12"][/col][col span="8" span__sm="12"][/col][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-1-3-col' ),
        ),
        array(
            'name' => __( 'Large Left' ),
            'content' => '[row][col span="8" span__sm="12"][/col][col span="4" span__sm="12"][/col][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-2-3-col' ),
        ),
        array(
            'name' => __( '2 Col - Full' ),
            'content' => '[row style="collapse" width="full-width"][col span="6"][/col][col span="6"][/col][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-2-col-full' ),
        ),
        array(
            'name' => __( '3 col - Full' ),
            'content' => '[row style="collapse" width="full-width"][col span="4"][/col][col span="4"][/col][col span="4"][/col][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-3-col-full' ),
        ),
        array(
            'name' => __( 'Media Left' ),
            'content' => '[row  v_align="middle"][col span="6" span__sm="12"][ux_image][/col][col span="6" span__sm="12"][/col][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-image-left' ),
        ),
        array(
            'name' => __( 'Media Right' ),
            'content' => '[row v_align="middle"][col span="6" span__sm="12"][/col][col span="6" span__sm="12"][ux_image][/col][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-image-right' ),
        ),
        array(
            'name' => __( 'Large Media Left' ),
            'content' => '[row v_align="middle" style="collapse" width="full-width"][col span="6" span__sm="12"][ux_image][/col][col max_width="520px" padding="5% 5% 5% 5%" span="6" span__sm="12"][/col][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-image-left-large' ),
        ),
        array(
            'name' => __( 'Large Media Right' ),
            'content' => '[row v_align="middle" style="collapse" width="full-width"][col max_width="520px" padding="5% 5% 5% 5%" span="6" span__sm="12" width=""][/col][col span="6" span__sm="12"][ux_image][/col][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-image-right-large' ),
        ),
        array(
            'name' => __( '3 Columns - Drop Shadow' ),
            'content' => '[row depth="3" depth_hover="5"][col span="4" span__sm="12"][/col][col span="4" span__sm="12"][/col][col span="4" span__sm="12"][/col]][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-3-shadow-col' ),
        ),
        array(
            'name' => __( '3 Columns - Dashed' ),
            'content' => '[row col_style="dashed"][col span="4" span__sm="12"][/col][col span="4" span__sm="12"][/col][col span="4" span__sm="12"][/col][col span="4" span__sm="12"][/col][col span="4" span__sm="12"][/col][col span="4" span__sm="12"][/col]][/row]',
            'thumbnail' =>  flatsome_ux_builder_thumbnail( 'row-3-col-dashed' ),
        )
    ),

    'options' => array(
        
        'label' => array(
            'full_width' => true,
            'type' => 'textfield',
            'heading' => 'Label',
            'placeholder' => 'Enter admin label here..'
        ),

        'style' => array(
            'type' => 'radio-buttons',
            'heading' => 'Column Spacing',
            'full_width' => true,
            'default' => '',
            'options' => array(
                '' => array( 'title' => 'Normal'),
                'small' => array( 'title' => 'Small' ),
                'large' => array( 'title' => 'Large' ),
                'collapse' => array( 'title' => 'Collapse' ),
            ),
        ),

        'col_style' => array(
            'type' => 'radio-buttons',
            'heading' => 'Column Style',
            'full_width' => true,
            'default' => '',
            'options' => array(
                '' => array( 'title' => 'Normal'),
                'divided' => array( 'title' => 'Divided'),
                'dashed' => array( 'title' => 'Dashed'),
                'solid' => array( 'title' => 'Solid'),
            ),
        ),

        'col_bg' => array(
            'type' => 'colorpicker',
            'heading' => __('Column Background'),
            'format' => 'rgb',
            'alpha' => true,
            'position' => 'bottom right',
            'helpers' => require( __DIR__ . '/helpers/colors.php' ),
        ),

        'width' => array(
            'type' => 'radio-buttons',
            'heading' => 'Width',
            'full_width' => true,
            'default' => '',
            'options' => array(
                '' => array( 'title' => 'Container'),
                'full-width' => array( 'title' => 'Full' ),
                'custom' => array( 'title' => 'Custom' ),
            ),
        ),

        'custom_width' => array(
            'type' => 'scrubfield',
            'conditions' => 'width == "custom"',
            'heading' => 'Custom Width',
            'default' => '',
            'placeholder' => '1080px'
        ),

        'v_align' => array(
            'type' => 'radio-buttons',
            'heading' => 'Align Vertical',
            'full_width' => true,
            'default' => '',
            'options' => array(
                '' => array( 'title' => 'Top'),
                'equal' => array( 'title' => 'Equal'),
                'middle' => array( 'title' => 'Middle'),
                'bottom' => array( 'title' => 'Bottom'),
            )
        ),

        'h_align' => array(
            'type' => 'radio-buttons',
            'heading' => 'Align Horizontal',
            'full_width' => true,
            'default' => '',
            'options' => array(
                 '' => array( 'title' => 'Left'),
                 'center' => array( 'title' => 'Center'),
                 'right' => array( 'title' => 'Right')
            )
        ),

        'padding' => array(
            'type' => 'margins',
            'heading' => 'Column Padding',
            'full_width' => true,
            'responsive' => true,
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ),

   

        'depth' => array(
            'type' => 'slider',
            'vertical' => true,
            'full_width' => true,
            'heading' => 'Column Depth',
            'default' => 0,
            'max' => 5,
            'min' => 0,
        ),

        'depth_hover' => array(
            'type' => 'slider',
            'vertical' => true,
            'full_width' => true,
            'heading' => 'Column Depth Hover',
            'default' => 0,
            'max' => 5,
            'min' => 0,
        ),

        'class' => array(
            'type' => 'textfield',
            'heading' => 'Custom Class',
            'full_width' => true,
            'placeholder' => 'class-name',
            'default' => '',
        ),
    ),
) );
