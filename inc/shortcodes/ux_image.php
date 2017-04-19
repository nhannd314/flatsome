<?php
function ux_image( $atts, $content = null ){
  extract( shortcode_atts( array(
    '_id' => 'image_'.rand(),
    'id' => '',
    'org_img' => '',
    'caption' => '',
    'animate' => '',
    'animate_delay' => '',
    'lightbox' => '',
    'height' => '',
    'image_overlay' => '',
    'image_hover' => '',
    'image_hover_alt' => '',
    'image_size' => 'large',
    'icon' => '',
    'width' => '',
    'margin' => '',
    'position_x' => '',
    'position_x__sm' => '',
    'position_x__md' => '',
    'position_y' => '',
    'position_y__sm' => '',
    'position_y__md' => '',
    'depth' => '',
    'parallax' => '',
    'depth_hover' => '',
    'link' => '',
    'target' => '_self',
  ), $atts ) );

    if(empty($id)){ return '<div class="uxb-no-content uxb-image">Upload Image...</div>';}

    ob_start();

    $classes = array();
    $classes_inner = array('img-inner');
    $classes_img = array();
    $image_meta = wp_prepare_attachment_for_js( $id );


    if(is_numeric($id)){
        if(!$org_img){
            $org_img = wp_get_attachment_image_src($id, 'large');
            $org_img = $org_img[0];
        }
        if($caption && $caption == 'true') $caption = $image_meta['caption'];
    } else {
       if(!$org_img) $org_img = $id;
    }

    // If caption is enabled
    $link_start = '';
    $link_end = '';
    $link_class = '';

    if($link){
        if(strpos($link, 'watch?v=') !== false){
            $icon = 'icon-play';
            $link_class = 'open-video';
            if(!$image_overlay) $image_overlay = 'rgba(0,0,0,.2)';
        }
        $link_start = '<a href="'.$link.'" target="'.$target.'" class="'.$link_class.'">';
        $link_end = '</a>';
    } else if($lightbox) {
       $link_start = '<a class="image-lightbox lightbox-gallery" href="'.$org_img.'" title="'.$caption.'">';
       $link_end = '</a>';
    }

    // Set positions
    if ( function_exists( 'ux_builder_is_active' ) && ux_builder_is_active() ) {
      // Do not add positions if builder is active.
      // They will be set by the onChange handler.
    } else {
      $classes[] = flatsome_position_classes( 'x', $position_x, $position_x__sm, $position_x__md );
      $classes[] = flatsome_position_classes( 'y', $position_y, $position_y__sm, $position_y__md );
    }

    if($image_hover) $classes_inner[] = 'image-'.$image_hover;
    if($image_hover_alt) $classes_inner[] = 'image-'.$image_hover_alt;

    if($height) $classes_inner[] = 'image-cover';

    if($depth) $classes_inner[] = 'box-shadow-'.$depth;
    if($depth_hover) $classes_inner[] = 'box-shadow-'.$depth_hover.'-hover';

    // Add Parallax Attribute
    if($parallax) $parallax = 'data-parallax-fade="true" data-parallax="'.$parallax.'"';

    // Set image height
    $css_image_height = array(
      array( 'attribute' => 'padding-top', 'value' => $height),
      array( 'attribute' => 'margin', 'value' => $margin),
    );

    $classes =  implode(" ", $classes);
    $classes_inner =  implode(" ", $classes_inner);
    $classes_img =  implode(" ", $classes_img);

    ?>
    <div class="img has-hover <?php echo $classes; ?>" id="<?php echo $_id; ?>">
    <?php echo $link_start; ?>
    <?php if($parallax) echo '<div '.$parallax.'>'; ?>
    <?php if($animate) echo '<div data-animate="'.$animate.'">'; ?>
    <div class="<?php echo $classes_inner; ?> dark" <?php echo get_shortcode_inline_css($css_image_height); ?>>
        <?php echo flatsome_get_image($id, $image_size, $caption); ?>
        <?php if($image_overlay) { ?>
        <div class="overlay"
            style="background-color: <?php echo $image_overlay;?>">
        </div>
        <?php } ?>
        <?php if($icon) { ?>
            <div class="absolute no-click x50 y50 md-x50 md-y50 lg-x50 lg-y50 text-shadow-2">
                <div class="overlay-icon">
                    <i class="icon-play"></i>
                </div>
            </div>
        <?php } ?>

        <?php if($caption){ ?>
            <div class="caption"><?php echo $caption; ?></div>
        <?php } ?>
    </div>
    <?php if($animate) echo '</div>'; ?>
    <?php if($parallax) echo '</div>'; ?>
    <?php echo $link_end; ?>
       <?php
           $args = array(
             'width' => array(
                'selector' => '',
                'property' => 'width',
                'unit' => '%'
              )
           );
           echo ux_builder_element_style_tag( $_id, $args, $atts);
        ?>
    </div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('ux_image', 'ux_image');
