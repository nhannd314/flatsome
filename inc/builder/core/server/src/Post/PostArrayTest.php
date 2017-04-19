<?php

use UxBuilder\Post\PostArray;

class PostArrayTest extends WP_UnitTestCase {

	function __construct() {
		add_ux_builder_shortcode( 'row', array() );
		add_ux_builder_shortcode( 'col', array() );
		add_ux_builder_shortcode( 'button', array() );
		add_ux_builder_shortcode( 'text', array( 'compile' => false ) );
	}

	function test_post_to_array() {
		$post_id = self::factory()->post->create( array(
			'post_type' => 'page',
			'post_content' => '
				Some text in paragraphs
				[button text="Label"]
				[row]
					[col _id="3-2" span="6 sm:12"]
						Some text in a column
					[/col]
					[col  span="6 sm:12"]
						[button text="Button in a column"]
					[/col]
				[/row]
				More text
			',
		) );

		$post_array = new PostArray( get_post( $post_id ) );
		$array = $post_array->get_array();
		$used_ids = array();

		$this->assertTrue( is_array( $array ), 'PostConverter::to_array() should return an array' );

		// Ensure root element is of type _root.
		$this->assertEquals( '_root', $array['tag'], 'Root element should be _root' );
		$this->assertNotEmpty( $array['children'], 'The post array should not be empty.' );

		// Walk through all elements in post content.
		ux_builder_content_array_walk( $array['children'], function( $item ) use ( $post_id ) {
			$this->assertArrayHasKey( 'meta', $item, 'Element should have a metaData object.' );
		} );
	}

	function test_make_sure_ids_are_generated_correctly() {
		$post_id = $this->create_page();

		wp_update_post( array(
			'ID' => $post_id,
			'post_content' => '
				[button _id="' . $post_id . '-3" text="Label"]
				[button _id="' . $post_id . '-2" text="Label"]
				[button _id="' . $post_id . '-2" text="Label"]
				[button _id="600-4" text="Label"]
				[button _id="700-4" text="Label"]
				[button _id="' . $post_id . '-4" text="Label"]
				[button _id="800-9" text="Label"]
			'
		) );

		$post_array = new PostArray( get_post( $post_id ) );
		$array = $post_array->get_array();
		$used_ids = array();
		$expected_ids = array(
			"${post_id}-3",
			"${post_id}-2",
			"${post_id}-5",
			"${post_id}-6",
			"${post_id}-7",
			"${post_id}-4",
			"${post_id}-9",
		);

		// Check that next element ID is correct.
		$this->assertEquals( 10, $post_array->get_next_id(), 'Next element ID is not correct.' );

		// Make shure all IDs are unique and valid.
		ux_builder_content_array_walk( $array['children'], function( $item, $key ) use ( $post_id, $expected_ids, &$used_ids ) {
			$this->assertRegExp( "/^${post_id}\-[\d]+$/", $item['$id'], 'Element ID format is wrong.' );
			$this->assertEquals( $item['$id'], $expected_ids[$key], "ID should be {$expected_ids[$key]}." );
			$this->assertTrue( ! in_array( $item['$id'], $used_ids ), "Duplicate ID (${item['$id']}) detected." );
			array_push( $used_ids, $item['$id'] );
		} );
	}

	function test_copy_meta_data_from_other_post() {
		// Create first post.
		$post_1_id = self::factory()->post->create( array( 'post_type' => 'page' ) );

		// Set content with post_id as in on button.
		wp_update_post( array(
			'ID' => $post_1_id,
			'post_content' => "[button _id=\"{$post_1_id}-1\" text=\"Label\"]"
		) );

		// Then create post meta with button attrigutes.
		update_post_meta( $post_1_id, '_ux_builder_data', array(
			'shortcodes' => array(
				"{$post_1_id}-1" => array(
					'options' => array(
						'attribute' => 'from other post',
					),
				),
			) )
		);

		// Create a new post and insert a button with the same id as in first post.
		$post_2_id = self::factory()->post->create( array(
			'post_type' => 'page',
			'post_content' => "[button _id=\"{$post_1_id}-1\" text=\"Label\"]",
		) );

		$array_1 = $this->post_to_array( $post_1_id );
		$array_2 = $this->post_to_array( $post_2_id );

		$this->assertFalse( empty( $array_2['children'][0]['meta'] ) );
		$this->assertTrue( $array_2['children'][0]['meta']['options']['attribute'] == 'from other post', 'Meta data should be copied from previous post.' );
	}

	function test_empty_options_should_have_default_values() {

	}

	function create_page( $content = '' ) {
		return self::factory()->post->create( array(
			'post_type' => 'page',
			'post_content' => $content,
		) );
	}

	function post_to_array( $post_id ) {
		$post_array = new PostArray( get_post( $post_id ) );
		return $post_array->get_array();
	}
}
