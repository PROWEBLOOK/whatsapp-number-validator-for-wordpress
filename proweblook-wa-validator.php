<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * The Proweblook wa validator start file. Here we do initialize the plugin.
 *
 * Plugin Name: Proweblook WA Validator
 * Plugin URI: https://proweblook.com/whatsapp-number-checker
 * Description: WA number validation plugin. Works with Contact Form 7, Gravity Forms, WPForms, Ninja Forms and WooCommerce. For other 3rd party forms: add class='prowa-phone' to all input fields you want to validate.
 * Version: 1.5
 * License: GPL2
 * Author: Proweblook
 * Author URI: https://proweblook.com/
 * Text Domain: proweblook-wa-validator
 * Domain Path: /languages
 *
 * @package Plugins
 **/

require_once(dirname(__FILE__) . '/src/functions.php');
require_once(dirname(__FILE__) . '/src/class-prow-plugin.php');
add_action('after_setup_theme', 'PROW_load', 11);

$plugin_data = get_file_data(__FILE__, array('Version' => 'Version'), false);
$plugin_version = $plugin_data['Version'];

define('PROW_PLUGIN_CURRENT_VERSION', $plugin_version);

/**
 * Initialize the plugin
 *
 * @return void
 */
function PROW_load()
{

	$plugin = PROW_Plugin::get_instance();
	$plugin->plugin_setup();
}
