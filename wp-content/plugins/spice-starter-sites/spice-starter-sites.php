<?php
/*
Plugin Name:       	Spice Starter Sites
Plugin URI:         https://olivewp.org/
Description:       	The plugin allows you to create professional designed pixel perfect websites in minutes. Import the stater sites to create the beautiful websites.
Version:           	0.5
Requires at least: 	5.3
Requires PHP: 		5.2
Tested up to: 		6.0
Author:            	spicethemes
Author URI:        	https://spicethemes.com
License: 			GPLv2 or later
License URI:       	http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain:       	spice-starter-sites
Domain Path:  		/languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
		die;
}

/**
 * Set up and initialize
 */
class Spice_Starter_Sites {
		private static $instance;

		/**
		 * Actions setup
		 */
		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'constants' ), 2 );
			add_action( 'plugins_loaded', array( $this, 'includes' ), 4 );
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

			//check if the One Click Demo Importer is installed or activated
		    if (!class_exists('OCDI_Plugin'))
		    {
			    add_action('admin_notices', array( $this, 'admin_notice' ), 6 );
		   		 return;
		    }
		}

		/**
		 * Constants
		*/
		function constants() {
			define( 'SP_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		}

		/**
		 * Includes
		 */
		function includes() {
			if(! function_exists( 'spice_starter_sites_plus_plugin' ) ) {
				require_once( SP_DIR . 'demo-content/setup.php' );
			}
		}

		/*
	    * Admin Notice
	    * Warning when the site doesn't have One Click Demo Importer installed or activated    
	    */
	    public function admin_notice() {
			echo '<div class="notice notice-warning is-dismissible"><p>', esc_html__('"Spice Starter Sites" requires "One Click Demo Import" to be installed and activated.','spice-starter-sites'), '</p></div>';
	    }

		static function install() {
			if ( version_compare(PHP_VERSION, '5.4', '<=') ) {
				wp_die( __( 'Spice Starter Sites requires PHP 5.4. Please contact your host to upgrade your PHP. The plugin was <strong>not</strong> activated.', 'spice-starter-sites' ) );
			};

		}

		/**
		 * Returns the instance.
		*/
		public static function get_instance() {

			if ( !self::$instance )
				self::$instance = new self;

			return self::$instance;
		}


		/**
		 * Load the localisation file.
		*/
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'spice-starter-sites' , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}
}

function spice_starter_sites_plugin() {
	return Spice_Starter_Sites::get_instance();
}
add_action('plugins_loaded', 'spice_starter_sites_plugin', 1);

//Does not activate the plugin on PHP less than 5.4
register_activation_hook( __FILE__, array( 'Spice_Starter_Sites', 'install' ) );