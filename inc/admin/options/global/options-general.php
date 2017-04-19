<?php 

Flatsome_Option::add_section( 'advanced', array(
	'title'       => __( 'Reset Options', 'flatsome-admin' ),
	'priority' 	  => 999,
    'description' => __( 'Click the reset button to reset all options to default values.', 'flatsome-admin' ),
) );

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_advanced_reset',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'advanced',
    'default'     => '<div class="reset-options-container"><button name="Reset" id="flatsome-customizer-reset" class="button-primary button" title="Reset Theme Options">Reset Theme Options</button></div>',
) );