<?php

Flatsome_Option::add_section( 'product-page', array(
	'title'       => __( 'Product Page', 'flatsome-admin' ),
	'panel' => 'shop'
) );

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_product_layout',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'product-page',
    'default'     => '<div class="options-title-divider">Layout</div>',
) );


Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'product_layout',
	'label'       => __( 'Product Layout', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => flatsome_product_layout(),
	'choices'     => array(
		'no-sidebar' => $image_url . 'layout-no-sidebar.svg',
		'left-sidebar' => $image_url . 'layout-left.svg',
		'left-sidebar-full' => $image_url . 'layout-left-full.svg',
		'left-sidebar-small' => $image_url . 'layout-left-small.svg',
		'right-sidebar' => $image_url . 'layout-right.svg',
		'right-sidebar-small' => $image_url . 'layout-right-small.svg',
		'right-sidebar-full' => $image_url . 'layout-right-full.svg',
		//'gallery-full' => $image_url . 'layout-full-gallery.svg',
		'gallery-wide' => $image_url . 'layout-wide-gallery.svg',
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'product_offcanvas_sidebar',
	'label'       => __( 'Off-canvas Sidebar for Mobile', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default' => 0
));

Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'product_header',
	'label'       => __( 'Product Header', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => '',
	'choices'     => array(
		'' => $image_url . 'product-title.svg',
		'top' => $image_url . 'product-title-top.svg',
		'featured' => $image_url . 'product-title-featured.svg',
		'featured-center' => $image_url . 'product-title-featured-center.svg',
		//'push' => $image_url . 'product-title-push.svg',
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'product_header_transparent',
	'label'       => __( 'Transparent Header', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default' => 0
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'product_next_prev_nav',
	'label'       => __( 'Next / Prev Navigation', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default' => 1
));

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_product_gallery',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'product-page',
    'default'     => '<div class="options-title-divider">Gallery</div>',
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'product_image_width',
	'label'       => __( 'Product Image Width', 'flatsome-admin' ),
	'section'     => 'product-page',
	'transport' => 'postMessage',
	'default' => '6',
	'choices'     => array(
		'8' => __( '8/12', 'flatsome-admin' ),
		'7' => __( '7/12', 'flatsome-admin' ),
		'6' => __( '6/12 (50%)', 'flatsome-admin' ),
		'5' => __( '5/12', 'flatsome-admin' ),
		'4' => __( '4/12', 'flatsome-admin' ),
		'3' => __( '3/12', 'flatsome-admin' ),
		'2' => __( '2/12', 'flatsome-admin' ),
	),
));


Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'product_image_style',
	'label'       => __( 'Product Image Style', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => 'normal',
	'choices'     => array(
		'normal' => $image_url . 'product-gallery.svg',
		'vertical' => $image_url . 'product-gallery-vertical.svg',
	),
));


Flatsome_Option::add_field( 'option',  array(
  'type'        => 'select',
  'settings'     => 'product_lightbox',
  'label'       => __( 'Product Image Lightbox', 'flatsome-admin' ),
  'description' => __( 'Show images in a lightbox when clicking on image in gallery. You might need to save and close Customizer for this to work properly.', 'flatsome-admin' ),
  'section'     => 'product-page',
  'default'     => 'default',
  'choices'     => array(
    'default' => __( 'New WooCommerce 3.0 Lightbox', 'flatsome-admin' ),
    'flatsome' => __( 'Flatsome Lightbox', 'flatsome-admin' ),
    'woocommerce' => __( 'Old WooCommerce Lightbox', 'flatsome-admin' ),
    'disabled' => __( 'Disable Lightbox', 'flatsome-admin' ),
  ),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'product_zoom',
	'label'       => __( 'Product Image Hover Zoom', 'flatsome-admin' ),
  'description' => __( 'Show a zoomed version of image when hovering gallery', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => 0,
));


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_product_ifon',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'product-page',
    'default'     => '<div class="options-title-divider">Product Summary</div>',
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-buttonset',
	'settings'     => 'product_info_align',
	'label'       => __( 'Text Align', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => 'left',
	'choices'     => array(
		'left' => __( 'Left', 'flatsome-admin' ),
		'center' => __( 'Center', 'flatsome-admin' ),
		'right' => __( 'Right', 'flatsome-admin' ),
	),
));

Flatsome_Option::add_field( 'option',  array(
  'type'        => 'radio-buttonset',
  'settings'     => 'product_info_form',
  'label'       => __( 'Form Style', 'flatsome-admin' ),
  'section'     => 'product-page',
  'default'     => '',
  'choices'     => array(
    '' => __( 'Default', 'flatsome-admin' ),
    'flat' => __( 'Flat', 'flatsome-admin' ),
  ),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'product_info_meta',
	'label'       => __( 'Show Meta / Categories', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'product_info_share',
	'label'       => __( 'Show Share Icons', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => 1,
));

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_product_tabs',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'product-page',
    'default'     => '<div class="options-title-divider">Tabs</div>',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'product_display',
	'label'       => __( 'Product Tabs Style', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => 'tabs',
	'choices'     => array(
		'tabs' => __( 'Line Tabs', 'flatsome-admin' ),
		'tabs_normal' => __( 'Tabs Normal', 'flatsome-admin' ),
		'line-grow' => __( 'Line Tabs - Grow', 'flatsome-admin' ),
		'tabs_vertical' => __( 'Tabs vertical', 'flatsome-admin' ),
		'tabs_pills' => __( 'Pills', 'flatsome-admin' ),
		'tabs_outline' => __( 'Outline', 'flatsome-admin' ),
		'sections' => __( 'Sections', 'flatsome-admin' ),
		'accordian' => __( 'Accordian', 'flatsome-admin' ),
	),
));


Flatsome_Option::add_field( 'option',  array(
  'type'        => 'radio-buttonset',
	'settings'     => 'product_tabs_align',
	'label'       => __( 'Product Tabs Align', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => 'left',
	'choices'     => array(
		'left' => __( 'Left', 'flatsome-admin' ),
		'center' => __( 'Center', 'flatsome-admin' ),
		'right' => __( 'Right', 'flatsome-admin' ),
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'tab_title',
	'label'       => __( 'Global custom tab title', 'flatsome-admin' ),
	'section'     => 'product-page',
	'sanitize_callback' => 'flatsome_custom_sanitize',
	'default'     => '',
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'tab_content',
	'label'       => __( 'Global custom tab content', 'flatsome-admin' ),
	'section'     => 'product-page',
	'sanitize_callback' => 'flatsome_custom_sanitize',
	'default'     => '',
));


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_product_add',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'product-page',
    'default'     => '<div class="options-title-divider">Add To Cart</div>',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'cart_dropdown_show',
	'label'       => __( 'Open Cart dropdown when product is added to cart', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => 1,
));


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_product_related',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'product-page',
    'default'     => '<div class="options-title-divider">Related / Upsell</div>',
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'product_upsell',
	'label'       => __( 'Product Upsell', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => 'sidebar',
	'choices'     => array(
		'sidebar' => __( 'In Sidebar', 'flatsome-admin' ),
		'bottom' => __( 'Below Description', 'flatsome-admin' ),
		'disabled' => __( 'Disabled', 'flatsome-admin' ),
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'related_products',
	'label'       => __( 'Related Products Style', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => 'slider',
	'choices'     => array(
		'slider' => __( 'Slider', 'flatsome-admin' ),
		'grid' => __( 'Grid', 'flatsome-admin' ),
		'hidden' => __( 'Disabled', 'flatsome-admin' ),
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'related_products_pr_row',
	'label'       => __( 'Products pr. row', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => '4',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'max_related_products',
	'label'       => __( 'Max number of Related Products', 'flatsome-admin' ),
	'section'     => 'product-page',
	'default'     => '12',
));


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_product_html',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'product-page',
    'default'     => '<div class="options-title-divider">Custom HTML</div>',
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'html_before_add_to_cart',
	'label'       => __( 'HTML before Add To Cart button', 'flatsome-admin' ),
	'section'     => 'product-page',
	'sanitize_callback' => 'flatsome_custom_sanitize',
	'default'     => '',
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'html_after_add_to_cart',
	'label'       => __( 'HTML after Add To Cart button', 'flatsome-admin' ),
	'section'     => 'product-page',
	'sanitize_callback' => 'flatsome_custom_sanitize',
	'default'     => '',
));
