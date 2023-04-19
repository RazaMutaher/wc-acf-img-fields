<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://fiverr.com/iqbalmalik
 * @since      1.0.0
 *
 * @package    Wc_Acf_Img_Fields
 * @subpackage Wc_Acf_Img_Fields/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wc_Acf_Img_Fields
 * @subpackage Wc_Acf_Img_Fields/includes
 * @author     Iqbal <dev.miqbal@gmail.com>
 */
class Wc_Acf_Img_Fields_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wc-acf-img-fields',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
