<?php

use UxBuilder\Transformers\StringToArray;

class StringToArrayTest extends WP_UnitTestCase {

  protected $transformer;

  function __construct() {
    add_ux_builder_shortcode( 'button', array() );
    add_ux_builder_shortcode( 'row', array( 'type' => 'container' ) );
    add_ux_builder_shortcode( 'col', array( 'type' => 'container' ) );
    add_ux_builder_shortcode( 'ux_banner', array( 'type' => 'container' ) );
    add_ux_builder_shortcode( 'text_box', array( 'type' => 'container' ) );
    add_ux_builder_shortcode( 'text', array( 'type' => 'container', 'compile' => false ) );
  }

  function test_transform_text_shortcode() {
    $array = ux_builder( 'to-array' )->transform( 'Some text' );
    $this->assertTrue( is_array( $array ), 'Text should be transformed to an array.' );
    $this->assertEquals( $array[0]['content'], '<p>Some text</p>', 'Text content is wrong.' );
  }

  function test_transform_string_to_array() {
    $array = ux_builder( 'to-array' )->transform('
    [button text="Button"]
    [row type="full-width"]
    [col]
    Text in column
    [/col]
    [/row]
    Text on root
    ');

    $this->assertCount( 3, $array, 'The array should contain 3 shortcode arrays.' );
    $this->assertTrue( is_array( $array ), 'StringToArray::transform() should return an array.' );
    $this->assertEquals( 'Button', $array[0]['options']['text'], 'Button should have «Button» as text attribute.' );
    $this->assertEquals( '<p>Text on root</p>', $array[2]['content'], 'Text shortcode gets wrong content.' );

    ux_builder_content_array_walk( $array, function( $item ) {
      $this->assertArrayHasKey( 'tag', $item, 'Shortcode array should have a «tag» key.' );
      $this->assertArrayHasKey( 'options', $item, 'Shortcode array should have an «options» key.' );
      $this->assertArrayHasKey( 'meta', $item, 'Shortcode array should have a «meta» key.' );
    } );
  }

  function test_transform_nested_tags() {
    $array = ux_builder( 'to-array' )->transform( '
      [row]
        [col]
          [row_inner]
            [col_inner]
              [row_inner_1]
                [col_inner_1][/col_inner_1]
              [/row_inner_1]
            [/col_inner]
          [/row_inner]
        [/col]
      [/row]
    ' );

    $row = $array[0];
    $col = $row['children'][0];
    $row_inner = $col['children'][0];
    $col_inner = $row_inner['children'][0];
    $row_inner_1 = $col_inner['children'][0];
    $col_inner_1 = $row_inner_1['children'][0];
    $message = 'Nested tags transfomed incorrectly';

    $this->assertEquals( 'row', $row['tag'], $message );
    $this->assertEquals( 'row', $row_inner['tag'], $message );
    $this->assertEquals( 'row', $row_inner_1['tag'], $message );
    $this->assertEquals( 'col', $col['tag'], $message );
    $this->assertEquals( 'col', $col_inner['tag'], $message );
    $this->assertEquals( 'col', $col_inner_1['tag'], $message );
  }

  function test_span_option_should_be_number() {
    $array = ux_builder( 'to-array' )->transform( '[col span="1/2"][/col]' );
    $this->assertEquals( 6, $array[0]['options']['span'], 'Old span values should be converted to numbers.' );
  }

  function test_ux_banner_should_have_text_box() {
    $array = ux_builder( 'to-array' )->transform( '[ux_banner]Content[/ux_banner]' );
    $this->assertEquals( 'text_box', $array[0]['children'][0]['tag'], 'Banner content should be wrapped in text_box' );
  }
}
