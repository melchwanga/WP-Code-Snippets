<?php
/**
 * Premese Schools functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Premese_Schools
 */

/**
 * Antarc Kenya functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Antarc_Kenya
 */

if ( ! function_exists( 'antarc_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function antarc_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Antarc Kenya, use a find and replace
		 * to change 'antarc' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'antarc', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'antarc' ),
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
		add_theme_support( 'custom-background', apply_filters( 'antarc_custom_background_args', array(
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
add_action( 'after_setup_theme', 'antarc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function antarc_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'antarc_content_width', 640 );
}
add_action( 'after_setup_theme', 'antarc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function antarc_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'antarc' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'antarc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'antarc_widgets_init' );

if( !function_exists('antarc_scripts') ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function antarc_scripts() {
		$theme_uri = get_template_directory_uri();
		$theme_ver = '1.0';
		//landing scripts	
		wp_enqueue_style( 'antarc-reset', $theme_uri.'/css/reset.css' );
		wp_enqueue_style( 'antarc-fonts-nobel', $theme_uri.'/fonts/nobel/stylesheet.css' );
		wp_enqueue_style( 'antarc-preloader', $theme_uri.'/css/jpreloader.css' );
		wp_enqueue_style( 'antarc-sliderPro', $theme_uri.'/css/slider-pro.css' );
		wp_enqueue_style( 'antarc-main', $theme_uri.'/css/main.css' );
		wp_enqueue_style( 'antarc-style', get_stylesheet_uri() );

		//landing JS
		wp_enqueue_script( 'antarc-browser', $theme_uri . '/js/browserselector.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-jquery', $theme_uri . '/js/jquery-1.11.3.min.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-j-validate', $theme_uri . '/js/jquery.validate.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-jqueriSliderPro', $theme_uri . '/js/jquery.sliderPro.min.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-jpreloader', $theme_uri . '/js/jpreloader.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-jsdir', $theme_uri . '/js/jquery.sidr.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-images-loaded', $theme_uri . '/js/imagesloaded.pkgd.min.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-isotope', $theme_uri . '/js/isotope.pkgd.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-packery-mode', $theme_uri . '/js/packery-mode.pkgd.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-jnavgoko', $theme_uri . '/js/jquery.navgoco.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-owl-carousel', $theme_uri . '/js/owl.carousel.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-tweenmax', $theme_uri . '/js/greensock/TweenMax.min.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-superScroll', $theme_uri . '/js/jquery.superscrollorama.js', array(), $theme_ver, true );
		wp_enqueue_script( 'antarc-scrollBar', $theme_uri . '/js/jquery.scrollbar.js', array(), $theme_ver, true );
	    wp_enqueue_script( 'antarc-waypoints', $theme_uri . '/js/waypoints.js', array(), $theme_ver, true );
	    wp_enqueue_script( 'antarc-j-sliderPro', $theme_uri . '/js/jquery.sliderPro.js', array(), $theme_ver, true );
	    wp_enqueue_script( 'antarc-jvetomap2', $theme_uri . '/js/jquery-jvectormap-2.0.3.min.js', array(), $theme_ver, true );
	    wp_enqueue_script( 'antarc-jvectormap-africa', $theme_uri . '/js/jquery-jvectormap-africa-mill.js', array(), $theme_ver, true );
	    wp_enqueue_script( 'antarc-jvectormap-worls', $theme_uri . '/js/jquery-jvectormap-worls-mill.js', array(), $theme_ver, true );
	    wp_enqueue_script( 'antarc-functions', $theme_uri . '/js/functions.js', array(), $theme_ver, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'antarc_scripts' );

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

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
