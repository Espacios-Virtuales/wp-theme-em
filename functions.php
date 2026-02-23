<?php
/**
 * Theme Functions and Definitions
 *
 * Archivo principal de configuración del tema Escuela Mística.
 * Define las funciones globales, soportes del tema, encolado de scripts/estilos
 * y la carga de archivos del núcleo ubicados en `/inc/`.
 *
 * Compatible con WooCommerce, ACF y bloques Gutenberg.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Escuela_Mistica
 * @subpackage Core
 * @since 1.0.0
 *
 * License: GPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * SPDX-License-Identifier: GPL-3.0-or-later
 *
 * © 2025 Espacios Virtuales — Proyecto Escuela Mística
 * Este archivo forma parte del tema Escuela Mística y se distribuye bajo los
 * términos de la GNU General Public License versión 3 o posterior.
 */

 if ( ! defined( '_S_VERSION' ) ) {
    define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blog_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on blog-theme, use a find and replace
		* to change 'blog-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'blog-theme', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'blog-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'blog_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'blog_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blog_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blog_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'blog_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

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
 * Implement inc.
 */
require get_template_directory() . '/inc/init.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



/**
 * Witgets.
*/
function blog_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'blog-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'blog-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'blog_theme_widgets_init' );


// Footer Widget One
function custom_footer_widget_one(){
	$args = array(
		'id' 			=> 'footer-widget-col-one',
		'name'			=> __('Footer Column One', 'text_domain'),
		'description' 	=> __('Column One', 'text_domain'),
		'before_title'	=> '<h3 class="title">',
		'after_title'	=> '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s" >',
		'after_widget'	=> '</div>'																							

	);
	register_sidebar($args);
}
add_action('widgets_init', 'custom_footer_widget_one');


// Footer Widget two
function custom_footer_widget_two(){
	$args = array(
		'id' 			=> 'footer-widget-col-two',
		'name'			=> __('Footer Column Two', 'text_domain'),
		'description' 	=> __('Column Two', 'text_domain'),
		'before_title'	=> '<h3 class="title">',
		'after_title'	=> '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s" >',
		'after_widget'	=> '</div>'																							

	);
	register_sidebar($args);
 }
add_action('widgets_init', 'custom_footer_widget_two');


// Footer Widget three
function custom_footer_widget_three(){
	$args = array(
		'id' 			=> 'footer-widget-col-three',
		'name'			=> __('Footer Column Three', 'text_domain'),
		'description' 	=> __('Column Three', 'text_domain'),
		'before_title'	=> '<h3 class="title">',
		'after_title'	=> '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s" >',
		'after_widget'	=> '</div>'																							

	);
	register_sidebar($args);
}
add_action('widgets_init', 'custom_footer_widget_three');


// Footer Widget two
function custom_footer_widget_four(){
	$args = array(
		'id' 			=> 'footer-widget-col-four',
		'name'			=> __('Footer Column Three', 'text_domain'),
		'description' 	=> __('Column Three', 'text_domain'),
		'before_title'	=> '<h3 class="title">',
		'after_title'	=> '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s" >',
		'after_widget'	=> '</div>'																							

	);
	register_sidebar($args);
}
add_action('widgets_init', 'custom_footer_widget_four');

