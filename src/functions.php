<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * In this file you find functions
 *
 * @package prow
 */

/**
 * Use this function in your plugin or theme to activate frontend Ajax API requests.
 * An input field with the class .prowa-phone will be validated before the form gets send.
 */
function PROW_activate_third_party() {

	// The ajax request endpoint is public now.
	add_filter( 'PROW_api_is_private', '__return_false' );
	add_action( 'wp_enqueue_scripts', array( PROW_Plugin::get_instance(), 'enqueue_frontend' ), 11 );
	add_action( 'wp_footer', array( PROW_Plugin::get_instance(), 'footer_styles' ) );
}
