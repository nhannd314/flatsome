<?php

/**
 * Sample test case.
 */
class BreakpointTest extends WP_UnitTestCase {

	function test_parse_string_with_names() {
		$parsed = ux_builder_parse_value( '40 sm:20 md:30' );
		$this->assertCount( 4, $parsed, 'Parsed value should return 4 values.' );
		$this->assertEquals( '40', $parsed['_default'], 'The default value is incorrect.' );
		$this->assertEquals( '40', $parsed['lg'], 'The «lg» value is incorrect.' );
		$this->assertEquals( '30', $parsed['md'], 'The «md» value is incorrect.' );
		$this->assertEquals( '20', $parsed['sm'], 'The «sm» value is incorrect.' );
	}

	function test_parse_string_and_return_indexes() {
		$parsed = ux_builder_parse_value( '40 sm:20 md:30', true );
		$this->assertCount( 4, $parsed, 'Parsed value should return 4 values.' );
		$this->assertEquals( '40', $parsed['_default'], 'The default value is incorrect.' );
		$this->assertEquals( '40', $parsed[2], 'The «lg» value is incorrect.' );
		$this->assertEquals( '30', $parsed[1], 'The «md» value is incorrect.' );
		$this->assertEquals( '20', $parsed[0], 'The «sm» value is incorrect.' );
	}

	function test_parse_empty_string() {
		$parsed = ux_builder_parse_value( '' );
		$this->assertCount( 4, $parsed, 'Parsed value should return 4 values.' );
		$this->assertEquals( '', $parsed['_default'], 'The default value shuold be empty.' );
		$this->assertEquals( '', $parsed['lg'], 'The «lg» value shuold be empty.' );
		$this->assertEquals( null, $parsed['md'], 'The «md» value should be NULL.' );
		$this->assertEquals( null, $parsed['sm'], 'The «sm» value should be NULL.' );

		$parsed = ux_builder_parse_value( '', true );
		$this->assertCount( 4, $parsed, 'Parsed value should return 4 values.' );
		$this->assertEquals( '', $parsed['_default'], 'The default value shuold be empty.' );
		$this->assertEquals( '', $parsed[2], 'The «lg» value shuold be empty.' );
		$this->assertEquals( null, $parsed[1], 'The «md» value should be NULL.' );
		$this->assertEquals( null, $parsed[0], 'The «sm» value should be NULL.' );
	}

	function test_parse_only_sm_and_default() {
		$parsed = ux_builder_parse_value( '40 sm:20' );
		$this->assertCount( 4, $parsed, 'Parsed value should return 4 values.' );
		$this->assertEquals( '40', $parsed['_default'], 'The default value is incorrect.' );
		$this->assertEquals( '40', $parsed['lg'], 'The «lg» value is incorrect.' );
		$this->assertEquals( null, $parsed['md'], 'The «md» value should be NULL.' );
		$this->assertEquals( '20', $parsed['sm'], 'The «sm» value is incorrect.' );
	}

	function test_parse_only_default() {
		$parsed = ux_builder_parse_value( '40' );
		$this->assertCount( 4, $parsed, 'Parsed value should return 4 values.' );
		$this->assertEquals( '40', $parsed['_default'], 'The default value is incorrect.' );
		$this->assertEquals( '40', $parsed['lg'], 'The «lg» value is incorrect.' );
		$this->assertEquals( null, $parsed['md'], 'The «md» value should be NULL.' );
		$this->assertEquals( null, $parsed['sm'], 'The «sm» value should be NULL.' );
	}
}
