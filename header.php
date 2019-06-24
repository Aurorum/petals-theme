<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Petals
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'petals' ); ?></a>

		<nav id="site-navigation" class="main-navigation">
				<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</div><!-- .site-branding -->
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'petals' ); ?></button>
			<?php endif; ?>
			<h1 class="site-title menu-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav>
		<?php if ( is_front_page() && is_home() ) : ?>
			<?php the_custom_logo(); ?>
			<?php
			$petals_description = get_bloginfo( 'description', 'display' );
			if ( ( $petals_description || is_customize_preview() ) && get_theme_mod( 'petals_panel_header' ) == 0 ) :
				if ( function_exists( 'jetpack_social_menu' ) ) jetpack_social_menu(); ?>
				<p class="site-description"><?php echo $petals_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		
		<?php if ( get_theme_mod( 'petals_panel_header' ) == 1 ) { ?>
			<div class="front-panel-wrapper centrebg" style="background-image: url(<?php echo esc_url( header_image() ) ?>)">
		<?php } else ?>
			<div class="front-panel-empty-wrapper">
				
		<div class="front-panel">
	<?php if ( get_theme_mod( 'petals_blob' ) == 1 && get_theme_mod( 'petals_panel_header' ) == 0 ) : ?> <svg class="front-panel-blob" width="800" height="800" viewBox="0 0 600 600">
  <g transform="translate(300,300)">
    <path d="M133,-198.4C176.2,-179.1,217.7,-148.8,230.1,-108.8C242.4,-68.9,225.6,-19.4,210.2,24.3C194.7,68,180.5,106.1,156.4,137.7C132.3,169.3,98.4,194.5,60.4,205.7C22.4,216.8,-19.8,214,-67.9,209.7C-115.9,205.3,-169.8,199.6,-191.1,169C-212.5,138.3,-201.3,82.8,-204.8,31.9C-208.3,-19,-226.5,-65.4,-213.6,-99.2C-200.8,-133.1,-156.9,-154.5,-116.1,-174.8C-75.3,-195.2,-37.7,-214.6,3.6,-220.2C44.9,-225.8,89.7,-217.6,133,-198.4Z" fill="#FE840E"/>
  </g>
</svg>
	<?php endif; ?>
			<h6 class="small-panel-text"> <?php echo get_theme_mod('petals_small_text', __('Enter your own description here', 'petals') ); ?> </h6>
			<h1 class="top-panel-text"> <?php echo get_theme_mod('petals_top_text', __('Enter your own title here', 'petals') ); ?> </h1>
			<h3 class ="bottom-panel-text"> <?php echo get_theme_mod('petals_bottom_text', __('Enter your own subtitle here', 'petals') ); ?> </h3>
			<?php if ( get_theme_mod( 'petals_panel_button' ) == 1 ) : ?> 
			<a class="panel-button button" href="<?php echo get_theme_mod('petals_panel_buttonlink', __('Enter your own button here', 'petals') ); ?>">
					<?php echo get_theme_mod('petals_panel_buttontext', __('Enter your own button here', 'petals') ); ?>
			</a>
			<?php endif; ?>
			</div>
			<?php if ( get_theme_mod( 'petals_panel_header' ) == 0 ) { ?>
			<img class="custom-header" src="
			<?php header_image(); ?>" width="<?php get_custom_header()->width; ?>" height="<?php get_custom_header()->height; ?>" 
			alt="">
				<?php } ?> <!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->
	<?php if ( get_theme_mod( 'petals_display_promotion' ) == 1 ) : ?>
	<div class="petals-promotion">
		<div class="promotion-image centrebg" style="background-image: url(<?php echo get_theme_mod('petals_promotion_image'); ?>)">
			<div class="promotion-text">
			<h1 class="promotion-title"> <?php echo get_theme_mod('petals_promotion_heading', __('Enter your own title here', 'petals') ); ?> </h1>
			<h3 class ="promotion-subtitle"> <?php echo get_theme_mod('petals_promotion_subtitle', __('Enter your own subtitle here', 'petals') ); ?> </h3>
					<?php if ( get_theme_mod( 'petals_promotion_button' ) == 1 ) : ?> 
			<a class="promotion-button panel-button" href="<?php echo get_theme_mod('petals_promotion_button_link', __('Enter your own button here', 'petals' ) ); ?>">
					<?php echo get_theme_mod('petals_promotion_button_text', __('Enter your own button here', 'petals' ) ); ?>
			</a>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; endif; ?>
	<div id="content" class="site-content">
