<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="custom-header" rel="home">
		<img src="<?php esc_url(header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
	</a>	
<?php endif; ?>
<header id="main-header2" class="main-header">
	<?php do_action('storely_section_header'); ?>
	<div class="navigation-wrapper">
		<div class="navigation-middle">
			<div class="main-navigation-area d-none d-lg-block">
				<div class="main-navigation <?php echo esc_attr(storely_sticky_menu()); ?>">
					<div class="container">
						<div class="row navigation-middle-row align-items-center">
							<div class="col-lg-2 col-12 my-auto">
								<div class="logo">
									<?php do_action('storely_logo'); ?>
								</div>
							</div>
							<div class="col-lg-8 col-12">
								<?php do_action('storely_hdr_product_search')?>
							</div>
							<div class="main-menu-right col-lg-2 ">
								<ul class="menu-right-list">
									<?php 
										do_action('storely_hdr_account');
										do_action('storely_hdr_cart');
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main-mobile-nav <?php echo esc_attr(storely_sticky_menu()); ?>">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="main-mobile-menu">
							<div class="main-menu-right main-mobile-left">
								<div class="logo">
									<?php do_action('storely_logo'); ?>
								</div>
							</div>
							<div class="menu-collapse-wrap">
								<div class="hamburger-menu">
									<button type="button" class="menu-collapsed" aria-label="<?php echo esc_attr_e('Menu Collaped','shoply'); ?>">
										<div class="top-bun"></div>
										<div class="meat"></div>
										<div class="bottom-bun"></div>
									</button>
								</div>
							</div>
							<div class="main-mobile-wrapper">
								<div id="mobile-menu-build" class="main-mobile-build">
									<button type="button" class="header-close-menu close-style" aria-label="<?php echo esc_attr_e('Header Close Menu','shoply'); ?>"></button>

									<?php do_action('storely_hdr_mobile_browse_cat')?>
								</div>
							</div>
							<?php if ( function_exists( 'ecommerce_companion_activate' ) ) : ?>
								<div class="header-above-wrapper">
									<div class="header-above-index">
										<div class="header-above-btn">
											<button type="button" class="header-above-collapse" aria-label="<?php echo esc_attr_e('Header Above Collapse','shoply');?>"><span></span></button>
										</div>
										<div id="header-above-bar" class="header-above-bar"></div>
									</div>
								</div>
							<?php endif; ?>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>


<!--===// Start: Browse
=================================-->
<div id="browse-section" class="browse-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-12">
				<?php 
				$shoply_hs_browse_cat		= get_theme_mod( 'hs_browse_cat','1');
				if($shoply_hs_browse_cat=='1' && class_exists( 'woocommerce' )): ?>
					<div class="product-category-browse d-none d-lg-block">
						<?php do_action('storely_hdr_browse_cat'); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-lg-6 col-xl-7 col-12 my-auto">
				<nav class="navbar-area d-none d-lg-block">
					<div class="main-navbar">
						<?php do_action('storely_main_nav'); ?>
					</div>
				</nav>
			</div>
			<div class="col-lg-3 col-xl-2 col-12 mb-lg-0 mb-4">
				<div class=" text-lg-right text-center d-lg-block d-none">
					<div class="main-navbar menu-bar justify-content-center menu-bar-right">
						<?php 
							$shoply_widget = 'storely-header-nav';
							if ( is_active_sidebar( $shoply_widget ) ){ 
								dynamic_sidebar( 'storely-header-nav' );
							}elseif ( current_user_can( 'edit_theme_options' ) ) {
								?>
								<div class="widget widget_none">
									<p>
										<?php if ( is_customize_preview() ) { ?>
											<a href="JavaScript:Void(0);" class="" data-sidebar-id="<?php echo esc_attr( $shoply_widget ); ?>">
										<?php } else { ?>
											<a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>">
										<?php } ?>
											<?php esc_html_e( 'Please assign widget.', 'shoply' ); ?>
										</a>
									</p>
								</div>
								<?php
							} 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End: Browse
=================================-->