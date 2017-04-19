<?php

return array(
    'type' => 'group',
    'heading' => __( 'Link' ),
    'options' => array(
        'link' =>   array(
          'type' => 'textfield',
          'heading' => __('Link'),
        ),
        'target' => array(
          'type' => 'select',
          'heading' => __( 'Target' ),
          'default' => '',
          'options' => array(
              '' => 'Same window',
              '_blank' => 'New window',
          )
        ),
    )
); 