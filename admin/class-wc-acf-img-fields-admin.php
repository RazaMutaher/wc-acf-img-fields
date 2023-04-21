<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://fiverr.com/iqbalmalik
 * @since      1.0.0
 *
 * @package    Wc_Acf_Img_Fields
 * @subpackage Wc_Acf_Img_Fields/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Acf_Img_Fields
 * @subpackage Wc_Acf_Img_Fields/admin
 * @author     Iqbal <dev.miqbal@gmail.com>
 */
class Wc_Acf_Img_Fields_Admin {

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

		add_action( 'admin_menu', array( $this, 'add_admin_page' ) );

		//wai_sync_woo_images_to_acf
		add_action( 'wp_ajax_wai_sync_woo_images_to_acf', array( $this, 'wai_sync_woo_images_to_acf_function' ) );
		add_action( 'wp_ajax_nopriv_wai_sync_woo_images_to_acf', array( $this, 'wai_sync_woo_images_to_acf_function' ) );

	}

	public function wai_sync_woo_images_to_acf_function(){
		$args     = array( 'post_type' => 'product', 'posts_per_page' => -1);
		$products = get_posts( $args );
		$acf_arr = json_decode(stripslashes($_POST['acf_arr']));
		foreach($products as $prod){
			$product_id = $prod->ID;
			$thumbnail_ids = get_post_meta($product_id,'_product_image_gallery',true);
			$thumbnail_ids = isset($thumbnail_ids) ? $thumbnail_ids : '';
			if(!empty($thumbnail_ids)){
				$thumbnails_arr = (explode(",",$thumbnail_ids));
				for($i=0; $i<3; $i++){
					if(isset($thumbnails_arr[$i]) && isset($acf_arr[$i])){
						update_post_meta($product_id,$acf_arr[$i],$thumbnails_arr[$i] );
					}
				}
			}
		}

		echo wp_json_encode(
			array(
				'success' => 'yes'
			)
		);

		exit();
	}

	public function add_admin_page() {
		add_menu_page(
			'WC ACF Image Sync',
			'WC ACF Image Sync',
			'manage_options',
			'wc-acf-img-sync',
			array( $this, 'wc_acf_img_sync_tab_data' ),
			'dashicons-admin-tools'
		);
	}

	function wc_acf_img_sync_tab_data(){
		global $wpdb;
		$posts_table = $wpdb->prefix . 'posts';
		$query       = 'SELECT post_title, post_excerpt FROM ' . $posts_table . " WHERE post_type='acf-field'";
		$records = $wpdb->get_results( $query );

		require_once 'partials/wc-acf-img-fields-admin-display.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook_suffix) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Acf_Img_Fields_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Acf_Img_Fields_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-acf-img-fields-admin.css', array(), $this->version, 'all' );
		if($hook_suffix == 'toplevel_page_wc-acf-img-sync'){
			wp_enqueue_style( $this->plugin_name . 'wai-bootstrap-css', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . 'wai-bootstrap-min-css', 'https://copyecom.ai/wp-content/plugins/prod-desc-gen-api/public/css/bootstrap/bootstrap.min.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook_suffix) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Acf_Img_Fields_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Acf_Img_Fields_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-acf-img-fields-admin.js', array( 'jquery' ), $this->version, false );
		if($hook_suffix == 'toplevel_page_wc-acf-img-sync'){
			wp_enqueue_script( $this->plugin_name . 'wai-sweet-alerts-js', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name . 'wai-bootstrap-min-js', 'https://copyecom.ai/wp-content/plugins/prod-desc-gen-api/public/js/bootstrap/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		}
	}

}
