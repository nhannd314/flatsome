<?php

/**
 * Editor mode.
 *
 * @return  tring
 */
function ux_builder_mode() {
  return 'frontend';
}

/**
 * Is the builder active?
 *
 * @return  boolean
 */
function ux_builder_is_active() {
  return (
    ux_builder_is_iframe() ||
    ux_builder_is_editor() ||
    ux_builder_is_doing_shortcode() ||
    ux_builder_is_doing_GET_ajax() ||
    ux_builder_is_doing_POST_ajax() ||
    ux_builder_is_saving()
  ) && is_user_logged_in();
}

/**
 * Is this the editor?
 *
 * @return  boolean
 */
function ux_builder_is_editor() {
  return array_key_exists( 'page', $_GET ) && $_GET['page'] == 'uxbuilder';
}

/**
 * Is this the iframe?
 *
 * @return  boolean
 */
function ux_builder_is_iframe() {
  return array_key_exists( 'uxb_iframe', $_GET );
}

/**
 * The editor is rendering a shortcode template.
 *
 * @return  boolean
 */
function ux_builder_is_doing_shortcode() {
  return array_key_exists( 'ux_builder_action', $_POST ) &&
    $_POST['ux_builder_action'] == 'do_shortcode';
}

/**
 * The editor is doing some ajax stuff.
 *
 * @return  boolean
 */
function ux_builder_is_doing_GET_ajax() {
  return array_key_exists( 'action', $_GET ) &&
    strpos( $_GET['action'], 'ux_builder' ) !== false;
}

/**
 * The editor is doing some ajax stuff.
 *
 * @return  boolean
 */
function ux_builder_is_doing_POST_ajax() {
  return array_key_exists( 'action', $_POST ) &&
    strpos( $_POST['action'], 'ux_builder' ) !== false;
}

/**
 * The editor is saving.
 *
 * @return  boolean
 */
function ux_builder_is_saving() {
  return array_key_exists( 'action', $_POST ) &&
    $_POST['action'] == 'ux_builder_save';
}
