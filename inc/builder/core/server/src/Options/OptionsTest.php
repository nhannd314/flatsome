<?php

use UxBuilder\Options\Options;

class OptionsTest extends WP_UnitTestCase {

	function test_option_types() {
		$options = new Options( array(
			'option_1' => array( 'type' => 'textfield' ),
			'option_2' => array( 'type' => 'image' ),
			'option_3' => array( 'type' => 'select' ),
		) );

		$option_instances = $options->get_options();
		$this->assertInstanceOf( 'UxBuilder\Options\Option', $option_instances['option_1'] );
		$this->assertInstanceOf( 'UxBuilder\Options\Custom\ImageOption', $option_instances['option_2'] );
		$this->assertInstanceOf( 'UxBuilder\Options\Custom\SelectOption', $option_instances['option_3'] );
	}

	function test_setting_values() {
		$options = ( new Options( array(
			'option_1' => array( 'type' => 'textfield' ),
			'option_2' => array( 'type' => 'image' ),
			'option_3' => array( 'type' => 'select' ),
		) ) )->set_values( array(
			'option_1' => 'new value'
		) );

		$this->assertEquals( 'new value', $options->get_values()['option_1'] );
	}

	function test_default_value() {
		$values = ( new Options( array(
			'option_1' => array( 'type' => 'textfield', 'default' => 'default value' )
		) ) )->get_values();

		$this->assertEquals( 'default value', $values['option_1'] );
	}

	function test_groups() {
		$options = ( new Options( array(
			'grp_styles' => array(
				'type' => 'group',
				'options' => array(
					'option_1' => array( 'type' => 'textfield' ),
					'sub_group' => array(
						'type' => 'group',
						'options' => array(
							'option_2' => array( 'type' => 'textfield' ),
						),
					),
				),
			),
		) ) )->set_values( array(
			'option_1' => 'option 1 value',
			'option_2' => 'option 2 value',
		) );

		$values = $options->get_values();

		$this->assertEquals( 'option 1 value', $values['option_1'] );
		$this->assertEquals( 'option 2 value', $values['option_2'] );
	}

	function test_camelcasing() {
		$options = new Options( array(
			'option_one' => array( 'type' => 'textfield' )
		) );

		$values = $options->camelcase()->set_values( array(
			'option_one' => 'option 1 value',
		) )->get_values();

		$this->assertArrayHasKey( 'optionOne', $values, 'Option names was not camel cased.' );
		$this->assertEquals( 'option 1 value', $values['optionOne'], 'Option get wrong value.' );
	}

	function test_flatteing() {
		$options = new Options( array(
			'grp_styles' => array(
				'type' => 'group',
				'options' => array(
					'option_1' => array( 'type' => 'textfield' ),
					'sub_group' => array(
						'type' => 'group',
						'options' => array(
							'option_2' => array( 'type' => 'textfield' ),
						),
					),
				),
			),
		) );

		$this->assertCount( 2, $options->flatten()->get_options(), 'Options::flatten() returns incorrect options.' );
	}
}
