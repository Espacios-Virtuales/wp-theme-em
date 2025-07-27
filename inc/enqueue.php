<?php

/**
 * Register and enqueue styles and scripts.
 */
function blog_theme_scripts() {
    wp_enqueue_style( 'blog-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'blog-theme-main', get_template_directory_uri(). '/assets/scss/main.css', array(), _S_VERSION );

    wp_style_add_data( 'blog-theme-style', 'rtl', 'replace' );
    wp_enqueue_style( 'bootstrap-icon', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css', array(), '1.10.5' );

	// CSS de Lightbox minificado
    wp_enqueue_style('lightbox-css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css', array(), '2.11.3');

	// AOS CSS
	wp_enqueue_style('aos-css', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css', array(), '2.3.4');

    // Encolar jQuery correctamente (viene con WordPress)
    wp_enqueue_script('jquery');
    
    // Encolar Popper y Bootstrap JS después de jQuery
    wp_enqueue_script( 'bootstrap-popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery'), '2.9.2', true);
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', array('jquery'), '5.0.2', true );

    // Script personalizado que depende de jQuery
    wp_enqueue_script('ev-app', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), _S_VERSION, true);

    // Localizar la variable ajax_object después de registrar el script
    wp_localize_script( 'ev-app', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	// Forms
	wp_enqueue_script('forms-script', get_template_directory_uri() . '/assets/js/forms.js', array('jquery'), _S_VERSION, true);
	wp_localize_script('forms-script', 'formData', array(
		'jsonUrl' => get_template_directory_uri() . '/assets/data/chile-regiones.json',
	));

	// Anime
	wp_enqueue_script('anime', 'https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js', array('jquery'), '2.0.2', true);

	// JS de Lightbox minificado
    wp_enqueue_script('lightbox-js', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array('jquery'), '2.11.3', true);

	// AOS CSS
	wp_enqueue_script('aos-js', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js', array('jquery'), '2.3.4', true);
}
add_action( 'wp_enqueue_scripts', 'blog_theme_scripts' );


add_filter('script_loader_tag', function($tag, $handle) {
    if ($handle === 'ev-app') {
        return str_replace('<script ', '<script type="module" ', $tag);
    }
    return $tag;
}, 10, 2);


// Admin Enque
function enqueue_admin_bootstrap() {
    wp_enqueue_style('cpt-style', plugin_dir_url(__FILE__) . 'assets/css/admin/style.css', array(), '1.0.0');
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'enqueue_admin_bootstrap');


/**
 * Custom Fonts.
 */

function enqueue_custom_fonts(){
	if (!is_admin()) {
		// Registrar las nuevas fuentes relacionadas con la identidad
		wp_register_style('custom-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap');
	
		// Encolar las nuevas fuentes
		wp_enqueue_style('custom-fonts');
	}	
}

add_action( 'wp_enqueue_scripts', 'enqueue_custom_fonts' );