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
		 * Menu item positions.
		 * You can remove unnecessary constants after choosing.
		 */
		const POSITION_DASHBOARD 		= 2;
		const POSITION_FIRST_SEPARATOR 	= 4;
		const POSITION_POSTS 			= 5;
		const POSITION_MEDIA 			= 10;
		const POSITION_LINKS 			= 15;
		const POSITION_PAGES 			= 20;
		const POSITION_COMMENTS 		= 25;
		const POSITION_SECOND_SEPARATOR = 59;
		const POSITION_APPEARANCE 		= 60;
		const POSITION_PLUGINS 			= 65;
		const POSITION_USERS 			= 70;
		const POSITION_TOOLS 			= 75;
		const POSITION_SETTINGS 		= 80;
		const POSITION_THIRD_SEPARATOR 	= 99;

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

				/**
				 * Add a menu item to the admin menu.
				 */
				add_action( 'admin_menu', [ self::class, 'add_admin_menu_item' ] );

				/**
				 * Initialize settings sections and fields.
				 */
				add_action( 'admin_init', [ self::class, 'initialize_settings' ] );

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
            delete_option( 'map_name' );
			delete_option( 'map_age' );
		}

		/**
		 * Add a menu item to the admin menu.
		 */
		public static function add_admin_menu_item() {

			add_menu_page(
				'My Awesome Plugin',
				'My Awesome Plugin',
				'manage_options',
				'my-awesome-plugin',
				[ self::class, 'show_admin_settings_page' ],
				'dashicons-admin-site',
				self::POSITION_PLUGINS
			);
		}

		/**
		 * Show the admin settings page.
		 *
		 * @return void
		 */
		public static function show_admin_settings_page() {

			require_once plugin_dir_path( __FILE__ ) . 'admin/view.php';
		}

		/**
		 * Initialize settings sections and fields.
		 *
		 * @return void
		 */
		public static function initialize_settings() {

			/**
			 * Prefix for "My Awesome Plugin" is "MAP".
			 */
			register_setting( 'my-awesome-plugin', 'map_name' );
			register_setting( 'my-awesome-plugin', 'map_age' );

			add_settings_section(
                'person-info',
                'Person Information',
                [ self::class, 'show_person_section_description' ],
                'my-awesome-plugin'
            );

			add_settings_field(
				'age',
				'Age',
				[ self::class, 'show_age_field' ],
				'my-awesome-plugin',
				'person-info',
				[
					'label_for' => 'age',
				]
			);

			add_settings_field(
                'name',
                'Name',
                [ self::class, 'show_name_field' ],
                'my-awesome-plugin',
                'person-info',
                [
                    'label_for' => 'name',
                    'class'     => 'my-css-class-for-tr',
                ]
            );
		}

		/**
         * Show a description for the Person section.
         *
		 * @param $args
		 * @return void
		 */
		public static function show_person_section_description( $args ) {
			?>
			<p id="<?php echo esc_attr( $args[ 'id' ] ); ?>">
                <?php esc_html_e( 'Please specify person information.', 'my-awesome-plugin' ); ?>
            </p>
			<?php
		}

		/**
         * Show the Age field.
         *
		 * @param $args
		 * @return void
		 */
		public static function show_age_field( $args ) {

            $age = get_option( 'map_age' );
		?>
            <input id="<?= esc_attr( $args['label_for'] ); ?>" type="number" name="map_age" value="<?= esc_attr( $age ) ?>" />

			<p class="description">
				<?php esc_html_e( 'Description of the Age field.', 'my-awesome-plugin' ); ?>
			</p>
		<?php
		}

		/**
         * Show the Name field.
         *
		 * @param $args
		 * @return void
		 */
		public static function show_name_field( $args ) {

			$name = get_option( 'map_name' );
			?>
            <input id="<?= esc_attr( $args['label_for'] ); ?>" type="text" name="map_name" value="<?= esc_attr( $name ) ?>" />

            <p class="description">
				<?php esc_html_e( 'Description of the Name field.', 'my-awesome-plugin' ); ?>
            </p>
			<?php
		}
	}

	My_Awesome_Plugin::init();
}
