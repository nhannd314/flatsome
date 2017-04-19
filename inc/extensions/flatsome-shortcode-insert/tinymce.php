<?php

/* NEW */
add_action('admin_head', 'ux_shortcode_button');
function ux_shortcode_button() {
    global $typenow;
    // check user permissions
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
    return;
    }
    // verify the post type
    if( ! in_array( $typenow, array( 'post', 'page', 'blocks', 'product' ) ) )
        return;
    // check if WYSIWYG is enabled
    if ( get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "ux_shortcode_add_tinymce_plugin");
        add_filter('mce_buttons', 'ux_shortcode_insert_button');
    }
}

function ux_shortcode_add_tinymce_plugin($plugin_array) {
    $plugin_array['ux_shortcode_insert'] = get_template_directory_uri().'/inc/extensions/flatsome-shortcode-insert/shortcode_insert.js';
    return $plugin_array;
}

function ux_shortcode_insert_button($buttons) {
   array_push($buttons, "ux_shortcode_insert");
   return $buttons;
}

function ux_shortcode_css() {
    // TODO: Only Load on Edit Page
    wp_enqueue_style('ux_shortcode_insert_css', get_template_directory_uri().'/inc/extensions/flatsome-shortcode-insert/style.css');
}

add_action('admin_enqueue_scripts', 'ux_shortcode_css');
