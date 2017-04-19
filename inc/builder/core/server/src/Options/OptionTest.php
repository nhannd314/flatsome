<?php

use UxBuilder\Options\Options;
use UxBuilder\Options\Option;

class OptionTest extends WP_UnitTestCase {

	function test_image_option() {
    $filename = ( DIR_TESTDATA . '/images/a2-small.jpg' );
		$contents = file_get_contents( $filename );
		$upload = wp_upload_bits( basename( $filename ), null, $contents );
    $filetype = wp_check_filetype( basename( $filename ) );

    $attachment_id = wp_insert_attachment( array(
      'guid'           => $upload['url'],
      'post_mime_type' => $filetype['type'],
      'post_title'     => basename( $filename ),
      'post_content'   => '',
      'post_status'    => 'inherit'
    ) );

    $metadata = wp_generate_attachment_metadata( $attachment_id, $upload['file'] );
    wp_update_attachment_metadata( $attachment_id, $metadata );

    var_dump(wp_get_attachment_image_src($attachment_id));

    $options = ( new Options( array(
			'option_1' => array( 'type' => 'image' ),
		) ) )->set_values( array(
			'option_1' => $attachment_id
		) );

		// $this->assertEquals( $attach_id, $options->get_values()['option_1'] );;

    var_dump($options->get_values());

    wp_delete_attachment( $attachment_id );
	}
}
