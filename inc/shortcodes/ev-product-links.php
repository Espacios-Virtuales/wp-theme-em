<?php 
function ev_woocommerce_product_links_only() {
    if (!function_exists('wc_get_products')) {
        return '';
    }

    $args = array(
        'limit' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
        'return' => 'ids',
    );

    $products = wc_get_products($args);

    ob_start();
    echo '<ul class="ev-product-links">';
    foreach ($products as $product_id) {
        $product = ev_wc_get_product($product_id);
        if (!$product) {
            continue;
        }
        echo '<li><a href="' . get_permalink($product_id) . '">' . esc_html($product->get_name()) . '</a></li>';
    }
    echo '</ul>';

    return ob_get_clean();
}
add_shortcode('ev-product-links', 'ev_woocommerce_product_links_only');
