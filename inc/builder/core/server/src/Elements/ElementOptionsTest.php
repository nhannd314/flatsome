<?php

use UxBuilder\Elements\ElementOptions;

/**
 * Sample test case.
 */
class ElementOptionsTest extends WP_UnitTestCase {

  function test_parse_string_with_names() {
    $options = new ElementOptions( array(
      'option_group' => array(
        'type' => 'group',
        'heading' => __( 'Layout' ),
        'options' => array(
          'option_one' => array(
            'type' => 'textfield',
            'responsive' => true,
          ),
          'option_two' => array(
            'type' => 'textfield',
            'responsive' => true,
            'default' => '50px md:25px sm:10px'
          ),
        ),
      ),
      'option_three' => array(
        'type' => 'textfield',
        'default' => '100%'
      ),
      ) );

      $values = $options->camelcase()->get_values();

      $this->assertCount( 4, $values );
      $this->assertEquals( '', $values['optionOne'] );
      $this->assertEquals( '50px', $values['optionTwo'] );
      $this->assertEquals( '100%', $values['optionThree'] );
      $this->assertArrayHasKey( '$responsive', $values );
      $this->assertCount( 2, $values['$responsive'] );
      $this->assertCount( 3, $values['$responsive']['optionOne'] );
      $this->assertCount( 3, $values['$responsive']['optionTwo'] );
      $this->assertEquals( '10px', $values['$responsive']['optionTwo'][0] );
      $this->assertEquals( '25px', $values['$responsive']['optionTwo'][1] );
      $this->assertEquals( '50px', $values['$responsive']['optionTwo'][2] );
    }
  }
