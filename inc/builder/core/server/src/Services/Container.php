<?php

namespace UxBuilder\Services;

use ReflectionClass;

class Container {

  protected $values = array();

  /**
   * Register a new service.
   *
   * @param  string   $name
   * @param  callable $callable
   */
  public function service( $name, $value ) {
    $this->values[$name] = $value( $this );
  }

  /**
   * Register a new factory.
   *
   * @param  string   $name
   * @param  callable $callable
   */
  public function factory( $name, $callable ) {
    $this->values[$name] = $callable;
  }

  /**
   * Gets a service or factory by name.
   *
   * @param  string $name
   * @return *
   */
  public function resolve( $name ) {
    if( empty( $this->values[$name] ) ) {
      return $this->resolve_class_name( $name );
    }

    if( is_callable( $this->values[$name] ) ) {
      return $this->values[$name]( $this );
    }

    return $this->values[$name];
  }

  /**
   * Resolves a service or facory be class name.
   *
   * @param  string $class_name
   * @return *
   */
  protected function resolve_class_name( $class_name ) {
    $matched = array_filter( $this->values, function( $value ) use( $class_name )  {
      return get_class( $value ) === $class_name;
    });

    return reset( $matched );
  }

  /**
   * Creates a new instance of a class, the given arguments are passed to the
   * class constructor. The class will be created with automatic dependency
   * injection if no arguments are passed.
   *
   * @param  string $class_name
   * @param  array  $arguments
   * @return *
   */
  public function create( $class_name, $arguments = array() ) {
    $reflection = new ReflectionClass( $class_name );

    if ( ! empty( $arguments ) ) {
      return $reflection->newInstanceArgs( $arguments );
    }

    if ( $reflection->hasMethod( '__construct' ) ) {
      return $this->create_with_contructor( $reflection );
    }

    return $reflection->newInstance();
  }

  /**
   * Creates a new instance of a class with automatic dependency injection.
   *
   * @param  ReflectionClass $reflection
   * @return *
   */
  protected function create_with_contructor( ReflectionClass $reflection ) {
    $constructor = $reflection->getMethod( '__construct' );
    $parameters = $constructor->getParameters();

    $args = array();

    foreach ( $parameters as $param ) {
      $value = null;

      if( $class = $param->getClass() ) {
        $value = $this->resolve( $class->name ) ?: $this->create( $class->name );
      }

      if( ! $value && $param->isOptional() ) {
        $value = $param->getDefaultValue();
      }

      $args[] = $value;
    }

    return $reflection->newInstanceArgs( $args );
  }
}
