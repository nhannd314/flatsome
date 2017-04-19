<?php

function ux_navigation($atts) {
    extract(shortcode_atts(array(
      'parent' => '',
      'align' => 'left',
      'style' => 'line',
      'type' => 'vertical', // horizontal / vertical
      'size' => '',
      'case' => 'uppercase',
      //'bg_color' => '',
      //'height' => '',
      //'sticky' => '',
    ), $atts));
    
      ob_start();

      global $post;
      $current = get_the_ID($post->ID);
      $classes = array('nav');

      if($case) $classes[] = 'nav-'.$case;
      if($type) $classes[] = 'nav-'.$type;
      if($size) $classes[] = 'nav-size-'.$size;
      if($style) $classes[] = 'nav-'.$style;
      if($align) $classes[] = 'text-'.$align.' nav-'.$align;

      echo '<div class="nav-wrapper">';
      echo '<ul class="'.implode(' ',$classes).'">';
     
      if ( is_page() && $post->post_parent && !$parent ){
          $childpages = get_pages( array( 'child_of' => $post->post_parent, 'sort_column' => 'menu_order' ) );
      } else {
          $post_id = $post->ID;
          if($parent) {
            if(!is_numeric($parent)){
              $id = get_page_by_path( $parent );
              $parent = $id->ID;
            }
            $post_id = $parent;
          }
          $childpages = get_pages( array( 'child_of' => $post_id, 'sort_column' => 'menu_order' ) );
          if(!$childpages) echo '<p class="lead shortcode-error text-center">Sorry, no pages was found</p>';
      }
      foreach (  $childpages as $page ) {
        $classes = '';
        if($page->ID == $current) $classes = 'active';
        echo '<li class='.$classes.'><a href="'.get_the_permalink($page->ID).'">'.$page->post_title.'</a></li>';
      }
      echo '</ul>';
      echo '</div>';

      $content = ob_get_contents();
      ob_end_clean();
      return $content;
}

add_shortcode("ux_nav", "ux_navigation");
