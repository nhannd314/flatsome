<?php

/* Add Extra Sale Flash Bubbles */
if(!function_exists('flatsome_sale_flash')){
    function flatsome_sale_flash($text, $post, $_product, $badge_style) {
    global $wc_cpdf;

    if($wc_cpdf->get_value(get_the_ID(), '_bubble_new')) {

    $bubble_text = $wc_cpdf->get_value(get_the_ID(), '_bubble_text') ? $wc_cpdf->get_value(get_the_ID(), '_bubble_text') : __('New','flatsome');

     // Extra Product bubbles
    $text .= '<div class="badge callout badge-'.$badge_style.'"><div class="badge-inner callout-new-bg is-small new-bubble">'.$bubble_text.'</div></div>';
    }
    return $text;
    }
}
add_filter('flatsome_product_labels', 'flatsome_sale_flash',10, 10, 3);


/* Get Hover image for WooCommerce Grid */
function flatsome_woocommerce_get_alt_product_thumbnail() {
    $hover_style = flatsome_option('product_hover');
    if($hover_style !== 'fade_in_back' && $hover_style !== 'zoom_in') return;

    global $product;
    $attachment_ids = woocommerce_version_check('3.0.0') ? $product->get_gallery_image_ids() : $product->get_gallery_attachment_ids();
    $class = 'show-on-hover absolute fill hide-for-small back-image';
    if($hover_style == 'zoom_in') $class .= $class.' hover-zoom';

    if ( $attachment_ids ) {
        $loop = 0;
        foreach ( $attachment_ids as $attachment_id ) {
            $image_link = wp_get_attachment_url( $attachment_id);
            if ( ! $image_link )
                continue;
            $loop++;
            echo apply_filters('flatsome_woocommerce_get_alt_product_thumbnail', wp_get_attachment_image( $attachment_id, 'shop_catalog', false, array( 'class' => $class )));
            if ($loop == 1) break;
        }
    }
}

add_action( 'flatsome_woocommerce_shop_loop_images', 'flatsome_woocommerce_get_alt_product_thumbnail', 11 );


/* Fix WooCommerce Loop Title */
if (  ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
    function woocommerce_template_loop_product_title() {
        echo '<p class="name product-title"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></p>';
    }
}

/* Add / Remove Categories */
function flatsome_woocommerce_shop_loop_category(){
  if(!flatsome_option('product_box_category')) return; ?>
  <p class="category uppercase is-smaller no-text-overflow product-cat op-7">
        <?php
        global $product;
        $product_cats = function_exists('wc_get_product_category_list') ? wc_get_product_category_list(get_the_ID(), ',', '', '') : $product->get_categories(',', '', '');

        $product_cats = strip_tags($product_cats);

        if($product_cats){
             list($firstpart) = explode(',', $product_cats);
             echo $firstpart;
        }
        ?>
   </p> <?php }
add_action('woocommerce_shop_loop_item_title','flatsome_woocommerce_shop_loop_category', 0);

/* Add / Remove Ratings */
function flatsome_woocommerce_shop_loop_ratings(){
    if(flatsome_option('product_box_rating')) return;
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
}
add_action('woocommerce_shop_loop_item_title','flatsome_woocommerce_shop_loop_ratings', 0);



/* Remove and add Product image */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'flatsome_woocommerce_shop_loop_images', 'woocommerce_template_loop_product_thumbnail', 10 );


/* Remove Default Add To cart button from Grid */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );


/* Add Add to cart icon */
function flatsome_product_box_actions_add_to_cart(){
    // Check if active
    if(flatsome_option('add_to_cart_icon') !== "show") return;
    global $product;
    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
        sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s %s add-to-cart-grid" style="width:0">
            <div class="cart-icon tooltip absolute is-small" title="%s"><strong>+</strong></div></a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $quantity ) ? $quantity : 1 ),
            esc_attr( $product->get_id() ),
            esc_attr( $product->get_sku() ),
            esc_attr( $product->is_type( 'variable' ) ? '' : 'ajax_add_to_cart'),
            esc_attr( isset( $class ) ? $class : 'add_to_cart_button' ),
            esc_html( $product->add_to_cart_text() )
        ),
    $product );
}
add_action('flatsome_product_box_actions', 'flatsome_product_box_actions_add_to_cart', 1);


/* Add Add to Cart After */
function flatsome_woocommerce_shop_loop_button(){
    if(flatsome_option('add_to_cart_icon') !== "button") return;
    global $product;

    $button_style = 'outline';
    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
        sprintf( '<div class="add-to-cart-button"><a href="%s" rel="nofollow" data-product_id="%s" class="%s %s product_type_%s button %s is-%s mb-0 is-%s">%s</a></div>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( $product->get_id() ),
            esc_attr( $product->is_type( 'variable' ) ? '' : 'ajax_add_to_cart'),
            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
            esc_attr( $product->product_type ),
            esc_attr( 'primary' ), // Button color
            esc_attr( get_theme_mod('add_to_cart_style', 'outline') ), // Button style
            esc_attr( 'small' ), // Button size
            esc_html( $product->add_to_cart_text() )
        ),
    $product );
}
add_action('flatsome_product_box_after', 'flatsome_woocommerce_shop_loop_button', 100);

/* Add Product Short description */
function flatsome_woocommerce_shop_loop_excerpt(){
    if(!flatsome_option('short_description_in_grid')) return; ?>
    <p class="box-excerpt is-small">
     <?php echo get_the_excerpt(); ?>
    </p>
    <?php
}
add_action('flatsome_product_box_after', 'flatsome_woocommerce_shop_loop_excerpt', 20);

// Add Classes to product box
function flatsome_product_box_class (){
    $classes = array();

    $category_grid_style = flatsome_option('category_grid_style');

    if($category_grid_style == 'list'){
        $classes[] = 'box-vertical';
    }

    if(!empty($classes)) return implode(' ', $classes);
}

// Add Classes to product image box
function flatsome_product_box_image_class(){
    $hover_style = flatsome_option('product_hover');
    if($hover_style == 'fade_in_back' && $hover_style == 'zoom_in') return;
    $classes = array();
    $classes[] = 'image-'.$hover_style;
    if(!empty($classes)) return implode(' ', $classes);
}

// Add Classes to product actions
function flatsome_product_box_actions_class(){
    return 'grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover';
}

function flatsome_product_box_text_class(){
    $classes = array('box-text-products');

    $grid_style = flatsome_option('grid_style');

    if($grid_style == 'grid2'){
        $classes[] = 'text-center grid-style-2';
    }

    if($grid_style == 'grid3'){
        $classes[] = 'flex-row align-top grid-style-3 flex-wrap';
    }

    return implode(' ', $classes);
}
