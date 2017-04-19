<?php

// Remove Default links
remove_action( 'woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open', 10);
remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close', 5);


/* Move Sale Flash */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10);


// Change product pr page if set.
function flatsome_product_pr_page(){
   return flatsome_option('products_pr_page');
}
add_filter( 'loop_shop_per_page', create_function( '$cols', "return flatsome_product_pr_page();" ), 20 );


/* Set WooCommerce product loop classes */
function flatsome_product_row_classes($cols = null){
    $classes = array('row','row-small');

    $category_grid_style = flatsome_option('category_grid_style');


    if($category_grid_style == 'masonry'){
      wp_enqueue_script('flatsome-masonry-js');
      $classes[] = 'row-masonry has-packery';
    }

    if(get_theme_mod('category_grid_style') == 'list'){
        $classes[] = 'has-box-vertical';
    }

    $columns = flatsome_option('category_row_count');

    if($cols) $columns = $cols;
    if(is_cart()) $columns = 4;

    $classes[] = 'large-columns-'.$columns;
    $classes[] = 'medium-columns-'.flatsome_option('category_row_count_tablet');
    $classes[] = 'small-columns-'.flatsome_option('category_row_count_mobile');

    $shadow = flatsome_option('category_shadow');
    $shadow_hover = flatsome_option('category_shadow_hover');

    if($shadow || $shadow_hover) $classes[] = 'has-shadow';
    if($shadow) $classes[] = 'row-box-shadow-'.$shadow;
    if($shadow_hover) $classes[] = 'row-box-shadow-'.$shadow_hover.'-hover';

    return implode(' ', $classes);
}

function flatsome_products_footer_content(){
    if(is_product_category() || is_product_tag()){
      $queried_object = get_queried_object();
      $content = get_term_meta($queried_object->term_id, 'cat_meta');
        if(!empty($content[0]['cat_footer'])){
            echo '<hr/>';
            echo do_shortcode($content[0]['cat_footer']);
        }
    }
}
add_action('flatsome_products_after','flatsome_products_footer_content');


/* Add Custom Meta to Category */
if(is_admin()){
    if(function_exists('get_term_meta')){
    function top_text_taxonomy_edit_meta_field($term) {
        // put the term ID into a variable
        $t_id = $term->term_id;
        // retrieve the existing value(s) for this meta field. This returns an array
        $term_meta = get_term_meta($t_id,'cat_meta');
        if(!$term_meta){$term_meta = add_term_meta($t_id, 'cat_meta', '');}
         ?>
        <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[cat_header]"><?php _e( 'Top Content', 'flatsome' ); ?></label></th>
            <td>
                    <?php
                    $content = esc_attr( isset($term_meta[0]['cat_header']) ) ? esc_attr( $term_meta[0]['cat_header'] ) : '';
                    echo '<textarea id="term_meta[cat_header]" name="term_meta[cat_header]">'.$content.'</textarea>'; ?>
                <p class="description"><?php _e( 'Enter a value for this field. Shortcodes are allowed. This will be displayed at top of the category.','flatsome' ); ?></p>
            </td>
        </tr>
    <?php
    }
    add_action( 'product_cat_edit_form_fields', 'top_text_taxonomy_edit_meta_field', 10, 2 );
    add_action( 'product_tag_edit_form_fields', 'top_text_taxonomy_edit_meta_field', 10, 2 );

    /* ADD CUSTOM META BOX TO CATEGORY PAGES */
    function bottom_text_taxonomy_edit_meta_field($term) {
      // put the term ID into a variable
      $t_id = $term->term_id;
      // retrieve the existing value(s) for this meta field. This returns an array
      $term_meta = get_term_meta($t_id,'cat_meta');
      if(!$term_meta){$term_meta = add_term_meta($t_id, 'cat_meta', '');}
       ?>
      <tr class="form-field">
      <th scope="row" valign="top"><label for="term_meta[cat_footer]"><?php _e( 'Bottom Content', 'flatsome' ); ?></label></th>
        <td>
            <?php
            $content = isset($term_meta[0]['cat_footer']) ? esc_attr( $term_meta[0]['cat_footer'] ) : '';
            echo '<textarea id="term_meta[cat_footer]" name="term_meta[cat_footer]">'.$content.'</textarea>'; ?>
          <p class="description"><?php _e( 'Enter a value for this field. Shortcodes are allowed. This will be displayed at bottom of the category.','flatsome' ); ?></p>
        </td>
      </tr>
    <?php
    }
    add_action( 'product_cat_edit_form_fields', 'bottom_text_taxonomy_edit_meta_field', 10, 2 );
    add_action( 'product_tag_edit_form_fields', 'bottom_text_taxonomy_edit_meta_field', 10, 2 );


    /* SAVE CUSTOM META*/
    function fl_save_taxonomy_custom_meta( $term_id ) {
        if ( isset( $_POST['term_meta'] ) ) {
            $t_id = $term_id;
            $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_term_meta($term_id, 'cat_meta', $term_meta);
        }
    }
    add_action( 'edited_product_cat', 'fl_save_taxonomy_custom_meta', 10, 2 );
    add_action( 'edited_product_tag', 'fl_save_taxonomy_custom_meta', 10, 2 );

    }
} // is_admin
