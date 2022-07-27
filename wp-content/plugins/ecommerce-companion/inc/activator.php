<?php
/**
 * Fired during plugin activation
 *
 * @package    eCommerce Companion
 */

/**
 * This class defines all code necessary to run during the plugin's activation.
 *
 */
class eCommerce_Comapnion_Activator {

	public static function activate() {

        $item_details_page = get_option('item_details_page'); 
		$theme = wp_get_theme(); // gets the current theme
		if(!$item_details_page){
			if ( 'Storely' == $theme->name  || 'Shoply' == $theme->name  || 'Storess' == $theme->name || 'Storezia' == $theme->name  ||  'Shopwire' == $theme->name){
				require ECOMMERCE_COMP_PLUGIN_DIR . 'inc/themes/storely/pages-widget/upload-media.php';
				require ECOMMERCE_COMP_PLUGIN_DIR . 'inc/themes/storely/pages-widget/home-page.php';
				require ECOMMERCE_COMP_PLUGIN_DIR . 'inc/themes/storely/pages-widget/default-widget.php';
				require ECOMMERCE_COMP_PLUGIN_DIR . 'inc/themes/storely/pages-widget/default-post.php';
			}
			
			update_option( 'item_details_page', 'Done' );
		}
	}

}