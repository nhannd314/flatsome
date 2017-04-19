<?php


// Contactform7
$forms = array('' => '-- Forms --');
foreach(get_posts(array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1)) as $cf7Form){
    $forms[$cf7Form->ID] = $cf7Form->post_title;
}

add_ux_builder_shortcode( 'contact-form-7', array(
    'name' => __( 'Form (CF7)' ),
    'category' => __( 'Content' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'forms' ),
    'allow_in' => array('text_box'),
    'options' => array(
        'id' => array(
            'type' => 'select',
            'heading' => 'Select Form',
            'default' => '',
            'options' => $forms
        )
    )
) );
