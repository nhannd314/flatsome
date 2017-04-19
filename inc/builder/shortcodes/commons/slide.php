<?php 
return array(
  'type' => 'group',
  'heading' => __( 'Slide' ),
  'require' => 'ux_slider',
  'options' => array(
    'slide_effect' => array(
      'type' => 'select',
      'heading' => 'Slide Effect',
      'options' => array(
        '' => 'None',
        'fade-in' => 'Fade In',
        'zoom-in' => 'Zoom In',
        'zoom-out' => 'Zoom Out',
        'fade-in-fast' => 'Fade In Fast',
        'zoom-in-fast' => 'Zoom In Fast',
        'zoom-out-fast' => 'Zoom Out Fast',
      ),
    ),
  ),
);