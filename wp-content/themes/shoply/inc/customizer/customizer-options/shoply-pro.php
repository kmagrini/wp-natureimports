<?php
function shoply_upsale_setting( $wp_customize ) {
	
	$wp_customize->add_section(
        'storely_upsale',
        array(
            'title' 		=> __('Get More Features in Shoply Pro','shoply'),
			'priority'      => 1,
		)
    );
	
	/*=========================================
	 Buttons
	=========================================*/
	
	class Shoply_Button_Customize_Control extends WP_Customize_Control {
	public $type = 'storely_upsale';

	   function render_content() {
		?>
			<div class="upsale_info">
				<ul>
					<li><a href="https://preview.sellerthemes.com/pro/shoply/" class="btn-secondary" target="_blank"><i class="dashicons dashicons-desktop"></i><?php _e( 'Pro Demo','shoply' ); ?> </a></li>
					
					<li><a href="https://sellerthemes.com/storely/" class="btn-primary" target="_blank"><i class="dashicons dashicons-cart"></i><?php _e( 'Purchase Now','shoply' ); ?> </a></li>
					
					<li><a href="https://sellerthemes.com/submit-ticket/" class="btn-secondary" target="_blank"><i class="dashicons dashicons-sos"></i><?php _e( 'Ask for Support','shoply' ); ?> </a></li>
					
					<li><a href="https://wordpress.org/support/theme/shoply/reviews/#new-post" class="btn-green" target="_blank"><i class="dashicons dashicons-heart"></i><?php _e( 'Give us Rating','shoply' ); ?> </a></li>
				</ul>
			</div>
		<?php
	   }
	}
	
	$wp_customize->add_setting(
		'storely_upsale_btns',
		array(
		   'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'storely_sanitize_text',
		)	
	);
	
	$wp_customize->add_control( new Shoply_Button_Customize_Control( $wp_customize, 'storely_upsale_btns', array(
		'section' => 'storely_upsale',
    ))
);
}
add_action( 'customize_register', 'shoply_upsale_setting',999 );