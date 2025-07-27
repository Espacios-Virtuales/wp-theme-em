<?php
function ev_menu_botones_shortcode($atts) {
    $atts = shortcode_atts([
        'menu' => '',         // Nombre o slug del menú
        'class' => 'ev-botonera-footer' // Clase envolvente
    ], $atts, 'ev-menu_botones');

    // Obtiene el menú
    $locations = get_nav_menu_locations();
    $menu_obj = wp_get_nav_menu_object($atts['menu']) ?: null;

    if (!$menu_obj) return '<!-- Menú no encontrado -->';

    $items = wp_get_nav_menu_items($menu_obj->term_id);
    if (!$items) return '';

    ob_start();
    echo '<div class="' . esc_attr($atts['class']) . '">';
    foreach ($items as $item) {
        echo '<a class="ev-boton-footer" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
    }
    echo '</div>';
    return ob_get_clean();
}
add_shortcode('ev-menu_botones', 'ev_menu_botones_shortcode');
