<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	
	<header class="header_area">
		<div class="container">
			
		
			<div class="row">
				<nav class="navbar navbar-expand-lg bg-color" id="nav">
						<a class="navbar-brand" href="<?php echo get_home_url(); ?>"><img src="<?php the_field('logo-h', 'option'); ?>" class="img-fluid" alt="" />
						</a>


						<div class="collapse justify-content-end navbar-collapse" id="navbarSupportedContent">
							<?php
							wp_nav_menu(array(
								'theme_location'    => 'main_nav',
								'depth'             => 1,
								'container'         => '',
								// 'container_class'   => 'ms-auto collapse navbar-collapse',
								// 'container_id'      => 'navbarCollapse',
								'menu_class'        => 'navbar-nav',
								'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
								'walker'            => new WP_Bootstrap_Navwalker(),
								'add_li_class'      => 'nav-item nav-link'
							));
							?>

						</div>
						<a class="class-for-mobile" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
							<span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
						</a>

						<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
							<div class="offcanvas-header">
<!-- 								<a class="navbar-brand" href="<?php //echo get_home_url(); ?>"><img src="<?php echo the_field('header_logo', 'option'); ?>" class="img-fluid" alt="footer-logo" />
								</a> -->
								<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<div class="offcanvas-body">

								<?php
								wp_nav_menu(array(
									'theme_location'    => 'main_nav',
									'depth'             => 1,
									'container'         => '',
									// 'container_class'   => 'ms-auto collapse navbar-collapse',
									// 'container_id'      => 'navbarCollapse',
									'menu_class'        => 'navbar-nav',
									'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
									'walker'            => new WP_Bootstrap_Navwalker(),
									'add_li_class'      => 'nav-item nav-link'
								));
								?>


								
							</div>
						</div>
				</nav>
			
		
			</div>
		</div>
			</header>
