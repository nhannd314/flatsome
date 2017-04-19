<?php
// [map]
function flatsome_shortcode_map($atts, $content=null, $code) {

	$atts = shortcode_atts(array(
    '_id' => 'map-'.rand(),
		'lat'  => '40.79028',
    'long' => '-73.95972',
    'height' => '400px',
		'color' => '#58728a',
    'margin' => '',
    'position_x' => '95',
    'position_x__sm' => '',
    'position_x__md' => '',
    'position_y' => '95',
    'position_y__sm' => '',
    'position_y__md' => '',
    'content_enable' => 'true',
    'content_bg' => '#fff',
    'content_width' => '30',
    'content_width__sm' => '',
    'content_width__md' => '',
    'saturation' => '-30',
    'zoom' => '17',
    'controls' => 'false',
    'zoom_control' => 'true',
    'street_view_control' => 'true',
    'map_type_control' => 'true',
    'pan' => 'true',
	), $atts);

  extract( $atts );

  $content_classes = array( 'map_inner', 'map-inner', 'last-reset absolute' );
  $content_classes[] = flatsome_position_classes( 'x', $position_x, $position_x__sm, $position_x__md );
  $content_classes[] = flatsome_position_classes( 'y', $position_y, $position_y__sm, $position_y__md );

  wp_enqueue_script('flatsome-maps');

	ob_start();
	?>

	<script type="text/javascript">
  jQuery( document ).ready(function() {
    function initialize() {
        var styles = {
            'flatsome':  [{
            "featureType": "administrative",
            "stylers": [
              { "visibility": "on" }
            ]
          },
          {
            "featureType": "road",
            "stylers": [
              { "visibility": "on" },
              { "hue": "<?php echo $color ?>" }
            ]
          },
          {
            "stylers": [
			  { "visibility": "on" },
			  { "hue": "<?php echo $color ?>" },
			  { "saturation": <?php echo $saturation; ?> }
            ]
          }
        ]};

        var myLatlng = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $long ?>);
        var myOptions = {
            zoom: <?php echo $zoom ?>,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            mapTypeId: 'flatsome',
            draggable: <?php echo $pan; ?>,
            zoomControl: <?php echo $controls == 'true' && $zoom_control == 'true' ? 'true' : 'false'; ?>,
            zoomControlOptions: {
              position: google.maps.ControlPosition.TOP_LEFT
            },
      			// panControl: <?php echo $controls; ?>,
            // panControlOptions: {
            //   position: google.maps.ControlPosition.TOP_LEFT
            // },
      			mapTypeControl: <?php echo $controls == 'true' && $map_type_control == 'true' ? 'true' : 'false'; ?>,
            mapTypeControlOptions: {
              position: google.maps.ControlPosition.TOP_LEFT
            },
      			// scaleControl: <?php echo $controls; ?>,
            // scaleControlOptions: {
            //   position: google.maps.ControlPosition.TOP_LEFT
            // },
      			streetViewControl: <?php echo $controls == 'true' && $street_view_control == 'true' ? 'true' : 'false'; ?>,
            streetViewControlOptions: {
              position: google.maps.ControlPosition.TOP_LEFT
            },
      			// overviewMapControl: <?php echo $controls; ?>,
            // overviewMapControlOptions: {
            //   position: google.maps.ControlPosition.TOP_LEFT
            // },
            scrollwheel: false,
            disableDoubleClickZoom: true
        }
        var map = new google.maps.Map(document.getElementById("<?php echo $_id; ?>-inner"), myOptions);
        var styledMapType = new google.maps.StyledMapType(styles['flatsome'], {name: 'flatsome'});
        map.mapTypes.set('flatsome', styledMapType);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title:""
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
    google.maps.event.addDomListener(window, 'resize', initialize);
    });
    </script>

    <div class="google-map relative mb" id="<?php echo $_id; ?>">
        <div class="map-height" id="<?php echo $_id; ?>-inner"></div>
        <div id="map_overlay_top"></div>
        <div id="map_overlay_bottom"></div>
         <?php if($content_enable) {?>
         <div class="<?php echo implode( ' ', $content_classes ); ?>">
              <?php echo flatsome_contentfix($content); ?>
         </div>
       <?php }?>

       <?php
        // Get custom CSS
        $args = array(
            'content_bg' => array(
              'selector' => '.map-inner',
              'property' => 'background-color',
            ),
            'content_width' => array(
              'selector' => '.map-inner',
              'property' => 'max-width',
              'unit' => '%'
            ),
            'height' => array(
              'selector' => '.map-height',
              'property' => 'height',
            )
          );
          echo ux_builder_element_style_tag($_id, $args, $atts);
        ?>
    </div><!-- .map -->

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode('map', 'flatsome_shortcode_map');
