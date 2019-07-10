<?php

/**
 * Fired during plugin activation
 *
 * @link       Edartois
 * @since      1.0.0
 *
 * @package    Edartois
 * @subpackage Edartois/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Edartois
 * @subpackage Edartois/includes
 * @author     Albert Pinot <albert_pinot@outlook.fr>
 */
class Edartois_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$query = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."livre(id int (11) AUTO_INCREMENT PRIMARY KEY, titre char(255), auteur char(255), collection char(255), sortie date , stock int(11));";
		$wpdb->query($query);
	}

}
