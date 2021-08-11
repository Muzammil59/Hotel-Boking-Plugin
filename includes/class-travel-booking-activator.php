<?php

/**
 * Fired during plugin activation
 *
 * @link       muzammildev.com
 * @since      1.0.0
 *
 * @package    Travel_Booking
 * @subpackage Travel_Booking/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Travel_Booking
 * @subpackage Travel_Booking/includes
 * @author     Muzammil <raja_muzammil95@hotmail.com>
 */
class Travel_Booking_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		if ( ! current_user_can( 'activate_plugins' ) ) return;
		  
		global $wpdb;
		  
		if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'sokresultat-paketbokning'", 'ARRAY_A' ) ) 
		{
		     
		    $current_user = wp_get_current_user();
		    
		    // create post object
		    $page = array(
		      'post_title'  => __( 'Sokresultat Paketbokning' ),
		      'post_content' => '[search_results_booking_form]',
		      'post_status' => 'publish',
		      'post_author' => $current_user->ID,
		      'post_type'   => 'page',
		    );

		    
		    // insert the post into the database
		    if( $created_page_id = wp_insert_post( $page ) ){
		    	// Only update this option if 'wp_insert_post()' was successful
			    //save the id in the database
				update_option( 'tbl', $created_page_id ); 
			}
		}


		if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'enda-paketdetalj'", 'ARRAY_A' ) ) 
		{
		     
		    $current_user2 = wp_get_current_user();
		    
		    // create post object
		    $page2 = array(
		      'post_title'  => __( 'Enda Paketdetalj' ),
		      'post_content' => '[booking_detail]',
		      'post_status' => 'publish',
		      'post_author' => $current_user2->ID,
		      'post_type'   => 'page',
		    );
			
		    
		    // insert the post into the database
		    if( $created_page_id2 = wp_insert_post( $page2 ) ){
		    	// Only update this option if 'wp_insert_post()' was successful
			    //save the id2 in the database
				update_option( 'tbsl', $created_page_id2 ); 
			}
		}

		global $wpdb;

		$table_name = $wpdb->prefix . 'hotels';
		
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			id int(11) NOT NULL AUTO_INCREMENT,
			hotelid longtext NOT NULL,
			hotelname longtext NOT NULL,
			hotelurl longtext DEFAULT '' NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

	}

}
