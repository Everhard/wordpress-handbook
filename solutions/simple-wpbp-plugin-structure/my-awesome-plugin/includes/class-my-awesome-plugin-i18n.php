<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://dorokhov.dev
 * @since      1.0.0
 *
 * @package    My_Awesome_Plugin
 * @subpackage My_Awesome_Plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    My_Awesome_Plugin
 * @subpackage My_Awesome_Plugin/includes
 * @author     Andrew Dorokhov <andrew@dorokhov.dev>
 */
class My_Awesome_Plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'my-awesome-plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
