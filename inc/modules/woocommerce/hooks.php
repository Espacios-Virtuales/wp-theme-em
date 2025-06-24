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

// Quitar estilos por defecto si no se usan
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Cambios a productos, checkout, etc.
add_action('woocommerce_before_main_content', function() {
    echo '<section class="wc-container">';
}, 5);
add_action('woocommerce_after_main_content', function() {
    echo '</section>';
}, 50);
