<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       muzammildev.com
 * @since      1.0.0
 *
 * @package    Travel_Booking
 * @subpackage Travel_Booking/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Travel_Booking
 * @subpackage Travel_Booking/includes
 * @author     Muzammil <raja_muzammil95@hotmail.com>
 */
class Travel_Booking_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'travel-booking',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}


	public function start_the_session() {
	    if ( ! session_id() ) {
	        session_start();    
	    }
	}



}
