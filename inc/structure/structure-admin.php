<?php

/* Add Custom WP Editor CSS */

if(!function_exists('flatsome_editor_style')) {
  function flatsome_editor_style($url) {
    if ( !empty($url) )
      $url .= ',';
    // Change the path here if using sub-directory
    $url .= trailingslashit( get_template_directory_uri() ) . 'assets/css/editor.css';
    return $url;
  }
}
add_filter('mce_css', 'flatsome_editor_style');


/* Extra Editor Styles (add extra styles to the content editor box) */
if(!function_exists('flatsome_mce_buttons_2')) {
  function flatsome_mce_buttons_2( $buttons ) {
      array_unshift( $buttons, 'styleselect' );
      return $buttons;
  }
}
add_filter( 'mce_buttons', 'flatsome_mce_buttons_2' );


// Customize mce editor font sizes
if ( ! function_exists( 'flatsome_editor_text_sizes' ) ) {
  function flatsome_editor_text_sizes( $initArray ){
    $initArray['fontsize_formats'] = "75% 80% 85% 90% 95% 100% 105% 110% 115% 120% 130% 140% 150% 160% 170% 180% 190% 200% 250% 300% 350% 400% 450% 500%";
    return $initArray;
  }
}
add_filter( 'tiny_mce_before_init', 'flatsome_editor_text_sizes' );


// Enable font size & font family selects in the editor
if ( ! function_exists( 'flatsome_font_buttons' ) ) {
  function flatsome_font_buttons( $buttons ) {
    //array_splice( $buttons, 2, 0, 'fontselect' ); // Add Font Select
    array_splice( $buttons, 5, 0, 'backcolor' ); // Add Font Size Select
    array_splice( $buttons, 2, 0, 'fontsizeselect' ); // Add Font Size Select
    return $buttons;
  }
}
add_filter( 'mce_buttons_2', 'flatsome_font_buttons');


function flatsome_formats_before_init( $settings ) {

    $style_formats = array(

        array(
              'title' => 'Link styles',
              'selector' => 'a',
                  'items' => array(
                  array(
                      'title' => 'Button Primary',
                       'selector' => 'a',
                       'classes' => 'button primary',
                  ),
                    array(
                      'title' => 'Button White',
                       'selector' => 'a',
                       'classes' => 'button white',
                  ),
                  array(
                       'title' => 'Button Secondary',
                       'selector' => 'a',
                       'classes' => 'button secondary',

                  ),
                  array(
                       'title' => 'Button Alert',
                       'selector' => 'a',
                       'classes' => 'button alert',

                  ),
                  array(
                       'title' => 'Button Success',
                       'selector' => 'a',
                       'classes' => 'button success',

                  ),
                  array(
                       'title' => 'Button Alternative Primary',
                       'selector' => 'a',
                       'classes' => 'button is-outline',

                  ),
                   array(
                       'title' => 'Button Alternative White',
                       'selector' => 'a',
                       'classes' => 'button is-outline white',

                  ),
                        array(
                      'title' => 'Large - Button Primary',
                       'selector' => 'a',
                       'classes' => 'button large  primary',
                  ),
                  array(
                       'title' => 'Large Button Secondary',
                       'selector' => 'a',
                       'classes' => 'button large  secondary',

                  ),
                  array(
                       'title' => 'Large Button Alert',
                       'selector' => 'a',
                       'classes' => 'button large  alert',

                  ),
                  array(
                       'title' => 'Large Button Success',
                       'selector' => 'a',
                       'classes' => 'button large  success',

                  ),
                  array(
                       'title' => 'Large Button Alternative Primary',
                       'selector' => 'a',
                       'classes' => 'button large  is-outline success',

                  ),
                  array(
                       'title' => 'Large Button Alternative Secondary',
                       'selector' => 'a',
                       'classes' => 'button large  is-outline secondary',

                  ),
                   array(
                       'title' => 'Large Button Alternative White',
                       'selector' => 'a',
                       'classes' => 'button large is-outline white',

                  )
              )
        ),
        array(
            'title' => 'Animations',
                'items' => array(
                  array(
                    'title' => 'None',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p,a,span',
                    'attributes' => array('data-animate' => ''),
                  ),
                  array(
                  'title' => 'Fade In',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a,span',
                  'attributes' => array('data-animate' => 'fadeIn'),
                ),
                array(
                  'title' => 'Fade In Left',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a,span',
                  'attributes' => array('data-animate' => 'fadeInLeft'),
                ),
                array(
                  'title' => 'Fade In Right',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a,span',
                  'attributes' => array('data-animate' => 'fadeInRight'),
                ),
                array(
                  'title' => 'Fade In Up',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a,span',
                  'attributes' => array('data-animate' => 'fadeInUp'),
                ),
            )
        ),
        array(
            'title' => 'Animations - Delay',
                'items' => array(
                     array(
                    'title' => 'Default',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                    'attributes' => array('data-animate-delay' => ''),
                  ),
                    array(
                    'title' => '.1s',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                    'attributes' => array('data-animate-delay' => '200'),
                  ),
                  array(
                  'title' => '.2s',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-animate-delay' => '200'),
                ),
                array(
                  'title' => '.3s',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-animate-delay' => '300'),
                ),
                array(
                  'title' => '.4s',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-animate-delay' => '400'),
                ),
                    array(
                  'title' => '.5s',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-animate-delay' => '500'),
                ),
                array(
                  'title' => '.6s',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-animate-delay' => '600'),
                ),
                  array(
                  'title' => '.7s',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-animate-delay' => '700'),
                ),
                    array(
                  'title' => '.8s',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-animate-delay' => '800'),
                ),
                array(
                  'title' => '.9s',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-animate-delay' => '900'),
                ),
                array(
                  'title' => '1s',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-animate-delay' => '1000'),
                ),
            )
        ),
     array(
              'title' => 'Visibility',
              'items' => array(
                  array(
                    'title' => 'Show for All',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p',
                    'attributes' => array('data-show' => ''),
                  ),
                  array(
                    'title' => 'Hide for Mobile',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p',
                    'attributes' => array('data-show' => 'hide-for-small'),
                  ),
                  array(
                    'title' => 'Hide for Tablet',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p',
                    'attributes' => array('data-show' => 'hide-for-medium'),
                  ),
                 array(
                    'title' => 'Show only on Mobile',
                     'selector' => 'h1,h2,h3,h4,h5,h6,p',
                     'attributes' => array('data-show' => 'show-for-small'),
                  ),
                  array(
                    'title' => 'Show only on Tablet',
                     'selector' => 'h1,h2,h3,h4,h5,h6,p',
                     'attributes' => array('data-show' => 'show-for-medium'),
                  ),
                )
        ),
        array(
            'title' => 'Opacity',
                'items' => array(
                  array(
                  'title' => '1',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-opacity' => ''),
                ),
                array(
                  'title' => '0.9',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-opacity' => '0.9'),
                ),
                array(
                  'title' => '0.8',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-opacity' => '0.8'),
                ),
                array(
                  'title' => '0.7',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-opacity' => '0.7'),
                ),
                 array(
                  'title' => '0.6',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-opacity' => '0.6'),
                ),
                  array(
                  'title' => '0.5',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-opacity' => '0.5'),
                ),
            )
       ),
        array(
            'title' => 'Line Height',
                'items' => array(
                  array(
                    'title' => 'Default',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p,a,span',
                    'attributes' => array('data-line-height' => ''),
                 ),
                  array(
                  'title' => 'X-Small',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a,span',
                  'attributes' => array('data-line-height' => 'xs'),
                 ),
                array(
                  'title' => 'Small',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a,span',
                  'attributes' => array('data-line-height' => 's'),
                ),
                array(
                  'title' => 'Medium',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a,span',
                  'attributes' => array('data-line-height' => 'm'),
                ),
                array(
                  'title' => 'Large',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a,span',
                  'attributes' => array('data-line-height' => 'l'),
                ),
                array(
                  'title' => 'X Large',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a,span',
                  'attributes' => array('data-line-height' => 'xl'),
                ),
            )
        ),
       array(
            'title' => 'Padding',
                'items' => array(
                  array(
                  'title' => '5px',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-padding' => '5px'),
                ),
                  array(
                  'title' => '10px',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-padding' => '10px'),
                ),
                  array(
                  'title' => '15px',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-padding' => '15px'),
                ), array(
                  'title' => '20px',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-padding' => '20px'),
                ),
                array(
                  'title' => '30px',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-padding' => '30px'),
                ),
                 array(
                  'title' => '40px',
                  'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
                  'attributes' => array('data-padding' => '40px'),
                ),
            )
        ),
        array(
            'title' => 'Text Color',
                'items' => array(
                array(
                  'title' => 'None',
                  'inline' => 'span',
                  'attributes' => array('data-text-color' => ''),
                ),
                array(
                  'title' => 'Primary Color',
                  'inline' => 'span',
                  'attributes' => array('data-text-color' => 'primary'),
                ),
                array(
                  'title' => 'Secondary Color',
                  'inline' => 'span',
                  'attributes' => array('data-text-color' => 'secondary'),
                ),
                array(
                  'title' => 'Alert Color',
                  'inline' => 'span',
                  'attributes' => array('data-text-color' => 'alert'),
                ),  array(
                  'title' => 'Success Color',
                  'inline' => 'span',
                  'attributes' => array('data-text-color' => 'success'),
                ),
            )
        ),
        array(
            'title' => 'Text Background',
                'items' => array(
                array(
                  'title' => 'Primary BG Color',
                  'inline' => 'span',
                  'attributes' => array('data-text-bg' => 'primary'),
                ),
                  array(
                  'title' => 'Secondary BG Color',
                  'inline' => 'span',
                  'attributes' => array('data-text-bg' => 'secondary'),
                ),
                   array(
                  'title' => 'Alert BG Color',
                  'inline' => 'span',
                  'attributes' => array('data-text-bg' => 'alert'),
                ),  array(
                  'title' => 'Success BG Color',
                  'inline' => 'span',
                  'attributes' => array('data-text-bg' => 'success'),
                ),
            )
        ),
        array(
              'title' => 'List Styles',
              'items' => array(
                 array(
                  'title' => 'Bullets List - Check mark',
                  'selector' => 'li',
                  'classes' => 'bullet-checkmark',

                ),
                array(
                  'title' => 'Bullets List - Arrow',
                  'selector' => 'li',
                  'classes' => 'bullet-arrow',

                ),
                array(
                  'title' => 'Bullets List - Star',
                  'selector' => 'li',
                  'classes' => 'bullet-star',
                ),

            )
        ),
        array(
          'title' => 'Lead Text (p)',
          'block' => 'p',
          'classes' => 'lead',
          'exact' => true,
        ),
        array(
          'title' => 'Count Up Number',
          'inline' => 'span',
          'classes' => 'count-up',
          'exact' => true,
        ),
        array(
          'title' => 'Uppercase',
          'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
          'classes' => 'uppercase',
           'exact' => true,
        ),
       array(
          'title' => 'Fancy Underline',
          'inline' => 'span',
          'classes' => 'fancy-underline',
          'exact' => true,
        ),
         array(
          'title' => 'Thin Font',
          'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
          'classes' => 'thin-font',
        ),

        array(
          'title' => 'Alternative Font',
          'selector' => 'h1,h2,h3,h4,h5,h6,p,a',
          'classes' => 'alt-font',
        ),
    );

    $style_formats = apply_filters( 'flatsome_text_formats', $style_formats );
    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}
add_filter( 'tiny_mce_before_init', 'flatsome_formats_before_init' );


/* Extra Editor Colors */
if ( ! function_exists( 'flatsome_text_colors' ) ) {
  function flatsome_text_colors( $init ) {
    global $flatsome_opt;
    $default_colours = '
        "000000", "Black",        "993300", "Burnt orange", "333300", "Dark olive",   "003300", "Dark green",   "003366", "Dark azure",   "000080", "Navy Blue",      "333399", "Indigo",       "333333", "Very dark gray",
        "800000", "Maroon",       "FF6600", "Orange",       "808000", "Olive",        "008000", "Green",        "008080", "Teal",         "0000FF", "Blue",           "666699", "Grayish blue", "808080", "Gray",
        "FF0000", "Red",          "FF9900", "Amber",        "99CC00", "Yellow green", "339966", "Sea green",    "33CCCC", "Turquoise",    "3366FF", "Royal blue",     "800080", "Purple",       "999999", "Medium gray",
        "FF00FF", "Magenta",      "FFCC00", "Gold",         "FFFF00", "Yellow",       "00FF00", "Lime",         "00FFFF", "Aqua",         "00CCFF", "Sky blue",       "993366", "Brown",        "C0C0C0", "Silver",
        "FF99CC", "Pink",         "FFCC99", "Peach",        "FFFF99", "Light yellow", "CCFFCC", "Pale green",   "CCFFFF", "Pale cyan",    "99CCFF", "Light sky blue", "CC99FF", "Plum",         "FFFFFF", "White"
    ';
    $custom_colours = '
        "e14d43", "Primary Color", "d83131", "Color 2 Name", "ed1c24", "Color 3 Name", "f99b1c", "Color 4 Name", "50b848", "Color 5 Name", "00a859", "Color 6 Name",   "00aae7", "Color 7 Name", "282828", "Color 8 Name"
    ';
    $init['textcolor_map'] = '['.$custom_colours.','.$default_colours.']';
    return $init;
  }
}
add_filter('tiny_mce_before_init', 'flatsome_text_colors');


/* Enable SVG upload */
function flatsome_enable_svg( $mimes ){
  // enable svg for super users.
  if(current_user_can('manage_options')){
      $mimes['svg'] = 'image/svg+xml';
  }
  return $mimes;
}
add_filter( 'upload_mimes', 'flatsome_enable_svg' );


function flatsome_enable_font_upload( $mimes ){
  $mimes['ttf'] = 'application/octet-stream';
  $mimes['otf'] = 'font/opentype';
  return $mimes;
}
add_filter( 'upload_mimes', 'flatsome_enable_font_upload' );
