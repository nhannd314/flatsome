<?php 

if(!$repeater_col_spacing) $repeater_col_spacing = 'normal';
if(!$repeater_columns) $repeater_columns = '4';
if(!$repeater_type) $repeater_type = 'slider';

return array(
    'type' => 'group',
    'heading' => __( 'Layout' ),
    'options' => array(
        'type' => array(
            'type' => 'select',
            'heading' => 'Type',
            'default' => $repeater_type,
            'options' => require( __DIR__ . '/../values/row-layouts.php' )
        ),
        'grid' => array(
            'type' => 'select',
            'heading' => 'Grid Layout',
            'conditions' => 'type === "grid"',
            'default' => '1',
            'options' => require( __DIR__ . '/../values/grids.php' )
        ),
        'grid_height' => array(
            'type' => 'textfield',
            'heading' => __( 'Grid Height' ),
            'conditions' => 'type === "grid"',
            'default' => '600px',
            'responsive' => true,
            'max' => 200,
            'min' => 30,
    ),
    'width' => array(
        'type' => 'select',
        'heading' => 'Width',
        'conditions' => 'type !== "slider-full"',
        'default' => '',
        'options' => array(
            '' => 'Container',
            'full-width' => 'Full Width',
        )
    ),
    'col_spacing' => array(
        'type' => 'select',
        'heading' => 'Column Spacing',
        'conditions' => 'type !== "slider-full"',
        'default' => $repeater_col_spacing,
        'options' => require( __DIR__ . '/../values/col-spacing.php' )
    ),
    'columns' => array(
        'type' => 'slider',
        'heading' => 'Columns',
        'conditions' => 'type !== "grid" && type !== "slider-full"',
        'default' => $repeater_columns,
        'responsive' => true,
        'max' => '8',
        'min' => '1',
    ),
   'depth' => array(
        'type' => 'slider',
        'heading' => __( 'Depth' ),
        'default' => '0',
        'max' => '5',
        'min' => '0',
    ),
    'depth_hover' => array(
        'type' => 'slider',
        'heading' => __( 'Depth Hover' ),
        'default' => '0',
        'max' => '5',
        'min' => '0',
    ),
    'animate' => array(
        'type' => 'select',
        'heading' => __( 'Animate' ),
        'default' => 'none',
        'options' => require( __DIR__ . '/../values/animate.php' ),
    ),
  ),
);