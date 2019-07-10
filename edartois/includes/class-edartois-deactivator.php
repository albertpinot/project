<?php

/**
 * Fired during plugin deactivation
 *
 * @link       Edartois
 * @since      1.0.0
 *
 * @package    Edartois
 * @subpackage Edartois/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Edartois
 * @subpackage Edartois/includes
 * @author     Albert Pinot <albert_pinot@outlook.fr>
 */
class Edartois_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
		$query= "DROP TABLE IF EXISTS ".$wpdb->prefix."livre;";
		$wpdb->query($query); 
	}
}
