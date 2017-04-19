<?php

 return array(
    'type' => 'select',
    'heading' => 'Visibility',
    'default' => '',
    'options' => array(
        ''   => 'Visible',
        'hidden'  => 'Hidden',
        'hide-for-medium'  => 'Only for Desktop',
        'show-for-small'   =>  'Only for Mobile',
        'show-for-medium hide-for-small' =>  'Only for Tablet',
        'show-for-medium'   =>  'Hide for Desktop',
        'hide-for-small'   =>  'Hide for Mobile',
    ),
);
