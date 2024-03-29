<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Petals
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function petals_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	
	// Adds a class of single when we desire the single layout.
	if ( ! is_front_page() && ! is_home() ) {
		$classes[] = 'single';
	}
	
	// Adds a class of featured-image when there is a featured image. 
	if ( has_post_thumbnail() && ( ! function_exists( 'jetpack_featured_images_remove_post_thumbnail' ) || petals_jetpack_featured_image_display() ) ) {
		$classes[] = 'featured-image';
	}
	
	// Adds a class of bold-header if alternative design is selected in Customizer.
	if ( get_theme_mod( 'petals_panel_header' ) == 1 ) {
		$classes[] = 'bold-header';
	}
	
	return $classes;
}
add_filter( 'body_class', 'petals_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function petals_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'petals_pingback_header' );
