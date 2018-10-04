<?php
/**
 * The Header template for our theme
 *
 * @package WordPress
 * @subpackage FSV GALLERY
 * @since FSV GALLERY 1.1
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

<div id="page">

	<div id="masthead" class="site-header" role="banner">

		<div id="header-inner">

			<div class="component-inner">

				<div id="header-menu-button"><a href="#site-navigation"><img src="<?php echo get_template_directory_uri(); ?>/images/icon_nav.png" width="32" height="28" alt="Navigation Menu"></a></div>

				<div id="header-title-area">

					<?php
					$options = fsvgallery_get_theme_options();
					if ( !isset( $options[ 'header_logo' ] ) ) { $opHeaderLogo = ''; }
					else { $opHeaderLogo = $options[ 'header_logo' ]; }

					if ( $opHeaderLogo ) : ?>

					<h1 class="site-title-img"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php echo $opHeaderLogo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a></h1>

					<?php else : ?>

					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'name' ) ); ?></a></h1>

					<?php endif; ?>

					<?php if (! is_front_page() ) : ?>

					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

					<?php endif; ?>

				</div><!-- #header-title-area -->

				<div id="header-widget-area">

					<?php get_search_form(); ?>

				</div><!-- #header-widget-area -->

				<div class="clear"></div>

			</div><!-- .component-inner -->

		</div><!-- .header-inner -->

	</div><!-- #masthead -->

	<?php if ( ( is_home() || is_front_page() ) && get_header_image() ) : ?>
	
	

	<div id="header-image-area" class="header-image">
		
		<ul class="bxslider">
			<li><img src="<?php echo get_template_directory_uri() ?>/images/header_001.jpg" /></li>
			<li><img src="<?php echo get_template_directory_uri() ?>/images/header_002.jpg" /></li>
			<li><img src="<?php echo get_template_directory_uri() ?>/images/header_003.jpg" /></li>
			<li><img src="<?php echo get_template_directory_uri() ?>/images/header_004.jpg" /></li>
		</ul>

	</div><!-- #header-title-area -->

	<?php endif; // is_home()/is_front_page()/get_header_image() ?>

	<div id="header-nav-area">

		<div class="component-inner">

			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'fsvgallery' ); ?>"><?php _e( 'Skip to content', 'fsvgallery' ); ?></a>

			<nav id="site-navigation" class="main-navigation" role="navigation">

				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'div', 'container_class' => 'menu' , 'menu_class' => 'menu' ) ); ?>

			</nav><!-- #site-navigation -->

		</div><!-- .component-inner -->

	</div><!-- #header-nav-area -->
