<?php

namespace UxBuilder;

use UxBuilder\Ajax\AjaxManager;
use UxBuilder\Services\Container;

class Application {

  protected static $instance;

  public $version;
  protected $container;
  protected $ajax;

  public function __construct() {
    $this->container = new Container();
    $this->ajax = new AjaxManager();

    $this->create_services();
    $this->register_factories();

    if ( ux_builder_is_editor() ) require_once ux_builder_path( '/server/actions/editor.php' );
    if ( ux_builder_is_iframe() ) require_once ux_builder_path( '/server/actions/iframe.php' );

    add_action( 'init', array( $this, 'initialize' ) );
  }

  protected function create_services() {
    $self = $this;

    $this->container->service( 'app', function( $container ) use ( $self ) {
      return $self;
    } );

    $this->container->service( 'templates', function( $container ) {
      return $container->create( 'UxBuilder\Collections\Templates' );
    } );

    $this->container->service( 'components', function( $container ) {
      return $container->create( 'UxBuilder\Collections\Components' );
    } );

    $this->container->service( 'elements', function( $container ) {
      return $container->create( 'UxBuilder\Collections\Elements' );
    } );
  }

  protected function register_factories() {
    $this->container->factory( 'to-array', function( $container ) {
      return $container->create( 'UxBuilder\Transformers\StringToArray' );
    } );

    $this->container->factory( 'to-string', function( $container ) {
      return $container->create( 'UxBuilder\Transformers\ArrayToString' );
    } );
  }

  /**
  * Initializes the editor.
  */
  public function initialize() {
    do_action( 'ux_builder_setup' );

    if ( ! ux_builder_is_editor() ) return;

    $this->container->service( 'current-post', function( $container ) {
      return $container->create( 'UxBuilder\Post\Post', array(
        'post' => get_post( $_GET['post_id'] ),
      ) );
    } );

    $this->container->service( 'editing-post', function( $container ) {
      return $container->create( 'UxBuilder\Post\Post', array(
        'post' => get_post( isset( $_GET['edit_post_id'] ) ? $_GET['edit_post_id'] : $_GET['post_id'] ),
      ) );
    } );

    // Stop here if user cannot edit post.
    if ( ! current_user_can( 'edit_post', $this->container->resolve( 'editing-post' )->post()->ID )) {
      wp_die( __( 'Sorry, you are not allowed to edit this item.', 'wordpress' ) );
    }

    do_action( 'ux_builder_init' );
  }

  /**
  * Get a service from the container.
  *
  * @param  string $name
  * @return *
  */
  public function resolve( $name = 'app' ) {
    return $this->container->resolve( $name );
  }

  /**
  * Get the instance of this class.
  *
  * @return Application
  */
  public static function get_instance() {
    if ( ! self::$instance ) {
      self::$instance = new self();
    }
    return self::$instance;
  }
}
