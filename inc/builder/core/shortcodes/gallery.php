<?php

$size_names = apply_filters( 'image_size_names_choose', array(
	'thumbnail' => __( 'Thumbnail' ),
	'medium' => __( 'Medium' ),
	'large' => __( 'Large' ),
	'full' => __( 'Full Size' ),
) );

add_ux_builder_shortcode( 'gallery', array(
    'name' => __( 'WP Gallery','ux-builder'),
    'image' => '',
    'category' => __( 'Content' ),
    'presets' => array(
        array(
            'name' => __( 'Default' ),
            'content' => '[gallery]'
        ),
    ),

    'options' => array(
      /*'id' => array(
        'type' => 'select',
        'heading' => __( 'Post' ),
        'descrition' => __( 'The gallery will display images which are attached to that post.' ),
        'config' => array(
          'placeholder' => __( 'Select..' ),
          'postSelect' => array(),
        )
      ), */
      'ids' => array(
        'type' => 'gallery',
        'heading' => __( 'Images' ),
      ),
      'orderby' => array(
        'type' => 'select',
        'heading' => __( 'Order by' ),
        'default' => 'menu_order',
        'options' => array(
          'menu_order' => __( 'Custom' ),
          'title' => __( 'Image title' ),
          'ID' => __( 'Image ID' ),
          'post_date' => __( 'Date/time' ),
          'rand' => __( 'Randomly' ),
        ),
      ),
      'order' => array(
        'type' => 'select',
        'heading' => __( 'Sort order' ),
        'default' => 'ASC',
        'options' => array(
          'ASC' => __( 'Ascending' ),
          'DESC' => __( 'Descending' ),
        ),
      ),
      'columns' => array(
        'type' => 'select',
        'heading' => __( 'Columns' ),
        'default' => '3',
        'options' => array(
          '1' => __( '1' ),
          '2' => __( '2' ),
          '3' => __( '3' ),
          '4' => __( '4' ),
          '5' => __( '5' ),
          '6' => __( '6' ),
          '7' => __( '7' ),
          '8' => __( '8' ),
         ),
      ),
      'size' => array(
        'type' => 'select',
        'heading' => __( 'Image size' ),
        'default' => 'thumbnail',
        'options' => $size_names,
      ),
      'link' => array(
        'type' => 'select',
        'heading' => __( 'Link to' ),
        'default' => 'post',
        'options' => array(
          'post' => __( 'Attachment page' ),
          'file' => __( 'Media file' ),
          'none' => __( 'None' ),
        ),
      ),
      'itemtag' => array(
        'type' => 'textfield',
        'heading' => __( 'Item tag' ),
        'placeholder' => 'dl',
      ),
      'icontag' => array(
        'type' => 'textfield',
        'heading' => __( 'Icon tag' ),
        'placeholder' => 'dt',
      ),
      'captiontag' => array(
        'type' => 'textfield',
        'heading' => __( 'Caption tag' ),
        'placeholder' => 'dd',
      ),
      'include' => array(
        'type' => 'textfield',
        'heading' => __( 'Include IDs' ),
      ),
      'exclude' => array(
        'type' => 'textfield',
        'heading' => __( 'Exclude IDs' ),
      ),
    ),
) );
