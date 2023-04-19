<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://fiverr.com/iqbalmalik
 * @since             1.0.0
 * @package           Wc_Acf_Img_Fields
 *
 * @wordpress-plugin
 * Plugin Name:       WC ACF Image Fields
 * Plugin URI:        https://copyecom.ai
 * Description:       This plugin is a tool to sync woocommerce product gallery images to ACF Fields.
 * Version:           1.0.0
 * Author:            Iqbal
 * Author URI:        https://fiverr.com/iqbalmalik
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-acf-img-fields
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WC_ACF_IMG_FIELDS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-acf-img-fields-activator.php
 */
function activate_wc_acf_img_fields() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-acf-img-fields-activator.php';
	Wc_Acf_Img_Fields_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-acf-img-fields-deactivator.php
 */
function deactivate_wc_acf_img_fields() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-acf-img-fields-deactivator.php';
	Wc_Acf_Img_Fields_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_acf_img_fields' );
register_deactivation_hook( __FILE__, 'deactivate_wc_acf_img_fields' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-acf-img-fields.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_acf_img_fields() {

	$plugin = new Wc_Acf_Img_Fields();
	$plugin->run();

}
run_wc_acf_img_fields();
