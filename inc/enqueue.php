<?php
// Recomendado: define la versión del tema para cache-busting controlado.
if ( ! defined('_S_VERSION') ) {
    define('_S_VERSION', '1.0.0');
}

/**
 * FRONT: estilos y scripts públicos
 */
function ev_front_assets() {
    $theme_dir     = get_template_directory_uri();
    $theme_path    = get_template_directory();
    $main_css_path = $theme_path . '/assets/css/main.css';
    $main_css_ver  = file_exists($main_css_path) ? filemtime($main_css_path) : _S_VERSION;

    // CSS base del tema + main.css
    wp_enqueue_style('ev-style', get_stylesheet_uri(), [], _S_VERSION);
    wp_style_add_data('ev-style', 'rtl', 'replace');

    wp_enqueue_style('ev-main', $theme_dir . '/assets/css/main.css', [], $main_css_ver);

    // Iconos / librerías solo front
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css', [], '1.10.5');
    wp_enqueue_style('lightbox-css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css', [], '2.11.3');
    wp_enqueue_style('aos-css', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css', [], '2.3.4');

    // Fuentes (solo front)
    wp_enqueue_style(
        'ev-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap',
        [],
        null
    );

    // jQuery del core
    wp_enqueue_script('jquery');

    // JS: Popper + Bootstrap 5 (mantén versión consistente)
    wp_enqueue_script('ev-popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', ['jquery'], '2.9.2', true);
    wp_enqueue_script('ev-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', ['jquery', 'ev-popper'], '5.0.2', true);

    // App + datos
    wp_enqueue_script('ev-app', $theme_dir . '/assets/js/app.js', ['jquery'], _S_VERSION, true);
    wp_localize_script('ev-app', 'ajax_object', ['ajax_url' => admin_url('admin-ajax.php')]);

    // Forms
    wp_enqueue_script('ev-forms', $theme_dir . '/assets/js/forms.js', ['jquery'], _S_VERSION, true);
    wp_localize_script('ev-forms', 'formData', [
        'jsonUrl' => $theme_dir . '/assets/data/chile-regiones.json',
    ]);

    // Librerías front
    wp_enqueue_script('anime', 'https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js', ['jquery'], '2.0.2', true);
    wp_enqueue_script('lightbox-js', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', ['jquery'], '2.11.3', true);
    wp_enqueue_script('aos-js', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js', ['jquery'], '2.3.4', true);
}
add_action('wp_enqueue_scripts', 'ev_front_assets');

// Solo convertir ev-app a type="module"
add_filter('script_loader_tag', function($tag, $handle) {
    return ($handle === 'ev-app')
        ? str_replace('<script ', '<script type="module" ', $tag)
        : $tag;
}, 10, 2);


/**
 * ADMIN: cargar el mismo main.css para “igualar” estilos, sin inyectar Bootstrap.
 * Si necesitas estilos propios de admin, centralízalos en assets/css/admin/style.css
 */
function ev_admin_assets($hook) {
    $theme_dir     = get_template_directory_uri();
    $theme_path    = get_template_directory();
    $main_css_path = $theme_path . '/assets/css/main.css';
    $main_css_ver  = file_exists($main_css_path) ? filemtime($main_css_path) : _S_VERSION;

    // 1) Estilos de admin del proyecto (scoped a .ev-admin)
    wp_enqueue_style('ev-admin-style', $theme_dir . '/assets/css/admin/style.css', [], _S_VERSION);

    // 2) El mismo main.css del front (usa nombres de clases “seguros” para no pisar WP)
    wp_enqueue_style('ev-admin-main', $theme_dir . '/assets/css/main.css', [], $main_css_ver);

    // Importante: NO cargar Bootstrap en admin para evitar conflictos con WP.
    // Si algún plugin trajo Bootstrap al admin, intenta dequeues comunes:
    wp_dequeue_style('bootstrap');       // handle genérico usado por algunos plugins
    wp_dequeue_style('bootstrap-css');
    wp_dequeue_script('bootstrap');
    wp_dequeue_script('bootstrap-js');

    // Si alguna pantalla propia requiere Bootstrap, hazlo condicional:
    // if ( $hook === 'toplevel_page_ev-panel' ) {
    //     wp_enqueue_script('ev-admin-popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', [], '2.9.2', true);
    //     wp_enqueue_script('ev-admin-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', ['ev-admin-popper'], '5.0.2', true);
    // }
}
add_action('admin_enqueue_scripts', 'ev_admin_assets', 20);

/**
 * (Opcional) Defensa extra en el FRONT por si algún plugin carga Bootstrap CSS
 * y te rompe estilos: intenta remover handles típicos.
 */
add_action('wp_enqueue_scripts', function () {
    foreach (wp_styles()->queue as $handle) {
        $src = wp_styles()->registered[$handle]->src ?? '';
        if (strpos($src, 'bootstrap') !== false) {
            wp_dequeue_style($handle);
            wp_deregister_style($handle);
        }
    }
}, 100);