<?php global $mytheme; ?>
<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?><!DOCTYPE html>
<?php ob_start(); ?>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon.ico" type="image/x-icon" />
	<?php wp_head(); ?>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5shiv.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/respond.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/ie-placeholder.js"></script>
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/ie.css" type="text/css">
	<![endif]-->
	<title><?php bloginfo('name') ?></title>



		
</head>

<body <?php body_class(); ?> >

<div id="page" class="site <?php if( is_home() ){ echo ' about-bg';}?>">

	
	<header id="home" class="header">
		<nav id="main-nav" class="navbar navbar-default menu navbar-fixed-top">
			<div class="container container-header">

				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-2 navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?php  echo get_home_url(); ?>" >
							<div class="container-logo">
								<img src="<?php bloginfo('template_url') ?>/images/logo-header.png" alt="">
							</div>
						</a>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-1 company-details">
						<div class="lpg-header-address">
							<a href="<?php echo $mytheme['googlemaps']; ?>">
								<div class="icon-top red-text">
									<span class="glyphicon glyphicon-map-marker" data-title="Company address"></span>
								</div>
							</a>
						</div>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="col-lg-7 col-md-7 col-sm-7 menu-header">

						 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<?php wp_nav_menu( array('theme_location' => 'menu', 'container' => false, 'menu_class' => 'nav navbar-nav current-menu-item', 'fallback_cb' => 'lpg_wp_page_menu')); ?>
						 </div>
					</div><!-- /.navbar-collapse -->
					<div class="col-lg-2 col-md-2 col-sm-2 company-details">
						<div class="icon-top blue-text">
						</div>
						<div class="lpg-header-phone">
							<span class="glyphicon glyphicon-earphone"></span>
							<a href="tel:<?php echo $mytheme['phone']; ?>"><?php echo $mytheme['phone']; ?></a>
						</div>
					</div>
				</div>

			</div><!-- /.container-->
		</nav>
	</header>

