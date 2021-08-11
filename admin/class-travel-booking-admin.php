<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       muzammildev.com
 * @since      1.0.0
 *
 * @package    Travel_Booking
 * @subpackage Travel_Booking/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Travel_Booking
 * @subpackage Travel_Booking/admin
 * @author     Muzammil <raja_muzammil95@hotmail.com>
 */
class Travel_Booking_Admin {

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
		 * defined in Travel_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Travel_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . '../public/css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/travel-booking-admin.css', array(), $this->version, 'all' );
		

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
		 * defined in Travel_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Travel_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name.'-bootstrap-min', plugin_dir_url( __FILE__ ) . '../public/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/travel-booking-admin.js', array( 'jquery' ), $this->version, false );

	}

			/**
		* Add an options page under the Settings submenu
		*
		* @since 1.0.0
		*/
		public function travel_booking_options() {

			$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Travel Booking Settings', 'travel-booking' ),
			__( 'Travel Booking Settings', 'travel-booking' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
			);
			
			}
			
			
			/**
			* Render the options page for plugin
			* Call back function
			* @since 1.0.0
			*/
			public function display_options_page() {
			include_once 'partials/travel-booking-admin-display.php';
			}

}
