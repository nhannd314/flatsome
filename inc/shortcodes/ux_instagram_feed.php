<?php

// Instagram Feed
function ux_instagram_feed( $atts, $content = null ){
    extract( shortcode_atts( array(
      '_id' => 'instagram-'.rand(),
      'photos' => '10',
      'username' => 'wonderful_places',
      'target' => '_self',
      'caption' => 'true',
      'link' => '',
      'target' => '',
      // layout
      'columns' => '5',
      'type' => 'row',
      'col_spacing' => 'collapse',
      'slider_style' => '',
      'slider_nav_color' => '',
      'slider_nav_style' => '',
      'slider_nav_position' => '',
      'width' => '',
      'depth' => '',
      'depth_hover' => '',
      'animate' => '',

      // image
      'lightbox' => '',
      'image_overlay' => '',
      'image_hover' => 'overlay-remove',
      'size' => 'small', // small // thumbnail // original //
    ), $atts ) );

      ob_start();

      $limit = $photos;

      if ( $username != '' ) {

        $media_array = flatsome_scrape_instagram($username);

        if ( is_wp_error( $media_array ) ) {

          echo wp_kses_post( $media_array->get_error_message() );

        } else {

          // slice list down to required limit
          $media_array = array_slice( $media_array, 0, $limit );

          $repater['id'] = $_id;
          $repater['type'] = $type;
          $repater['style'] = 'overlay';
          $repater['slider_style'] = $slider_nav_style;
          $repater['slider_nav_position'] = $slider_nav_position;
          $repater['slider_nav_color'] = $slider_nav_color;
          $repater['row_spacing'] = $col_spacing;
          $repater['row_width'] = $width;
          $repater['columns'] = $columns;
          $repater['depth'] = $depth;
          $repater['depth_hover'] = $depth_hover;

          // filters for custom classes
          echo get_flatsome_repeater_start($repater);

          foreach ( $media_array as $item ) {
              echo '<div class="col"><div class="col-inner">';
              if($caption) $caption = $item['description']; ?>
              <div class="img has-hover no-overflow" id="<?php echo $_id; ?>">
                <div class="dark instagram-image-container image-<?php echo $image_hover; ?>">
                    <a href="<?php echo $item['link']; ?>" target="_blank" class="plain">
                    <?php echo flatsome_get_image($item[$size], false, $caption); ?>
                      <div class="overlay"
                          style="background-color: rgba(0,0,0,.2)">
                      </div>
                    <?php if($caption){ ?>
                        <div class="caption"><?php echo $caption; ?></div>
                    <?php } ?>
                    </a>
                </div>
                </div>

              <?php
              echo '</div></div>';
          }

          ?><?php

          echo get_flatsome_repeater_end($repater);
        }
      }

      if ( $link != '' ) {
        ?><a class="plain uppercase" href="<?php echo trailingslashit( '//instagram.com/' . esc_attr( trim( $username ) ) ); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>"><?php echo get_flatsome_icon('icon-instagram') ;?> <?php echo wp_kses_post( $link ); ?></a><?php
      }

    $w = ob_get_contents();

    ob_end_clean();
    return $w;

}
add_shortcode('ux_instagram_feed', 'ux_instagram_feed');


function flatsome_scrape_instagram( $username ) {

    $username = strtolower( $username );
    $username = str_replace( '@', '', $username );

    if ( false === ( $instagram = get_transient( 'instagram-a5-'.sanitize_title_with_dashes( $username ) ) ) ) {

      $remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );

      if ( is_wp_error( $remote ) )
        return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'flatsome-admin' ) );

      if ( 200 != wp_remote_retrieve_response_code( $remote ) )
        return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'flatsome-admin' ) );

      $shards = explode( 'window._sharedData = ', $remote['body'] );
      $insta_json = explode( ';</script>', $shards[1] );
      $insta_array = json_decode( $insta_json[0], TRUE );

      if ( ! $insta_array )
        return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'flatsome-admin' ) );

      if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
        $images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
      } else {
        return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'flatsome-admin' ) );
      }

      if ( ! is_array( $images ) )
        return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'flatsome-admin' ) );

      $instagram = array();

      foreach ( $images as $image ) {

        $image['thumbnail_src'] = preg_replace( '/^https?\:/i', '', $image['thumbnail_src'] );
        $image['display_src'] = preg_replace( '/^https?\:/i', '', $image['display_src'] );

        // handle both types of CDN url
        if ( ( strpos( $image['thumbnail_src'], 's640x640' ) !== false ) ) {
          $image['thumbnail'] = str_replace( 's640x640', 's160x160', $image['thumbnail_src'] );
          $image['small'] = str_replace( 's640x640', 's320x320', $image['thumbnail_src'] );
        } else {
          $urlparts = wp_parse_url( $image['thumbnail_src'] );
          $pathparts = explode( '/', $urlparts['path'] );
          array_splice( $pathparts, 3, 0, array( 's160x160' ) );
          $image['thumbnail'] = '//' . $urlparts['host'] . implode( '/', $pathparts );
          $pathparts[3] = 's320x320';
          $image['small'] = '//' . $urlparts['host'] . implode( '/', $pathparts );
        }

        $image['large'] = $image['thumbnail_src'];

        if ( $image['is_video'] == true ) {
          $type = 'video';
        } else {
          $type = 'image';
        }

        $caption = __( 'Instagram Image', 'flatsome-admin' );
        if ( ! empty( $image['caption'] ) ) {
          $caption = $image['caption'];
        }

        $instagram[] = array(
          'description'   => $caption,
          'link'        => trailingslashit( '//instagram.com/p/' . $image['code'] ),
          'time'        => $image['date'],
          'comments'      => $image['comments']['count'],
          'likes'     => $image['likes']['count'],
          'thumbnail'   => $image['thumbnail'],
          'small'     => $image['small'],
          'large'     => $image['large'],
          'original'    => $image['display_src'],
          'type'        => $type
        );
      }

      // do not set an empty transient - should help catch private or empty accounts
      if ( ! empty( $instagram ) ) {
        $instagram = base64_encode( serialize( $instagram ) ); //100% safe - ignore theme check nag
        set_transient( 'instagram-a5-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
      }
    }

    if ( ! empty( $instagram ) ) {
      return unserialize( base64_decode( $instagram ) );
    } else {
      return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'flatsome-admin' ) );
    }
 }
