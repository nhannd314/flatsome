<?php

// [page_header]
function flatsome_page_header_shortcode($atts) {
  $atts = shortcode_atts( array(
    '_id' => 'page-header-'.rand(),

    // Layout
    'height' => '',
    'height__sm' => '',
    'height__md' => '',
    'margin' => '',
    'margin__sm' => '',
    'margin__md' => '',
    'style' => 'featured', // divided / simple / normal / featured.
    'align' => 'left',
    'v_align' => 'center',
    'type' => 'breadcrumbs', // none / breadcrumbs / subnav / onpage
    'depth' => '',
    'parallax' => '',
    'parallax_text' => '',
    'sticky' => '', // WIP

    // Text
    'text_color' => 'light',

    // Background
    'bg' => '',
    'bg_color' => '',
    'bg_overlay' => '',
    'bg_pos' => '',
    'bg_size' => '',

    // Titles
    'show_title' => true,
    'title' => '',
    'title_size' => '',
    'title_case' => '',
    'sub_title' => '',

    // Element
    'nav_size' => '',
    'nav_style' => 'line',
    'nav_case' => 'uppercase',

    // Show share
    'share' => '',
  ), $atts);

  extract( $atts );

  $classes = array();
  $container_classes = array( "align-{$v_align}" );
  $subtitle_classes = array();
  $content_classes = array();


  if ($text_color == 'light') $classes[] = 'dark';
  if ($text_color == 'dark') $classes[] = 'light';

  if ( $style ) {
    $classes[] = $style . '-title';
    if ( $style == 'featured' ) {
      // $classes[] = 'dark nav-dark';
      if ( ! $bg ) $bg = get_post_thumbnail_id();
    }
  }

  // Title
  $title_classes = array();
  if ( $title_case ) $title_classes[] = $title_case;
  if ( $title_size ) $title_classes[] = 'is-' . $title_size;

  if ( $parallax || $parallax_text ) $classes[] = 'has-parallax';

  // Get default page title
  if ( ! $title ) $title = get_the_title();

  // Depth
  if ( $depth ) $classes[] = 'box-shadow-'.$depth;

  // Nav style
  $nav_class = array('sm-touch-scroll');
  if ( $nav_size ) $nav_class[] = 'nav-size-'.$nav_size;
  if ( $nav_style ) $nav_class[] = 'nav-'.$nav_style;
  if ( $nav_case ) $nav_class[] = 'nav-'.$nav_case;

  if ( $align ) $nav_class[] = 'text-'.$align.' nav-'.$align;

  $nav_class = implode(' ', $nav_class);

  // Parallax text
  if ( $parallax_text ) {
    $parallax_text = 'data-parallax-fade="true" data-parallax="-' . $parallax_text . '"';
  }

   // Bg fix
   $atts['bg'] = $bg;

   // Add Content
   ob_start();

   // Breadcrumbs
   if ( $type == 'breadcrumbs' ) {
     echo '<div class="title-breadcrumbs pb-half pt-half">';
     get_flatsome_breadcrumbs();
     echo '</div>';
   } else if ( $type == 'subnav' ) {
     get_flatsome_subnav( $nav_class );
   } else if ( $type == 'onpage' ) {
     echo '<ul class="nav '.$nav_class.'"><li class="nav-single-page hidden"></li></ul>';
   } else if ( $type == 'share' ) {
     echo '<div class="title-share pt-half pb-half">' . do_shortcode( '[share]' ) . '</div>';
   }

   if ( $align == 'left' ) $content_align = 'right';
   else if ( $align == 'right' ) $content_align = 'left';
   else $content_align = 'center';

   switch ( $align ) {
    case 'center':
       $container_classes[] = 'text-center flex-row-col medium-flex-wrap';
       $title_classes[] = 'flex-col';
       $subtitle_classes[] = 'flex-col';
       $content_classes[] = 'flex-col';
       break;
    case 'right':
       $container_classes[] = 'flex-row medium-flex-wrap row-reverse';
       $title_classes[] = 'flex-col text-right medium-text-center';
       $subtitle_classes[] = 'flex-col mr medium-text-center';
       $content_classes[] = 'flex-col flex-left text-left medium-text-center';
       break;
    case 'left':
       $container_classes[] = 'flex-row medium-flex-wrap';
       $title_classes[] = 'flex-col text-left medium-text-center';
       $subtitle_classes[] = 'flex-col ml medium-text-center';
       $content_classes[] = 'flex-col flex-right text-right medium-text-center';
       break;
   }

   // Sub nav
   //get_flatsome_subnav($nav_class);

   $content = ob_get_contents();
   ob_end_clean();
   ob_start();
  ?>
  <div id="<?php echo $_id; ?>" class="page-header-wrapper">
  <div class="page-title <?php echo implode(' ', $classes); ?>">

    <?php if ( $bg || $bg_color ) { ?>
    <div class="page-title-bg">
      <div class="title-bg fill bg-fill"
        data-parallax-container=".page-title"
        data-parallax-background
        data-parallax="-<?php echo $parallax; ?>">
      </div>
      <div class="title-overlay fill"></div>
    </div>
    <?php } ?>

    <div class="page-title-inner container <?php echo implode( ' ', $container_classes ); ?>" <?php echo $parallax_text; ?>>
      <?php if ( $show_title ) { ?>
        <div class="title-wrapper <?php echo implode(' ', $title_classes ); ?>">
          <h1 class="entry-title mb-0">
            <?php echo $title; ?>
          </h1>
        </div>
        <?php if ( $sub_title ) { ?>
        <div class="page-title-sub op-7 <?php echo implode(' ', $subtitle_classes ); ?>">
          <p class="lead"><?php echo $sub_title; ?></p>
        </div>
        <?php } ?>
      <?php } ?>
      <div class="title-content <?php echo implode( ' ', $content_classes ); ?>">
        <?php echo $content; ?>
      </div>
    </div><!-- flex-row -->

     <?php
      // Get custom CSS
      $args = array(
        'height' => array(
          'selector' => '.page-title-inner',
          'property' => 'min-height',
        ),
        'margin' => array(
          'selector' => '',
          'property' => 'margin-bottom',
        ),
        'bg' => array(
          'selector' => '.title-bg',
          'property' => 'background-image',
          'size' => $bg_size
        ),
        'bg_overlay' => array(
          'selector' => '.title-overlay',
          'property' => 'background-color',
        ),
        'bg_color' => array(
          'selector' => '',
          'property' => 'background-color',
        ),
        'bg_pos' => array(
          'selector' => '.title-bg',
          'property' => 'background-position',
        ),
      );
      echo ux_builder_element_style_tag($_id, $args, $atts);
    ?>
  </div><!-- .page-title -->
  <?php if($style == 'divided') echo '<div class="container header-wrapper-divider"><hr/></div>'; ?>
  </div><!-- .page-header-wrapper -->
  <?php
   $content = ob_get_contents();
   ob_end_clean();
   return $content;
}

add_shortcode("page_header", "flatsome_page_header_shortcode");
