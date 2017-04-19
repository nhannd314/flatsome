<?php 

/**
 * Add our controls.
 */


function flatsome_social_panels_sections( $wp_customize ) {


	$wp_customize->add_section( 'share', array(
		'title'       => __( 'Share', 'flatsome-admin' ),
		'description' => __( 'This is the default settings for the [share] shortcode and various share icons on the website.', 'flatsome-admin' ),
	) );

	$wp_customize->add_section( 'follow', array(
		'title'       => __( 'Follow Icons', 'flatsome-admin' ),
		'panel'       => 'header',
		'description' => __( 'This is the default settings for the [follow] shortcode and Social Icons header element.', 'flatsome-admin' ),
	) );
}
add_action( 'customize_register', 'flatsome_social_panels_sections' );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'social_icons_style',
	'label'       => __( 'Share Icons Style', 'flatsome-admin' ),
	'section'     => 'share',
	'default'     => 'outline',
	'transport' => $transport,
	'choices'     => array(
		'small' => $image_url . 'icon-plain.svg',
		'outline' => $image_url . 'icon-outline.svg',
		'fill' => $image_url . 'icon-fill.svg',
		'fill-round' => $image_url . 'icon-fill-round.svg',
		'outline-round' => $image_url . 'icon-outline-round.svg',
	),
));


Flatsome_Option::add_field( 'option',  array(
		'type'        => 'multicheck',
		'settings'     => 'social_icons',
		'label'       => __( 'Share Icons', 'flatsome-admin' ),
		//'description' => __( 'This is the control description', 'flatsome-admin' ),
		//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
		'section'     => 'share',
		'transport' => $transport,
		'default'     => array(
			'facebook',
			'twitter',
			'email',
			'pinterest',
			'googleplus',
			'whatsapp',
			'tumblr'
		),
		'choices'     => array(
			"facebook" => "Facebook",
			"linkedin" => "LinkedIn",
			"twitter" => "Twitter",
			"email" => "Email",
			"pinterest" => "Pinterest",
			"googleplus" => "Google Plus",
			"vk" => "VKontakte",
			"tumblr" => "Tumblr",
			"whatsapp" => "WhatsApp (Only for Mobile)",
		),
	)
);

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'custom_share_icons',
	'label'       => __( 'Share Replace', 'flatsome-admin' ),
	'description'       => __( 'Replace Share Icons with Custom Scripts etc.', 'flatsome-admin' ),
	'section'     => 'share',
	'default'     => '',
));



/*************
 * Social Icons
 *************/

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'follow_style',
	'label'       => __( 'Icons Style', 'flatsome-admin' ),
	'section'     => 'follow',
	'default'     => 'small',
	'transport' => $transport,
	'choices'     => array(
		'small' => $image_url . 'icon-plain.svg',
		'outline' => $image_url . 'icon-outline.svg',
		'fill' => $image_url . 'icon-fill.svg',
		'fill-round' => $image_url . 'icon-fill-round.svg',
		'outline-round' => $image_url . 'icon-outline-round.svg',
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'follow_facebook',
	'label'       => __( 'Facebook', 'flatsome-admin' ),
	'transport' => $transport,
	//'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'follow',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'follow_twitter',
	'label'       => __( 'Twitter', 'flatsome-admin' ),
	'transport' => $transport,
	//'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'follow',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'follow_pinterest',
	'label'       => __( 'Pinterest', 'flatsome-admin' ),
	'transport' => $transport,
	'section'     => 'follow',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'follow_instagram',
	'label'       => __( 'Instagram', 'flatsome-admin' ),
	'transport' => $transport,
	//'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'follow',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'follow_google',
	'label'       => __( 'Google +', 'flatsome-admin' ),
	'transport' => $transport,
	//'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'follow',
	'default'     => '',
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'follow_linkedin',
	'label'       => __( 'LinkedIn', 'flatsome-admin' ),
	'transport' => $transport,
	//'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'follow',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'follow_youtube',
	'label'       => __( 'YouTube', 'flatsome-admin' ),
	'transport' => $transport,
	//'description' => __( 'Add Any HTML or Shortcode here...', 'flatsome-admin' ),
	//'help'        => __( 'This is some extra help. You can use this to add some additional instructions for users. The main description should go in the "description" of the field, this is only to be used for help tips.', 'flatsome-admin' ),
	'section'     => 'follow',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'follow_vk',
	'label'       => __( 'VKontakte', 'flatsome-admin' ),
	'section'     => 'follow',
	'transport' => $transport,
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'follow_flickr',
	'label'       => __( 'Flickr', 'flatsome-admin' ),
	'section'     => 'follow',
	'transport' => $transport,
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'follow_email',
	'label'       => __( 'E-mail', 'flatsome-admin' ),
	'section'     => 'follow',
	'transport' => $transport,
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'follow_rss',
	'label'       => __( 'RSS', 'flatsome-admin' ),
	'section'     => 'follow',
	'transport' => $transport,
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'follow_500px',
	'label'       => __( '500px', 'flatsome-admin' ),
	'section'     => 'follow',
	'transport' => $transport,
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'image',
	'settings'     => 'follow_snapchat',
	'label'       => __( 'SnapChat', 'flatsome-admin' ),
	'description' => 'Upload a Snapcode image here. You can generate it here: https://accounts.snapchat.com/accounts/snapcodes',
	'section'     => 'follow',
	'transport' => $transport,
));

function flatsome_refresh_social( WP_Customize_Manager $wp_customize ) {

  // Abort if selective refresh is not available.
  if ( ! isset( $wp_customize->selective_refresh ) ) {
      return;
  }

	  $wp_customize->selective_refresh->add_partial( 'follow_icons', array(
	    'selector' => '.follow-icons',
	    'settings' => array('follow_google','follow_linkedin','follow_flickr','follow_email','follow_style','follow_facebook','follow_twitter','follow_instagram','follow_rss','follow_vk','follow_youtube','follow_pinterest','follow_snapchat','follow_500px'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return do_shortcode('[follow defaults="true" style="'.flatsome_option('follow_style').'"]');
	    },
	) );

	$wp_customize->selective_refresh->add_partial( 'social_icons', array(
	    'selector' => '.share-icons',
	    'settings' => array('social_icons','social_icons_style'),
	    'container_inclusive' => true,
	    'render_callback' => function() {
	        return do_shortcode('[share]');
	    },
	) );

}
add_action( 'customize_register', 'flatsome_refresh_social' );