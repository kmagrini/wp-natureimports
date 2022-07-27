<?php
// Exit if accessed directly
if (!defined('ABSPATH')) 
{
    die('Do not open this file directly.');
}

add_shortcode('spice_post_slider', 'sps_shortcode');
if ( !function_exists( 'sps_shortcode' ) ) {
    function sps_shortcode($id)
    {
        ob_start();
        $sps_post_id= !isset($id['id']) ? $sps_shortcodes_cpt_id='' : $sps_shortcodes_cpt_id=$id['id'];
        //General
        $sps_cat=get_post_meta($sps_post_id,'sps_cat_query', true );
        $sps_orderby=get_post_meta($sps_post_id,'sps_orderby', true );
        $sps_loop=get_post_meta($sps_post_id,'sps_post_page', true );
        $sps_item=get_post_meta($sps_post_id,'sps_slide_item', true );
        $sps_img=get_post_meta($sps_post_id,'sps_slide_img', true );
        $sps_dt=get_post_meta($sps_post_id,'sps_dt_enable', true );
        $sps_cat_enable=get_post_meta($sps_post_id,'sps_cat_enable', true );
        $sps_auth=get_post_meta($sps_post_id,'sps_auth_enable', true );
        $sps_comments=get_post_meta($sps_post_id,'sps_comment_enable', true );
        $sps_read=get_post_meta($sps_post_id,'sps_read', true );
        $sps_loop = empty($sps_loop) ? $sps_loop='4' : $sps_loop;
       
        //Slide
        $sps_speed=get_post_meta($sps_post_id,'sps_speed', true );

        //Typography
        $sps_title_ff=get_post_meta( $sps_post_id, 'sps_title_ff', true );
        $sps_title_fs=get_post_meta( $sps_post_id, 'sps_title_fs', true );
        $sps_title_lheight=get_post_meta( $sps_post_id, 'sps_title_lheight', true );
        $sps_title_fw=get_post_meta( $sps_post_id, 'sps_title_fw', true );
        $sps_title_fstyle=get_post_meta( $sps_post_id, 'sps_title_fstyle', true );
        $sps_title_trans=get_post_meta( $sps_post_id, 'sps_title_trans', true );
        $sps_content_ff=get_post_meta( $sps_post_id, 'sps_content_ff', true );
        $sps_content_fs=get_post_meta( $sps_post_id, 'sps_content_fs', true );
        $sps_content_lheight=get_post_meta( $sps_post_id, 'sps_content_lheight', true );
        $sps_content_fw=get_post_meta( $sps_post_id, 'sps_content_fw', true );
        $sps_content_fstyle=get_post_meta( $sps_post_id, 'sps_content_fstyle', true );
        $sps_content_trans=get_post_meta( $sps_post_id, 'sps_content_trans', true );
        $sps_meta_ff=get_post_meta( $sps_post_id, 'sps_meta_ff', true );
        $sps_meta_fs=get_post_meta( $sps_post_id, 'sps_meta_fs', true );
        $sps_meta_lheight=get_post_meta( $sps_post_id, 'sps_meta_lheight', true );
        $sps_meta_fw=get_post_meta( $sps_post_id, 'sps_meta_fw', true );
        $sps_meta_fstyle=get_post_meta( $sps_post_id, 'sps_meta_fstyle', true );
        $sps_meta_trans=get_post_meta( $sps_post_id, 'sps_meta_trans', true );
        $sps_read_ff=get_post_meta( $sps_post_id, 'sps_read_ff', true );
        $sps_read_fs=get_post_meta( $sps_post_id, 'sps_read_fs', true );
        $sps_read_lheight=get_post_meta( $sps_post_id, 'sps_read_lheight', true );
        $sps_read_fw=get_post_meta( $sps_post_id, 'sps_read_fw', true );
        $sps_read_fstyle=get_post_meta( $sps_post_id, 'sps_read_fstyle', true );
        $sps_read_trans=get_post_meta( $sps_post_id, 'sps_read_trans', true );

        //Color
        $sps_icon_clr=get_post_meta( $sps_post_id, 'sps_icon_clr', true );
        $sps_meta_clr=get_post_meta( $sps_post_id, 'sps_meta_clr', true );
        $sps_meta_hov_clr=get_post_meta( $sps_post_id, 'sps_meta_hov_clr', true );
        $sps_title_clr=get_post_meta( $sps_post_id, 'sps_title_clr', true );
        $sps_title_hov_clr=get_post_meta( $sps_post_id, 'sps_title_hov_clr', true );
        $sps_content_clr=get_post_meta( $sps_post_id, 'sps_content_clr', true );
        $sps_btn_bg_clr=get_post_meta( $sps_post_id, 'sps_btn_bg_clr', true );
        $sps_btn_txt_clr=get_post_meta( $sps_post_id, 'sps_btn_txt_clr', true );
        $sps_btn_bg_hov_clr=get_post_meta( $sps_post_id, 'sps_btn_bg_hov_clr', true );
        $sps_btn_txt_hov_clr=get_post_meta( $sps_post_id, 'sps_btn_txt_hov_clr', true );
        $sps_nav_clr=get_post_meta( $sps_post_id, 'sps_nav_clr', true );

        if(empty($sps_cat)) {
            $query_args = array('posts_per_page' =>$sps_loop,'order' => $sps_orderby,'ignore_sticky_posts' => 1); }
        else{
             $sps_cat_arr=explode(',',$sps_cat);
             $query_args = array( 'category__in'  => $sps_cat_arr, 'posts_per_page' =>$sps_loop,'order' => $sps_orderby,'ignore_sticky_posts' => 1); } ?>
        <section class="sps page-section-space blog bg-default sps<?php echo esc_attr($sps_post_id);?>">
            <div id="blog-carousel<?php echo esc_attr($sps_post_id);?>" class="owl-carousel owl-theme">
            <?php 
            global $post;
            $the_query = new WP_Query($query_args);
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) 
                {
                    $the_query->the_post(); ?>
                    <div class="item">
                        <article class="post">
                            <?php if(has_post_thumbnail()):?>
                            <figure class="post-thumbnail">                     
                                <?php the_post_thumbnail($sps_img,array('class'=>'img-fluid'));?>
                            </figure>
                            <?php endif;?>
                            <div class="post-content">                     
                                <div class="entry-meta">
                                    <?php if($sps_dt=='yes'):?>
                                    <span class="date">  
                                        <i class="far fa-clock"></i> 
                                        <a href="<?php echo esc_url( home_url('/') ); ?><?php echo esc_html(date( 'Y/m' , strtotime( get_the_date() )) ); ?>" >
                                            <time class="entry-date" ><?php echo esc_html(get_the_date()); ?></time>
                                        </a>
                                    </span>
                                    <?php 
                                    endif;
                                    if($sps_cat_enable=='yes')
                                        {       
                                            if ( has_category() ) : 
                                                echo '<i class="fa fa-folder-open"></i><span class="cat-links" alt="'.esc_attr__('Categories','spice-post-slider').'">';
                                                the_category( ', ' );
                                                echo '</span>';
                                            endif;
                                        }
                                    if($sps_comments=='yes'):    
                                    ?>
                                    <span class="comments-link">
                                        <i class="far fa-comment-alt"></i> 
                                        <a href="<?php the_permalink(); ?>#respond" >
                                            <?php echo esc_html(get_comments_number()); echo esc_html__(' Comments','spice-post-slider');?>
                                        </a>
                                    </span>  
                                    <?php endif;?>
                                </div>
                                <header class="entry-header">
                                    <h3 class="entry-title">
                                        <a href="<?php the_permalink();?>" alt="<?php the_title();?>"><?php the_title();?></a>
                                    </h3>                                                  
                                </header>
                                <div class="entry-content">
                                    <?php the_excerpt();?>
                                    <div class="spice-seprator"></div>
                                    <div class="footer-meta entry-meta">
                                    <?php if($sps_auth=='yes'): ?>    
                                        <span class="author">
                                            <i class="far fa-user"></i>
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" ><?php echo esc_html(get_the_author());?></a>
                                        </span>
                                    <?php endif;?>    
                                    </div>
                                    <?php if( !empty($sps_read) && ($sps_read!='sps_blank') ):?>
                                    <a href="<?php the_permalink();?>" class="more-link" alt="more-details"><?php echo esc_html($sps_read);?><i class="fas fa-chevron-right"></i>
                                    </a>
                                    <?php endif;?>
                                </div>
                            </div>
                        </article>
                    </div>
                 <?php 
                }
                wp_reset_query();
            }
            ?>
            </div>
       </section> 
       <script type="text/javascript">
           jQuery(document).ready(function() {
            jQuery("#blog-carousel<?php echo intval($sps_post_id);?>").owlCarousel({
                navigation : true, // Show next and prev buttons        
                autoplay: true,
                autoplayTimeout: <?php echo intval($sps_speed);?> + 700,
                autoplayHoverPause: true,
                smartSpeed: <?php echo intval($sps_speed);?>,
                loop:true, // loop is true up to 1199px screen.
                nav:true, // is true across all sizes
                margin:30, // margin 10px till 960 breakpoint
                autoHeight: true,
                responsiveClass:true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
                dots: true,
                navText: ["<i class='fas fa-chevron-left'></i>","<i class='fas fa-chevron-right'></i>"],
                responsive:{    
                    100:{ items:1 },
                    480:{ items:1 },
                    768:{ items:3 },
                    1000:{ items:<?php echo intval($sps_item);?> }            
                }
            }); 
        });
       </script>
       <style type="text/css">
            body .sps<?php echo intval($sps_post_id);?>.page-section-space.blog .post .post-content h3 a
                {
                    font-family: '<?php echo esc_attr($sps_title_ff);?>';
                    font-size: <?php echo intval($sps_title_fs);?>px;
                    line-height: <?php echo intval($sps_title_lheight);?>px;
                    font-weight: <?php echo intval($sps_title_fw);?>;
                    font-style: <?php echo esc_attr($sps_title_fstyle);?>;
                    text-transform: <?php echo esc_attr($sps_title_trans);?>;
                }
            body .sps<?php echo intval($sps_post_id);?> .entry-content p, body .sps<?php echo intval($sps_post_id);?> .entry-content span
                {
                    font-family: '<?php echo esc_attr($sps_content_ff);?>';
                    font-size: <?php echo intval($sps_content_fs);?>px;
                    line-height: <?php echo intval($sps_content_lheight);?>px;
                    font-weight: <?php echo intval($sps_content_fw);?>;
                    font-style: <?php echo esc_attr($sps_content_fstyle);?>;
                    text-transform: <?php echo esc_attr($sps_content_trans);?>;
                }
            body .sps<?php echo intval($sps_post_id);?>.page-section-space.blog .post .post-content .entry-meta a
                {
                    font-family: '<?php echo esc_attr($sps_meta_ff);?>';
                    font-size: <?php echo intval($sps_meta_fs);?>px;
                    line-height: <?php echo intval($sps_meta_lheight);?>px;
                    font-weight: <?php echo intval($sps_meta_fw);?>;
                    font-style: <?php echo esc_attr($sps_meta_fstyle);?>;
                    text-transform: <?php echo esc_attr($sps_meta_trans);?>;           
                }
            body .sps<?php echo intval($sps_post_id);?> .post .more-link
                {
                    font-family: '<?php echo esc_attr($sps_read_ff);?>';
                    font-size: <?php echo intval($sps_read_fs);?>px;
                    line-height: <?php echo intval($sps_read_lheight);?>px;
                    font-weight: <?php echo intval($sps_read_fw);?>;
                    font-style: <?php echo esc_attr($sps_read_fstyle);?>;
                    text-transform: <?php echo esc_attr($sps_read_trans);?>; 
                }    
            body .sps<?php echo intval($sps_post_id);?> .entry-meta i {
                color: <?php echo esc_attr($sps_icon_clr);?>;
            }
            body .sps<?php echo intval($sps_post_id);?> .entry-meta a {
                color:<?php echo esc_attr($sps_meta_clr);?> !important;
            }
            body .sps<?php echo intval($sps_post_id);?> .entry-meta a:hover {
                color: <?php echo esc_attr($sps_meta_hov_clr);?> !important;
            }
            body .sps<?php echo intval($sps_post_id);?>.page-section-space.blog .post .post-content h3 a {
                color: <?php echo esc_attr($sps_title_clr);?>;
            }
            body .sps<?php echo intval($sps_post_id);?>.page-section-space.blog .post .post-content h3 a:hover{ 
                color: <?php echo esc_attr($sps_title_hov_clr);?>;
            }
            body .sps<?php echo intval($sps_post_id);?> .post .more-link {
                background: <?php echo esc_attr($sps_btn_bg_clr);?>; 
                color: <?php echo esc_attr($sps_btn_txt_clr);?> !important;
            }
            body .sps<?php echo intval($sps_post_id);?> .post .more-link i{
                color: <?php echo esc_attr($sps_btn_txt_clr);?> !important;
            }
            body .sps<?php echo intval($sps_post_id);?> .post .more-link:hover {
                background: <?php echo esc_attr($sps_btn_bg_hov_clr);?>; 
                color: <?php echo esc_attr($sps_btn_txt_hov_clr);?> !important;
                border: 1px solid <?php echo esc_attr($sps_btn_bg_hov_clr);?>;
            }
            body .sps<?php echo intval($sps_post_id);?> .post .more-link:hover i{
                color: <?php echo esc_attr($sps_btn_txt_hov_clr);?> !important;
            }
            body .sps<?php echo intval($sps_post_id);?> .entry-content p {
                color: <?php echo esc_attr($sps_content_clr);?>;
            }
            body .sps<?php echo intval($sps_post_id);?> .owl-carousel .owl-prev:hover, body .sps<?php echo intval($sps_post_id);?> .owl-carousel .owl-prev:focus, body .sps<?php echo intval($sps_post_id);?> .owl-carousel .owl-next:hover, body .sps<?php echo intval($sps_post_id);?> .owl-carousel .owl-next:focus {
                background-color: <?php echo esc_attr($sps_nav_clr);?>;
            }
            body .sps<?php echo intval($sps_post_id);?> .owl-theme .owl-dots .owl-dot.active span {
                background-color: <?php echo esc_attr($sps_nav_clr);?>;
            }
        </style>
        <?php
        return ob_get_clean();
    }
}