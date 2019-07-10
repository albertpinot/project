<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       Edartois
 * @since      1.0.0
 *
 * @package    Edartois
 * @subpackage Edartois/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Edartois
 * @subpackage Edartois/public
 * @author     Albert Pinot <albert_pinot@outlook.fr>
 */
class Edartois_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_shortcode('afficheLivre', array($this,'affichagelivre'));
		add_shortcode('afficheDonnee', array($this,'affichagedonnee'));
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Edartois_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Edartois_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/edartois-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Edartois_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Edartois_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/edartois-public.js', array( 'jquery' ), $this->version, false );

	}
	
	public function affichagelivre($param, $content) {
		global $wpdb;
		$query= "SELECT * FROM ".$wpdb->prefix."livre";
		$resultats = $wpdb->get_results($query);
		$text="<table><tr>
				<th> titre </th>
				<th> auteur </th>
				<th> collection </th>
				<th> sortie </th>
				<th> stock </th>
			</tr>";
		foreach($resultats as $rep){
			
			$text.='<td>'.$rep->titre.'</td>';
			$text.='<td>'.$rep->auteur.'</td>';
			$text.='<td>'.$rep->collection.'</td>';
			$text.='<td>'.$rep->sortie.'</td>';
			$text.='<td>'.$rep->stock.'</td>';
			$text.='</tr>';	
		}
		$text.='</table>';
		return $text;
	}
	public function affichagedonnee($param, $content) {
		global $wpdb;
		$query= "SELECT titre,auteur, DATE_FORMAT(sortie, '%d-%m-%Y') as datefr, stock, collection FROM ".$wpdb->prefix."livre WHERE stock>0";
	
		$resultats = $wpdb->get_results($query);
		$text="";
		foreach($resultats as $rep){
			$text.='<table>';
			$text.='<tr>';
			$text.='<td>'.$rep->titre.'</td>';
			$text.='<td>'.$rep->auteur.'</td>';
			$text.='<td>'.$rep->collection.'</td>';
			$text.='<td>'.$rep->datefr.'</td>';
			$text.='<td>'.$rep->stock.'</td>';
			$text.='</tr>';
			$text.='</table>';
		}
		return $text;
	}
}