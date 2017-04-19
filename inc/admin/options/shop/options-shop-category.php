<?php


Flatsome_Option::add_section( 'category-page', array(
	'title'       => __( 'Category Page', 'flatsome-admin' ),
	'panel' => 'shop'
) );

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_category_homepage',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'category-page',
    'default'     => '<div class="options-title-divider">Shop Homepage</div>',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'html_shop_page',
	'label'       => __( 'Shop Homepage Header', 'flatsome-admin' ),
	'description'        => __( 'Enter HTML that should be placed on top of main shop page. Shortcodes are allowed. This will replace Shop Homepage Header', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'html_shop_page_content',
	'label'       => __( 'Shop Homepage Content', 'flatsome-admin' ),
	'description'        => __( 'Enter HTML/Shortcodes that should replace Shop Homepage content.', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => '',
));

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_category_layout',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'category-page',
    'default'     => '<div class="options-title-divider">Category Layout</div>',
) );


Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'category_sidebar',
	'label'       => __( 'Layout', 'flatsome-admin' ),
	'section'     => 'category-page',
	//'transport' => $transport,
	'default'     => 'left-sidebar',
	'choices'     => array(
		'none' => $image_url . 'category-no-sidebar.svg',
		'left-sidebar' => $image_url . 'category-left-sidebar.svg',
		'right-sidebar' => $image_url . 'category-right-sidebar.svg',
		'off-canvas' => $image_url . 'category-off-canvas.svg',
	),
));


Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'category_grid_style',
	'label'       => __( 'List Style', 'flatsome-admin' ),
	'section'     => 'category-page',
	'transport' => $transport,
	'default'     => 'grid',
	'choices'     => array(
		'grid' => $image_url . 'category-style-grid.svg',
		'list' => $image_url . 'category-style-list.svg',
		'masonry' => $image_url . 'category-style-masonry.svg',
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'products_pr_page',
	'transport' => $transport,
	'label'       => __( 'Products per Page', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => 12,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'category_row_count',
	'transport' => $transport,
	'label'       => __( 'Products per row - Desktop', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => 3,
	'choices'     => array(
		'min'  => 1,
		'max'  => 6,
		'step' => 1
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'category_row_count_tablet',
	'label'       => __( 'Products per row - Tablet', 'flatsome-admin' ),
	'section'     => 'category-page',
	'transport' => $transport,
	'default'     => 3,
	'choices'     => array(
		'min'  => 1,
		'max'  => 4,
		'step' => 1
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'category_row_count_mobile',
	'label'       => __( 'Products per row - Mobile', 'flatsome-admin' ),
	'section'     => 'category-page',
	'transport' => $transport,
	'default'     => 2,
	'choices'     => array(
		'min'  => 1,
		'max'  => 3,
		'step' => 1
	),
));


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_category_header',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'category-page',
    'default'     => '<div class="options-title-divider">Header</div>',
) );


Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'category_title_style',
	'label'       => __( 'Title Style', 'flatsome-admin' ),
	'section'     => 'category-page',
	'transport' => $transport,
	'default'     => '',
	'choices'     => array(
		'' => $image_url . 'category-title.svg',
		'featured' => $image_url . 'category-title-featured.svg',
		'featured-center' => $image_url . 'category-title-featured-center.svg',
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'category_show_title',
	'transport' => $transport,
	'label'       => __( 'Show title', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => '0',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'category_header_transparent',
	'label'       => __( 'Transparent Header', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => '0',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'header_shop_bg_featured',
	'transport' => $transport,
	'help' => __( 'Use Featured Images from categories and products as background. Will fallback to default Shop Title background if nothing is set.', 'flatsome-admin' ),
	'label'       => __( 'Featured Image as Background', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'image',
	'settings'     => 'header_shop_bg_image',
	'transport' => $transport,
	'label'       => __( 'Shop Title Background', 'flatsome-admin' ),
	'section'     => 'category-page',
	//'transport' => $transport,
	'default'     => ''
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'color-alpha',
    'alpha' => true,
    'settings'     => 'header_shop_bg_color',
    'transport' => $transport,
    'label'       => __( 'Title Background Color', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => 'rgba(0,0,0,.3)',
));

Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_category_breadcrumbs',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'category-page',
    'default'     => '<div class="options-title-divider">Breadcrumbs</div>',
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'breadcrumb_size',
	'label'       => __( 'Breadcrumb Size', 'flatsome-admin' ),
	//'description' => __( 'This is the control description', 'flatsome-admin' ),
	'help'        => __( 'Change size of breadcrumb on product categories. Useful if you have long breadcrumbs.', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => 'large',
	'choices'     => $sizes
));



Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_category_category_box',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'category-page',
    'default'     => '<div class="options-title-divider">Category Box</div>',
) );

Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'cat_style',
	'label'       => __( 'Category Box Style', 'flatsome-admin' ),
	'section'     => 'category-page',
	'transport' => $transport,
	'default'     => 'badge',
	'choices'     => array(
		'normal' => $image_url . 'category-box.svg',
		'badge' => $image_url . 'category-box-badge.svg',
		'overlay' => $image_url . 'category-box-overlay.svg',
		'label' => $image_url . 'category-box-label.svg',
		'shade' => $image_url . 'category-box-shade.svg',
		'bounce' => $image_url . 'category-box-bounce.svg',
		'push' => $image_url . 'category-box-push.svg',
	),
));


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_category_product_box',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'category-page',
    'default'     => '<div class="options-title-divider">Product Box</div>',
) );

Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'grid_style',
	'label'       => __( 'Grid Style', 'flatsome-admin' ),
	'section'     => 'category-page',
	'transport' => $transport,
	'default'     => 'grid1',
	'choices'     => array(
		'grid1' => $image_url . 'product-box.svg',
		'grid2' => $image_url . 'product-box-center.svg',
		'grid3' => $image_url . 'product-box-wide.svg',
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'select',
	'settings'     => 'product_hover',
	'transport' => $transport,
	'label'       => __( 'Product Image Hover style', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => 'fade_in_back',
	'choices'     => array(
		'none' => __( 'None', 'flatsome-admin' ),
		'fade_in_back' => __( 'Back Image - Fade In', 'flatsome-admin' ),
		'zoom_in' => __( 'Back Image - Zoom In', 'flatsome-admin' ),
	    'zoom' => 'Zoom',
	    'zoom-fade' => 'Zoom Fade',
	    'blur' => 'Blur',
	    'fade-in' => 'Fade In',
	    'fade-out' => 'Fade Out',
	    'glow' => 'Glow',
	    'color' => 'Add Color',
	    'grayscale' => 'Grayscale',
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'category_shadow',
	'label'       => __( 'Drop Shadow', 'flatsome-admin' ),
	'section'     => 'category-page',
	'transport' => $transport,
	'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 5,
		'step' => 1
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'category_shadow_hover',
	'label'       => __( 'Drop Shadow:hover', 'flatsome-admin' ),
	'section'     => 'category-page',
	'transport' => $transport,
	'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 5,
		'step' => 1
	),
));

Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'add_to_cart_icon',
	'label'       => __( 'Add To Cart Button', 'flatsome-admin' ),
	'section'     => 'category-page',
	'transport' => $transport,
	'default'     => 'disable',
	'choices'     => array(
		'disable' => $image_url . 'product-box.svg',
		'show' => $image_url . 'product-box-add-to-cart-icon.svg',
		'button' => $image_url . 'product-box-add-to-cart-button.svg',
	),
));

Flatsome_Option::add_field( 'option',  array(
  'type'        => 'select',
  'settings'     => 'add_to_cart_style',
  'label'       => __( 'Button Style', 'flatsome-admin' ),
  'section'     => 'category-page',
  'transport' => $transport,
  'default'     => 'outline',
  'choices'     => array(
    'flat' => __( 'Plain', 'flatsome-admin' ),
    'outline' => __( 'Outline', 'flatsome-admin' ),
    'underline' => __( 'Underline', 'flatsome-admin' ),
    'shade' => __( 'Shade', 'flatsome-admin' ),
    'bevel' => __( 'Bevel', 'flatsome-admin' ),
    'gloss' => __( 'Gloss', 'flatsome-admin' ),
  ),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'product_box_category',
	'transport' => $transport,
	'label'       => __( 'Show Category', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'product_box_rating',
	'transport' => $transport,
	'label'       => __( 'Show Ratings', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'short_description_in_grid',
	'transport' => $transport,
	'label'       => __( 'Show Short Description', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => '0',
));

Flatsome_Option::add_field( 'option',  array(
 	'type'        => 'checkbox',
	'settings'     => 'disable_quick_view',
 	'transport' => $transport,
 	'label'       => __( 'Disable Quick View', 'flatsome-admin' ),
 	'section'     => 'category-page',
 	'default'     => 0,
));

Flatsome_Option::add_field( 'option', array(
	'type'        => 'radio-image',
	'settings'     => 'bubble_style',
	'label'       => __( 'Sale Bubble Style', 'flatsome-admin' ),
	'section'     => 'category-page',
	'transport' => $transport,
	'default'     => 'style1',
	'choices'     => array(
		'style1' => $image_url . 'badge-circle.svg',
		'style2' => $image_url . 'badge-square.svg',
		'style3' => $image_url . 'badge-border.svg',
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'text',
	'settings'     => 'sale_bubble_text',
	'transport' => $transport,
	'label'       => __( 'Custom Sale Bubble Text', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => '',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'sale_bubble_percentage',
	'transport' => $transport,
	'label'       => __( 'Display % instead of "Sale!"', 'flatsome-admin' ),
	'section'     => 'category-page',
	'default'     => '0',
));
