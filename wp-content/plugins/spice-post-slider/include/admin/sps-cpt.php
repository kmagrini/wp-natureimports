<?php
/**
 * Register Post Type
 */
if ( ! class_exists( 'Spice_Post_Slider_Type' ) ) {

  class Spice_Post_Slider_Type
  {

    public function __construct()
    {
      //Register spice_post_slider CPT
      add_action('init', array( $this , 'sps_register' ));
      add_action( 'admin_enqueue_scripts', array( $this,'sps_load_admin_script'));
      add_action( 'wp_enqueue_scripts', array( $this,'sps_load_script'));
      add_action( 'add_meta_boxes', array( $this, 'sps_meta_fn'));
      add_action('save_post',array( $this, 'sps_meta_save'));
    }

    //Register spice_post_slider CPT callback function
    function sps_register() {
      $labels = array(
        'name'               => esc_html__( 'Post Slider', 'spice-post-slider' ),
        'singular_name'      => esc_html__( 'Post Slider', 'spice-post-slider' ),
        'add_new'            => esc_html__( 'Add New','spice-post-slider' ),
        'add_new_item'       => esc_html__( 'Add New Post Slider', 'spice-post-slider' ),
        'edit_item'          => esc_html__( 'Edit Post Slider', 'spice-post-slider' ),
        'new_item'           => esc_html__( 'New Post Slider', 'spice-post-slider' ),
        'all_items'          => esc_html__( 'All Post Slider', 'spice-post-slider' ),
        'view_item'          => esc_html__( 'View Post Slider', 'spice-post-slider' ),
        'search_items'       => esc_html__( 'Search Post Slider', 'spice-post-slider' ),
        'not_found'          => esc_html__( 'No posts slider found', 'spice-post-slider' ),
        'not_found_in_trash' => esc_html__( 'No posts slider found in the Trash', 'spice-post-slider' ), 
        'parent_item_colon'  =>  '',
        'menu_name'          => 'Post Slider'
      );
      $args = array(
        'labels'        => $labels,
        'public'        => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-slides',
        'supports'      => array( 'title'),
        'has_archive'   => false,
      );
    register_post_type( 'spice_post_slider', $args ); 
    }

    /**
     * Load Admin Script
     *
     * @since 1.0
     */
     public function sps_load_admin_script()
     {
      wp_enqueue_style( 'wp-color-picker' );
      wp_enqueue_script( 'sps-color-pic', SPS_URL.'assets/js/color-picker.js', array( 'wp-color-picker' ), false, true );
      wp_enqueue_style('sps-style', SPS_URL.'assets/css/style.css');
      wp_enqueue_style('sps-select', SPS_URL.'assets/css/select2.min.css');
      wp_enqueue_style('sps-jquery-ui', SPS_URL.'assets/css/jquery-ui.css'); 
      wp_enqueue_script('jquery-ui-tabs');
      wp_enqueue_script('jquery-ui-slider');
      wp_enqueue_script('sps-select', SPS_URL . 'assets/js/select.min.js', array('jquery'));
      wp_enqueue_script('sps-custom-tabs', SPS_URL . 'assets/js/custom.js', array('jquery'));
     }

     /**
     * Load Front Script
     *
     * @since 1.0
     */
     public function sps_load_script()
     {
      wp_enqueue_style('sps-font-awesome', SPS_URL.'assets/css/font-awesome/css/all.min.css');
      wp_enqueue_style('sps-owl', SPS_URL.'assets/css/owl.carousel.css');
      wp_enqueue_style('sps-front', SPS_URL.'assets/css/front.css');
      wp_enqueue_script('sps-owl', SPS_URL . 'assets/js/owl.carousel.min.js', array('jquery'));
     }

    //Add Meta Box
    function sps_meta_fn()
    {
      add_meta_box( 'spice_post_slider_meta_id', esc_html__('Post Slider Settings','spice-post-slider'), array($this,'sps_meta_cb_fn'), 'spice_post_slider','normal','high' );
      add_meta_box( 'spice_post_slider_generator_id', esc_html__('Post Slider  Shortcode','spice-post-slider'), array($this,'sps_generator_fn'), 'spice_post_slider','side','low' );
    }


    //Callback Meta Function
    function sps_meta_cb_fn()
    {
      require_once('sps-meta-box.php');
    }

     //Shortcode Generator Function
    function sps_generator_fn()
    {
      require_once('sps-shortcode-generator.php');
    }


    //Save Meta Values
    function sps_meta_save($post_id) 
      {  
        if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']))
              return;
          
        if ( ! current_user_can( 'edit_page', $post_id ) )
        {   return ;  } 
          
        if(isset( $_POST['post_ID']))
        {   
          $post_ID = absint($_POST['post_ID']);       
          $post_type=get_post_type($post_ID);
          
          if($post_type=='spice_post_slider')
          { 
            update_post_meta($post_ID, 'sps_orderby', sanitize_text_field($_POST['sps_orderby']));
            update_post_meta($post_ID, 'sps_post_page', absint($_POST['sps_post_page']));
            update_post_meta($post_ID, 'sps_slide_item', absint($_POST['sps_slide_item']));
            update_post_meta($post_ID, 'sps_slide_img', sanitize_text_field($_POST['sps_slide_img']));
            update_post_meta($post_ID, 'sps_dt_enable', sanitize_text_field($_POST['sps_dt_enable']));
            update_post_meta($post_ID, 'sps_cat_enable', sanitize_text_field($_POST['sps_cat_enable']));
            update_post_meta($post_ID, 'sps_comment_enable', sanitize_text_field($_POST['sps_comment_enable']));
            update_post_meta($post_ID, 'sps_auth_enable', sanitize_text_field($_POST['sps_auth_enable']));
            if(empty($_POST['sps_read']))
            {
              $sps_read='sps_blank';
            }
            else
            {
              $sps_read=sanitize_text_field($_POST['sps_read']);
            }
            update_post_meta($post_ID, 'sps_read', $sps_read);
            update_post_meta($post_ID, 'sps_speed', absint($_POST['sps_speed']));
            update_post_meta($post_ID, 'sps_title_ff', sanitize_text_field($_POST['sps_title_ff']));
            update_post_meta($post_ID, 'sps_title_fs', absint($_POST['sps_title_fs']));
            update_post_meta($post_ID, 'sps_title_lheight', absint($_POST['sps_title_lheight']));
            update_post_meta($post_ID, 'sps_title_fw', absint($_POST['sps_title_fw']));
            update_post_meta($post_ID, 'sps_title_fstyle', sanitize_text_field($_POST['sps_title_fstyle']));
            update_post_meta($post_ID, 'sps_title_trans', sanitize_text_field($_POST['sps_title_trans']));
            update_post_meta($post_ID, 'sps_content_ff', sanitize_text_field($_POST['sps_content_ff']));
            update_post_meta($post_ID, 'sps_content_fs', absint($_POST['sps_content_fs']));
            update_post_meta($post_ID, 'sps_content_lheight', absint($_POST['sps_content_lheight']));
            update_post_meta($post_ID, 'sps_content_fw', absint($_POST['sps_content_fw']));
            update_post_meta($post_ID, 'sps_content_fstyle', sanitize_text_field($_POST['sps_content_fstyle']));
            update_post_meta($post_ID, 'sps_content_trans', sanitize_text_field($_POST['sps_content_trans']));
            update_post_meta($post_ID, 'sps_meta_ff', sanitize_text_field($_POST['sps_meta_ff']));
            update_post_meta($post_ID, 'sps_meta_fs', absint($_POST['sps_meta_fs']));
            update_post_meta($post_ID, 'sps_meta_lheight', absint($_POST['sps_meta_lheight']));
            update_post_meta($post_ID, 'sps_meta_fw', absint($_POST['sps_meta_fw']));
            update_post_meta($post_ID, 'sps_meta_fstyle', sanitize_text_field($_POST['sps_meta_fstyle']));
            update_post_meta($post_ID, 'sps_meta_trans', sanitize_text_field($_POST['sps_meta_trans']));
            update_post_meta($post_ID, 'sps_read_ff', sanitize_text_field($_POST['sps_read_ff']));
            update_post_meta($post_ID, 'sps_read_fs', absint($_POST['sps_read_fs']));
            update_post_meta($post_ID, 'sps_read_lheight', absint($_POST['sps_read_lheight']));
            update_post_meta($post_ID, 'sps_read_fw', absint($_POST['sps_read_fw']));
            update_post_meta($post_ID, 'sps_read_fstyle', sanitize_text_field($_POST['sps_read_fstyle']));
            update_post_meta($post_ID, 'sps_read_trans', sanitize_text_field($_POST['sps_read_trans']));
            update_post_meta($post_ID, 'sps_icon_clr', sanitize_hex_color($_POST['sps_icon_clr']));
            update_post_meta($post_ID, 'sps_meta_clr', sanitize_hex_color($_POST['sps_meta_clr']));
            update_post_meta($post_ID, 'sps_meta_hov_clr', sanitize_hex_color($_POST['sps_meta_hov_clr']));
            update_post_meta($post_ID, 'sps_title_clr', sanitize_hex_color($_POST['sps_title_clr']));
            update_post_meta($post_ID, 'sps_title_hov_clr', sanitize_hex_color($_POST['sps_title_hov_clr']));
            update_post_meta($post_ID, 'sps_content_clr', sanitize_hex_color($_POST['sps_content_clr']));
            update_post_meta($post_ID, 'sps_btn_bg_clr', sanitize_hex_color($_POST['sps_btn_bg_clr']));
            update_post_meta($post_ID, 'sps_btn_txt_clr', sanitize_hex_color($_POST['sps_btn_txt_clr']));
            update_post_meta($post_ID, 'sps_btn_bg_hov_clr', sanitize_hex_color($_POST['sps_btn_bg_hov_clr']));
            update_post_meta($post_ID, 'sps_btn_txt_hov_clr', sanitize_hex_color($_POST['sps_btn_txt_hov_clr']));
            update_post_meta($post_ID, 'sps_nav_clr', sanitize_hex_color($_POST['sps_nav_clr']));
            if(empty($_POST['sps_cat_query'])) { $sps_cat_query_cat = ''; }
            else { $sps_cat_query_cat = sanitize_text_field(implode(',', $_POST['sps_cat_query'])); }
            update_post_meta($post_id, 'sps_cat_query', $sps_cat_query_cat);
                 
          }     
        }       
      }


  }

}

new Spice_Post_Slider_Type();