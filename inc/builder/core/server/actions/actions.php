<?php

/**
 * Add custom page to render UX Builder on.
 */
add_action( 'admin_menu', function () {
  add_submenu_page(
    null,
    'UX Builder',
    'UX Builder',
    'edit_posts',
    'uxbuilder',
    'ux_builder_edit_page_callback'
  );
} );

function ux_builder_edit_page_callback () {
  echo 'uxbuilder';
}

/**
 * Register breakpoints.
 */
function ux_builder_register_breakpoints() {
  // Add Ux Builder to posts and pages as default.
  add_ux_builder_post_type( 'post' );
  add_ux_builder_post_type( 'page' );

  // Register default breakpoints.
  add_ux_builder_breakpoint( 'sm', 550,  'Mobile',  'dashicons dashicons-smartphone' );
  add_ux_builder_breakpoint( 'md', 850,  'Tablet',  'dashicons dashicons-tablet' );
  add_ux_builder_breakpoint( 'lg', 1000, 'Desktop', 'dashicons dashicons-desktop' );

  // Set "lg" as default breakpoint.
  set_default_ux_builder_breakpoint( 'lg' );
}
add_action( 'init', 'ux_builder_register_breakpoints' );

/**
 *
 */
function ux_builder_admin_setup() {
  do_action( 'ux_builder_init' );
}
add_action( 'admin_init', 'ux_builder_admin_setup' );

/**
 * Add «Edit with UX Builder» button in
 * admin toolbar for registered post types.
 */
function ux_builder_admin_bar_link() {
    global $wp_admin_bar;
    global $post;

    if ( ! is_page() && ! is_single() ) return;
    if ( ! current_user_can( 'edit_post', $post->ID ) ) return;

    $permalink = get_the_permalink();
    $afterlink = get_option( 'permalink_structure' ) ? '?' : '&';
    $post_types = get_ux_builder_post_types();

    if ( array_key_exists( $post->post_type, $post_types ) ) {
        $wp_admin_bar->add_menu( array(
            'parent' => 'edit',
            'id' => 'edit_uxbuilder',
            'title' => 'Edit with UX Builder',
            'href' => ux_builder_edit_url( $post->ID ),
        ));
    }
}
add_action( 'wp_before_admin_bar_render', 'ux_builder_admin_bar_link' );

/**
 * Add editor tabs to top of edit page on registered post types.
 */
function ux_builder_meta_boxes() {
  global $post;

  if ( ! current_user_can( 'edit_post', $post->ID ) ) return;

  // Do not show UX Bulder link on Shop page.
  if ( function_exists( 'is_woocommerce' ) && $post->ID == wc_get_page_id( 'shop' ) ) {
    return;
  }

  $current_screen = get_current_screen()->id;
  $post_types = get_ux_builder_post_types();

  if ( array_key_exists( $current_screen, $post_types ) ) {
      add_action( 'edit_form_top', 'ux_builder_edit_form_top' );
  }
}
add_action( 'add_meta_boxes', 'ux_builder_meta_boxes' );

/**
 * Render the editor tabs.
 */
function ux_builder_edit_form_top(){
    global $post; ?>
    <h2 id="uxbuilder-enable-disable" class="nav-tab-wrapper woo-nav-tab-wrapper">
        <a href="<?php echo admin_url( "post.php?post={$post->ID}&action=edit" ) ?>" class="nav-tab nav-tab-active">
            <?php echo __( 'Editor' ); ?>
        </a>
        <a href="<?php echo ux_builder_edit_url( $post->ID ); ?>" class="nav-tab">
            <strong style="color:#627f9a; padding: 0px 5px; margin-right:5px; border: 2px solid #627f9a;">UX</strong>
            <?php echo __( 'Builder' ); ?>
        </a>
    </h2>
    <?php
}

/**
 * Add inline links to post tables.
 *
 * @param  array  $actions
 * @param  object $page_object
 * @return array
 */
function ux_builder_page_row_actions( $actions, $page_object ) {
    $post_types = get_ux_builder_post_types();

    // Do not show UX Bulder link on Shop page.
    if ( function_exists( 'is_woocommerce' ) && $page_object->ID == wc_get_page_id( 'shop' ) ) {
      return $actions;
    }

    if ( array_key_exists( $page_object->post_type, $post_types ) &&
        current_user_can( 'edit_post', $page_object->ID ) ) {
        array_splice($actions, 1, 0, '<a href="' . ux_builder_edit_url( $page_object->ID ) . '">' . __( 'Edit with UX Builder' ) . '</a>' );
    }

    return $actions;
}
add_filter( 'page_row_actions', 'ux_builder_page_row_actions', 10, 2 );

/**
 * Search only page title when searching for posts.
 *
 * @param  string $search
 * @param  object $wp_query
 * @return string
 */
function ux_builder_post_search( $search, $wp_query ) {
    global $wpdb;

    if( empty( $search ) ) return $search;

    if ( array_key_exists( 'action', $_GET ) &&
        $_GET['action'] == 'ux_builder_search_posts' ) {

        $q = $wp_query->query_vars;
        $n = !empty( $q['exact'] ) ? '' : '%';
        $search = $searchand = '';

        foreach ( (array) $q['search_terms'] as $term) {
            $term = esc_sql( $wpdb->esc_like( $term ) );
            $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
            $searchand = ' AND ';
        }

        if ( !empty( $search ) ) {
            $search = " AND ({$search}) ";
            if (!is_user_logged_in())
                $search .= " AND ($wpdb->posts.post_password = '') ";
        }
    }

    return $search;
}
add_filter( 'posts_search', 'ux_builder_post_search', 500, 2 );
