<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	
		<?php wp_body_open(); ?>

			<a class="skip-link screen-reader-text" href="#page_content"><?php esc_html_e( 'Skip to content', 'te' ); ?></a>
			
			<header id="site-header" class="header-footer-group" role="banner">
			
				<div class="header-inner section-inner d-flex align-items-center">
			
					<div class="header-titles-wrapper">
			
						<div class="header-titles">
							<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
								<?php if( is_home() ) { ?>
									<h1 class="header-titles__logo"><?php the_field('logo', 'options'); ?></h1>
								<?php } else { ?>
									<div class="header-titles__logo"><?php the_field('logo', 'options'); ?></div>
								<?php } ?>
								<div class="header-titles__slogen"><?php the_field('slogen', 'options'); ?></div>
							</a>
						</div><!-- .header-titles -->
						
						<button class="toggle nav-toggle mobile-nav-toggle d-lg-none" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-icon">
											<?php //twentytwenty_the_theme_svg( 'ellipsis' ); ?>
										</span>
										<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
									</span>
						</button><!-- .nav-toggle -->
			
					</div><!-- .header-titles-wrapper -->
			
					<div class="header-navigation-wrapper mx-auto">
						
						<?php
						if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
							?>
			
							<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'twentytwenty' ); ?>" role="navigation">
			
								<ul class="primary-menu reset-list-style d-flex m-0 p-0">
									<?php
									if( false !== ($header = Codespire_Transient_Loader::cs_get_transient('main_menu')) ) {
										echo $header;
									} else {
										$header = Codespire_Transient_Loader::refresh_transient('main_menu', 'cs_get_header_menu', ['main_menu']);
										echo $header;
									}
									?>
			
								</ul>
			
							</nav><!-- .primary-menu-wrapper -->
							
							<?php
						}
						
						if ( has_nav_menu( 'expanded' ) ) {
							?>
			
							<div class="header-toggles hide-no-js">
			
								<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">
		
									<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
											<span class="toggle-inner">
												<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
												<span class="toggle-icon">
													<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
												</span>
											</span>
									</button><!-- .nav-toggle -->
		
								</div><!-- .nav-toggle-wrapper -->
			
							</div><!-- .header-toggles -->
							<?php
						}
						?>
			
					</div><!-- .header-navigation-wrapper -->
			
				</div><!-- .header-inner -->
			
			</header><!-- #site-header -->
			
			<?php
					// Output the menu modal.
					get_template_part( 'template-parts/modal-menu' ); ?>

