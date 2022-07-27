<?php
/*
* Plugin Name:			Spice Post Slider
* Plugin URI:  			https://spicethemes.com/spice-post-slider/
* Description: 			This plugin allows you to showcase your blog posts in a beautiful slider with multiple options, It is responsive ready so it will work perfectly on different devices like mobile and iPad. The main important feature of the plugin is providing the typography and color settings from where you can change the typography and color of the content.
* Version:     			0.7
* Requires at least: 	5.3
* Requires PHP: 		5.2
* Tested up to: 		5.9
* Author:      			Spicethemes
* Author URI:  			https://spicethemes.com
* License: 				GPLv2 or later
* License URI: 			https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: 			spice-post-slider
* Domain Path:  		/languages
*/

// Exit if accessed directly
if( ! defined('ABSPATH'))
{
	die('Do not open this file directly.');
}

/**
 * Main Spice_Post_Slider Class
 *
 * @class Spice_Post_Slider
 * @version 0.5
 * @since 0.1
 * @package Spice_Post_Slider
 */

final class Spice_Post_Slider {

	/**
	 * The version number.
	 *
	 * @var     string
	 * @access  public
	 * @since   0.1
	 */
	public $version;


	/**
	 * Constructor function.
	 *
	 * @access  public
	 * @since   0.1
	 * @return  void
	 */
	public function __construct() {
		$this->plugin_url  = plugin_dir_url( __FILE__ );
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->version     = '0.5';

		define( 'SPS_URL', $this->plugin_url );
		define( 'SPS_PATH', $this->plugin_path );
		define( 'SPS_VERSION', $this->version );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		//Register spice_post_slider CPT
		require_once SPS_PATH . 'include/admin/sps-cpt.php';

		//Output file to view post slider
		require_once SPS_PATH . '/include/view/shortcode.php';

		//Font file
		require_once SPS_PATH . '/include/admin/sps-fonts.php';
	}

	/**
	 * Load the localisation file.
	 *
	 * @access  public
	 * @since   0.1
	 * @return  void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'spice-post-slider' , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}


}

new Spice_Post_Slider;