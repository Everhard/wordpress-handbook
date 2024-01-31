<?php
/**
* My Awesome Plugin
*
* @package           MyAwesomePlugin
* @author            Andrew Dorokhov
* @copyright         2024 Andrew Dorokhov
* @license           GPL-2.0-or-later
*
* @wordpress-plugin
* Plugin Name:       My Awesome Plugin
* Plugin URI:        https://example.com/plugin-name
* Description:       Description of the plugin.
* Version:           1.0.0
* Requires at least: 5.2
* Requires PHP:      7.2
* Author:            Andrew Dorokhov
* Author URI:        https://dorokhov.dev
* Text Domain:       my-awesome-plugin
* Domain Path:       /languages
* Network:           true
* License:           GPL v2 or later
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Update URI:        https://example.com/my-plugin/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'My_Awesome_Plugin' ) ) {

	/**
	 * My Awesome Plugin class.
	 */
	class My_Awesome_Plugin {
		/**
		 * Current version of the plugin.
		 * It must match the plugin header comment.
		 */
		const VERSION = '1.0.0';

		/**
		 * Plugin initialization.
		 * All hooks (actions and filters) are added here.
		 *
		 * @return void
		 */
		public static function init() {
			/**
			 * Backend.
			 */
			if ( is_admin() ) {
				/**
				 * Activate the plugin.
				 */
				register_activation_hook( __FILE__, [ self::class, 'activate' ] );

				/**
				 * Deactivate the plugin.
				 */
				register_deactivation_hook( __FILE__, [ self::class, 'deactivate' ] );

				/**
				 * Uninstall the plugin.
				 */
				register_uninstall_hook( __FILE__, [ self::class, 'uninstall' ] );

			} else {
				/**
				 * Frontend.
				 */
				// Your code is here.
			}
		}

		/**
		 * Activate the plugin.
		 *
		 * @return void
		 */
		public static function activate() {
			// Your code is here.
		}

		/**
		 * Deactivate the plugin.
		 *
		 * @return void
		 */
		public static function deactivate() {
			// Your code is here.
		}

		/**
		 * Uninstall the plugin.
		 *
		 * @return void
		 */
		public static function uninstall() {
			// Your code is here.
		}
	}

	My_Awesome_Plugin::init();
}
