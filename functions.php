<?php
/**
 * Petals functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Petals
 */

if ( ! function_exists( 'petals_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function petals_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Petals, use a find and replace
		 * to change 'petals' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'petals', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		
		/*
		 * Enable support for full and wide content.
		 */
		add_theme_support( 'align-wide' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'petals' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'petals_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'petals_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function petals_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'petals_content_width', 640 );
}
add_action( 'after_setup_theme', 'petals_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function petals_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'petals' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'petals' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'petals' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Displayed at the bottom of the screen.', 'petals' ),
		'before_widget' => '<section id="%1$s" class="%2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
}
add_action( 'widgets_init', 'petals_widgets_init' );

/**
 * Check for custom colours that the theme should be aware of 
 */

function petals_custom_colours() {
	?>
		<style type="text/css">
			
			#masthead {
				background-color: <?php echo get_theme_mod( 'petals_panel_colour' ); ?>;
			}
			
			.front-panel-blob path {
				fill: <?php echo get_theme_mod( 'petals_blob_colour' ); ?>;
			}
			
			.custom-header,
			.bold-header .front-panel-wrapper {
				margin-bottom: 20px;
				margin-bottom: <?php echo get_theme_mod( 'petals_promotion_spacing' ); ?>px;
			}
			
			.panel-button {
				background-color: #c74359;
				background-color: <?php echo get_theme_mod( 'petals_button_colour' ); ?>;
			}
			
			a {
				color: #EF6079FF;
				color: <?php echo get_theme_mod( 'petals_link_colour' ); ?>;
			}
			
		    .sticky {
				border-left: '4px solid <?php echo get_theme_mod( 'petals_link_colour' ); ?>';
			}
			
			button {
				background-color: <?php echo get_theme_mod( 'petals_button_bgcolour' ); ?>;
			}
			
		</style>
	<?php
}
add_action( 'wp_head', 'petals_custom_colours' );

/**
 * Enqueue scripts and styles.
 */
function petals_scripts() {
	wp_enqueue_style( 'petals-style', get_stylesheet_uri() );

	wp_enqueue_script( 'petals-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'petals-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	wp_enqueue_style( 'petals-fonts', '//fonts.googleapis.com/css?family=Hind|Montserrat');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'petals_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
