<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       Edartois
 * @since      1.0.0
 *
 * @package    Edartois
 * @subpackage Edartois/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Edartois
 * @subpackage Edartois/admin
 * @author     Albert Pinot <albert_pinot@outlook.fr>
 */
class Edartois_Admin {

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
		add_action('admin_menu',array($this,'declareAdmin'));
		add_action('widgets_init',array($this,'declarerWidget'));
	}
	/* Déclaration widget*/
         public function declarerWidget(){
            register_widget('afficheLivreDispo');
        } 
	public static function declareAdmin(){
		add_menu_page('Configuration Edartois', 'Gestionnaire Edartois', 'manage_options', 'Edartois', array($this, 'menuEdartois'));
		add_submenu_page('Edartois','Gestion Edartois','Ajout de livre','manage_options','valider',array($this,'menuAjoutLivre'));
		add_submenu_page('Edartois','Gestion Edartois','Modification de livre','manage_options','modifier',array($this,'menuModifLivre'));
		add_submenu_page('Edartois','Gestion Edartois','Suppression de livre','manage_options','supprimer',array($this,'menuSupprimLivre'));
	}
	public static function menuEdartois(){
		echo '<h1>'.get_admin_page_title().'</h1>';
		echo '<p>Page du plugin gestion Edartois !</p>';
	}
	public static function menuAjoutLivre(){
				global $wpdb;

		echo '<h1>Ajout de livre</h1>';
		echo "<form method='Post' action='#'  >
				<input name='titre' placeholder='Titre du livre' type='text'/> 
				<br/><input name='auteur' placeholder='Non Auteur' type='text'/> 
				<br/><input name='collection' placeholder='Collection du livre' type='text'/> 
				<br/><input name='date' type='date'/> 
				<br/><input name='nombre' placeholder='Nombre de livre' type='number'/>
		 		<br/><input type='submit' name='valider' value='Valider'/>
			</form>";
				$table =$wpdb->prefix.'livre';
				if(isset($_POST['valider'])){
					if($_POST['titre']&&$_POST['auteur']&&$_POST['collection']&&$_POST['date']&&$_POST['nombre']){
						if(is_numeric($_POST['nombre'])){
							$wpdb->insert($table, array('titre'=>stripslashes($_POST['titre']),'auteur'=>stripslashes($_POST['auteur']),'collection'=>stripslashes($_POST['collection']), 'sortie'=>$_POST['date'], 'stock'=>$_POST['nombre']));				
						}
						else{
							echo '<p> Entrer un nombre</p>';
						}	
					}
					else{
						echo '<p style="color:red;">Veuillez completer tout les champs</p>';
					}
				}
	}
	public static function menuModifLivre(){
		echo '<h1>Modification de livre</h1>';
		global $wpdb;
		$table =$wpdb->prefix.'livre';
			if(isset($_POST['modifier'])){
				if(is_numeric($_POST['idmodif'])){
					if($_POST['titre']&&$_POST['auteur']&&$_POST['collection']&&$_POST['date']&&$_POST['nombre']){
						if(is_numeric($_POST['nombre'])){
							$wpdb->update($table, array('titre'=>stripslashes($_POST['titre']),'auteur'=>stripslashes($_POST['auteur']),'collection'=>stripslashes($_POST['collection']), 'sortie'=>$_POST['date'], 'stock'=>$_POST['nombre']));}
					
				}}}
				
		$query= "SELECT * , DATE_FORMAT(sortie, '%d-%m-%Y') as datefr FROM ".$wpdb->prefix."livre";
		$resultats = $wpdb->get_results($query);
		$text="<table style='text-align: center;' id='tableModif' class='display'><thead><tr>
				<th> Id</th>	
				<th> Titre</th>
				<th> Auteur </th>
				<th> Collection </th>
				<th> Sortie </th>
				<th> Stock </th>
				<th> Action</th>
			</tr></thead><tbody>";
		foreach($resultats as $rep){
			$text.='<tr><form method="Post" action="#" >
			<td>'.$rep->id.'</td>';
			$text.='<td ><input style="text-align: center; width:100%;" type="text" name="titre" /><br/>'.$rep->titre.'</td>';
			$text.='<td><input style="text-align: center; width:100%;" type="text" name="auteur" /><br/>'.$rep->auteur.'</td>';
			$text.='<td><input style="text-align: center; width:100%;" type="text" name="collection"  /><br/>'.$rep->collection.'</td>';
			$text.='<td><input style="text-align: center; width:100%;" type="text" name="date" /><br/>'.$rep->datefr.' </td>';
			$text.='<td><input style="text-align: center; width:100%;" type="text" name="nombre" /><br/>'.$rep->stock.'</td>';
			$text.='<td><input type="text" name="idmodif" value='.$rep->id.' style="display:none;" /> 
			<input type="submit" name="modifier" value="Modifier" /></td></form>';
			$text.='</tr>';	
		}
		$text.='</tbody></table>';
		echo $text;
	} 
	public static function menuSupprimLivre(){
		echo '<h1>Suppression de livre</h1>';
		global $wpdb;
		$table =$wpdb->prefix.'livre';
				if(isset($_POST['supprimer'])){
					if(is_numeric($_POST['idsup'])){
						$wpdb->delete($table, array('id'=>$_POST['idsup']));
					}
				}
		$query= "SELECT * , DATE_FORMAT(sortie, '%d-%m-%Y') as datefr FROM ".$wpdb->prefix."livre";
		$resultats = $wpdb->get_results($query);
		$text="<table style='text-align: center;' id='tableSupp' class='display'><thead><tr>
				<th> Id</th>	
				<th> Titre</th>
				<th> Auteur </th>
				<th> Collection </th>
				<th> Sortie </th>
				<th> Stock </th>
				<th> Action</th>
			</tr></thead><tbody>";
		foreach($resultats as $rep){
			$text.='<td>'.$rep->id.'</td>';
			$text.='<td>'.$rep->titre.'</td>';
			$text.='<td>'.$rep->auteur.'</td>';
			$text.='<td>'.$rep->collection.'</td>';
			$text.='<td>'.$rep->datefr.'</td>';
			$text.='<td>'.$rep->stock.'</td>';
			$text.='<td> <form method="Post" action="#"  >
			<input type="text" name="idsup" value='.$rep->id.' style="display:none;"/> 
			<input type="submit" name="supprimer" value="Supprimer"/>
			</form></td>';
			$text.='</tr>';	
		}
		$text.='</tbody></table>';
		echo $text;
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
		 * defined in Edartois_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Edartois_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 'cssDatatables', 'https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/edartois-admin.css', array(), $this->version, 'all' );

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
		 * defined in Edartois_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Edartois_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'datatables', 'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js', array('jquery'), $this->version,true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/edartois-admin.js', array( 'jquery' ), $this->version, false );

	}

}
class afficheLivreDispo extends WP_Widget
    {
      public function __construct()
      {
        parent::__construct('idAfficheLivreDispo','Affichage livre disponible',array('description' => 'Livre disponible'));
        
      }
       public function widget($args,$instance){
        	global $wpdb;
		$query= "SELECT titre,auteur, DATE_FORMAT(sortie, '%d-%m-%Y') as datefr, stock, collection FROM ".$wpdb->prefix."livre WHERE stock>0";
		echo "<h1>Livre disponible</h1>";
		$resultats = $wpdb->get_results($query);
		$text="";
		$text="<table><tr>
				<th> Id</th>	
				<th> Titre</th>
				<th> Auteur </th>
				<th> Collection </th>
				<th> Sortie </th>
				<th> Stock </th>
			</tr>";
		foreach($resultats as $rep){
			$text.='<tr>';
			$text.='<td>'.$rep->titre.'</td>';
			$text.='<td>'.$rep->auteur.'</td>';
			$text.='<td>'.$rep->collection.'</td>';
			$text.='<td>'.$rep->datefr.'</td>';
			$text.='<td>'.$rep->stock.'</td>';
			$text.='</tr>';
		}
		$text.='</table>';
		echo $text;

       }
       public function form($instance){
        echo "<p>Affiche les livres encore disponible </p>";
        }
     }
     ?>


