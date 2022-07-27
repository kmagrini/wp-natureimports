<?php
function shoply_css() {
	$parent_style = 'storely-parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'shoply-style', get_stylesheet_uri(), array( $parent_style ));
	
	wp_enqueue_style('shoply-media-query',get_stylesheet_directory_uri().'/assets/css/responsive.css');
	wp_dequeue_style('storely-media-query');

}
add_action( 'wp_enqueue_scripts', 'shoply_css',999);


/**
 * Register widget area.
 */

function shoply_widgets_init() {	
	register_sidebar( array(
		'name' => __( 'Header Navigation Widget', 'shoply' ),
		'id' => 'storely-header-nav',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
}
add_action( 'widgets_init', 'shoply_widgets_init' );

require get_stylesheet_directory() . '/inc/customizer/customizer-options/shoply-pro.php';


/**
 * Import Settings From Parent Theme
 *
 */
function shoply_parent_theme_options() {
	$storely_mods = get_option( 'theme_mods_storely' );
	if ( ! empty( $storely_mods ) ) {
		foreach ( $storely_mods as $storely_mod_k => $storely_mod_v ) {
			set_theme_mod( $storely_mod_k, $storely_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'shoply_parent_theme_options' );