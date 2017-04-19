<?php

use UxBuilder\Transformers\StringToArray;
use UxBuilder\Transformers\ArrayToString;

class ArrayToStringTest extends WP_UnitTestCase {

	function test_tags() {
		$array = ux_builder( 'to-array' )->transform( '[button _id="5-2" text="A button"]' );
		$string = ux_builder( 'to-string' )->transform( $array );
	}

	function test_text_tag_content() {
		$array = ux_builder( 'to-array' )->transform( '<p>Some text</p>' );
		$string = ux_builder( 'to-string' )->transform( $array );
		$this->assertEquals( '<p>Some text</p>', trim( $string ) );
	}

	function test_nested_tags() {
		$string = ux_builder( 'to-string' )->transform( array(
			array( 'tag' => 'row', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'col', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'row', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'col', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'row', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'col', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'row', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'col', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'row', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'col', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'row', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'col', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'row', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'col', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'row', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'col', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'row', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'col', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'row', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'col', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'row', 'meta' => array(), 'options' => array(), 'children' => array(
			array( 'tag' => 'col', 'meta' => array(), 'options' => array(), 'children' => array(
			) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) ) )
		) );

		$rows = $this->contains_strings( array(
			'row', 'row_inner',
			'row_inner_1', 'row_inner_2', 'row_inner_3',
			'row_inner_4', 'row_inner_5', 'row_inner_6',
			'row_inner_7', 'row_inner_8', 'row_inner_9',
		), $string );

		$cols = $this->contains_strings( array(
			'col', 'col_inner',
			'col_inner_1', 'col_inner_2', 'col_inner_3',
			'col_inner_4', 'col_inner_5', 'col_inner_6',
			'col_inner_7', 'col_inner_8', 'col_inner_9',
		), $string );

		$this->assertTrue( $rows, 'Nested «row» tag names was set wrong.' );
		$this->assertTrue( $cols, 'Nested «col» tag names was set wrong.' );
	}

	function contains_strings( $words, $str ) {
    if ( ! is_string( $str ) ) return false;
    return count( array_intersect(
			array_map( 'strtolower',$words ),
			preg_split( '/[^a-z0-9\-\_]/', strtolower( $str ) )
    ) ) == count( $words );
	}
}
