<?php

function ev_render_productos($cat) {
    if (!function_exists('wc_get_template_part')) {
      return '<p>No hay productos disponibles.</p>';
    }

    $args = [
      'post_type' => 'product',
      'posts_per_page' => -1,
    ];
  
    if ($cat !== 'all') {
      $args['tax_query'] = [[
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => $cat,
      ]];
    }
  
    $query = new WP_Query($args);
    ob_start();
  
    if ($query->have_posts()) {
      echo '<ul class="products">';
      while ($query->have_posts()) {
        $query->the_post();
        wc_get_template_part('content', 'product');
      }
      echo '</ul>';
    } else {
      echo '<p>No hay productos disponibles.</p>';
    }
  
    wp_reset_postdata();
    return ob_get_clean();
  }
  
  add_action('wp_ajax_filtrar_productos', 'ev_filtrar_productos_ajax');
  add_action('wp_ajax_nopriv_filtrar_productos', 'ev_filtrar_productos_ajax');
  function ev_filtrar_productos_ajax() {
    $cat = sanitize_text_field($_GET['categoria'] ?? 'all');
    echo ev_render_productos($cat);
    wp_die();
}
  

// Quitar estilos por defecto si no se usan
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Cambios a productos, checkout, etc.
add_action('woocommerce_before_main_content', function() {
    echo '<section class="wc-container">';
}, 5);
add_action('woocommerce_after_main_content', function() {
    echo '</section>';
}, 50);


// Forzar template personalizado en /tienda
add_filter('template_include', function ($template) {
  if (ev_is_shop()) {
    $custom = get_stylesheet_directory() . '/templates/page-landing-modular.php';
    if (file_exists($custom)) return $custom;
  }
  return $template;
}, 99);

// Bloquea contenido automático de WooCommerce
add_filter('the_content', function ($content) {
  if (ev_is_shop() && is_main_query()) {
    return ''; // Previene que Woo agregue su loop
  }
  return $content;
}, 1);
