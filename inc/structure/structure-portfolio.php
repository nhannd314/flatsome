<?php

// Add Transparent Header if set
function flatsome_portfolio_header_classes($classes){
    // Add transparent header to product page if set.
    if(is_singular( 'featured_item' ) && flatsome_option('portfolio_title_transparent')){
         $classes[] = 'transparent has-transparent nav-dark toggle-nav-dark';
    }

    $trans = flatsome_option('portfolio_archive_title_transparent');
    if(is_page_template( 'page-featured-items-4col.php' ) && $trans || is_page_template( 'page-featured-items-3col.php' ) && $trans || is_tax('featured_item_category') && $trans){
         $classes[] = 'transparent has-transparent nav-dark toggle-nav-dark';
    }
    return $classes;
}

add_filter('flatsome_header_class','flatsome_portfolio_header_classes', 10);



function flatsome_next_post_link_portfolio() {
    global $post;
    $next_post = get_next_post(true,'','featured_item_category');
    if ( is_a( $next_post , 'WP_Post' ) ) { ?>
          <a title="<?php echo get_the_title( $next_post->ID ); ?>" class="prev-link plain" href="<?php echo get_the_permalink( $next_post->ID ); ?>">
          <?php echo get_the_title($next_post->ID);?>
          <?php echo get_flatsome_icon('icon-angle-right');?>
          </a>
    <?php }
}

function flatsome_previous_post_link_portfolio() {
    global $post;
    $prev_post = get_previous_post(true,'','featured_item_category');
    if ( is_a( $prev_post , 'WP_Post' ) ) { ?>
      
        <a title="<?php echo get_the_title( $prev_post->ID ); ?>" class="next-link plain" href="<?php echo get_the_permalink( $prev_post->ID ); ?>">
         <?php echo get_flatsome_icon('icon-angle-left');?>
         <?php echo get_the_title($prev_post->ID);?>
        </a>
   
    <?php }
}

function get_flatsome_portfolio_breadcrumbs(){
    global $page;
    echo '<div class="breadcrumbs"><a href="';
    echo get_option('home');
    echo '">';
    echo 'Home';
    echo "</a>";
    echo "<span class='divider'>/</span>";
    if(flatsome_option('featured_items_page') && !is_page()){
      $page_parent = get_page_by_path(flatsome_option('featured_items_page'));
      echo '<a href="'.get_the_permalink($page_parent->ID).'">'.get_the_title($page_parent->ID).'</a>';
      echo "<span class='divider'>/</span>";
    }
    if(is_single()){
    echo get_the_term_list( get_the_ID(), 'featured_item_category', '', '<span class="divider">-</span>', '' );
    }
    // Current page
    if(is_tax()){
      $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
      echo $term->name;
    } else if(is_page()) {
      echo get_the_title();
    }
    echo "</div>";
}