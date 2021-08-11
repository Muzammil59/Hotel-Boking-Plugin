<?php

/**
 * Fired during plugin deactivation
 *
 * @link       muzammildev.com
 * @since      1.0.0
 *
 * @package    Travel_Booking
 * @subpackage Travel_Booking/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Travel_Booking
 * @subpackage Travel_Booking/includes
 * @author     Muzammil <raja_muzammil95@hotmail.com>
 */
class Travel_Booking_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$the_page_ids = array(intval( get_option( 'tbl' ) ), intval( get_option( 'tbsl' ) )) ;
		foreach($the_page_ids as $the_page_id) {
		    wp_delete_post( $the_page_id, true ); // this will trash, not delete
		}

		global $wpdb;
		$wpdb->query( "DROP TABLE IF EXISTS wp_hotels" );
	}

}
