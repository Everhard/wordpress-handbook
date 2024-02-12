<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://dorokhov.dev
 * @since      1.0.0
 *
 * @package    My_Awesome_Plugin
 * @subpackage My_Awesome_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    My_Awesome_Plugin
 * @subpackage My_Awesome_Plugin/admin
 * @author     Andrew Dorokhov <andrew@dorokhov.dev>
 */
class My_Awesome_Plugin_Admin {

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
	const POSITION_THIRD_SEPARATOR	= 99;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Awesome_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Awesome_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/my-awesome-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Awesome_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Awesome_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/my-awesome-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add the admin menu item.
	 *
	 * @since    1.0.0
	 * @return void
	 */
	public function add_admin_menu_item() {

		add_menu_page(
			'My Awesome Plugin',
			'My Awesome Plugin',
			'manage_options',
			'my-awesome-plugin',
			[ $this, 'show_admin_settings_page' ],
			'dashicons-admin-site',
			self::POSITION_PLUGINS
		);
	}

	/**
	 * Show the admin settings page.
	 *
	 * @since    1.0.0
	 * @return void
	 */
	public function show_admin_settings_page() {

		require_once plugin_dir_path( __FILE__ ) . 'partials/my-awesome-plugin-admin-display.php';
	}

	/**
	 * Initialize settings sections and fields.
	 *
	 * @since    1.0.0
	 * @return void
	 */
	public function initialize_settings() {
		/**
		 * Prefix for "My Awesome Plugin" is "MAP".
		 */
		register_setting( 'my-awesome-plugin', 'map_name' );
		register_setting( 'my-awesome-plugin', 'map_age' );

		add_settings_section(
			'person-info',
			'Person Information',
			[ $this, 'show_person_section_description' ],
			'my-awesome-plugin'
		);

		add_settings_field(
			'age',
			'Age',
			[ $this, 'show_age_field' ],
			'my-awesome-plugin',
			'person-info',
			[
				'label_for' => 'age',
			]
		);

		add_settings_field(
			'name',
			'Name',
			[ $this, 'show_name_field' ],
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
	 * @since    1.0.0
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
	 * @since    1.0.0
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
	 * @since    1.0.0
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
