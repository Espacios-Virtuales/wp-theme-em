<?php

add_action('woocommerce_order_status_completed', 'ev_send_terapia_agenda_email');

function ev_send_terapia_agenda_email($order_id) {
    $order = wc_get_order($order_id);
    $email = $order->get_billing_email();

    foreach ($order->get_items() as $item) {
        $product_id = $item->get_product_id();

        // Buscar terapia vinculada a este producto
        $query = new WP_Query([
            'post_type' => 'terapia',
            'meta_query' => [
                [
                    'key' => '_linked_product_id',
                    'value' => $product_id,
                    'compare' => '='
                ]
            ]
        ]);

        if ($query->have_posts()) {
            $query->the_post();
            $terapia_id = get_the_ID();
            $calendly = get_post_meta($terapia_id, '_calendly_link', true);
            $titulo_terapia = get_the_title($terapia_id);

            if ($calendly) {
                ev_send_agenda_email_template($email, $titulo_terapia, $calendly);
            }

            wp_reset_postdata();
        }
    }
}

function ev_render_productos($cat) {
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


// Usar nuestro template para la URL de la tienda real (is_shop)
add_filter('template_include', function ($template) {
  if (is_shop()) {
    $custom = get_stylesheet_directory() . '/page-landing-modular.php';
    if (file_exists($custom)) {
      return $custom; // usamos nuestro template en la misma ruta
    }
  }
  return $template;
}, 99);

add_action('template_redirect', function () {
  if (is_shop()) {
      // Evita que WooCommerce cargue su loop de productos
      remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
      remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
      remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
      remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
      remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
      remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
      remove_action('woocommerce_after_main_content', 'woocommerce_output_related_products', 20);
  }
});
