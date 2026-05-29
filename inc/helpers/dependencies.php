<?php
/**
 * Safe wrappers for optional plugin dependencies.
 */

function ev_get_field($selector, $post_id = false, $format_value = true, $default = null) {
    if (!function_exists('get_field')) {
        return $default;
    }

    $value = get_field($selector, $post_id, $format_value);

    return $value === null ? $default : $value;
}

function ev_has_woocommerce() {
    return class_exists('WooCommerce') && function_exists('WC');
}

function ev_is_checkout() {
    return function_exists('is_checkout') && is_checkout();
}

function ev_is_shop() {
    return function_exists('is_shop') && is_shop();
}

function ev_wc_cart() {
    if (!ev_has_woocommerce()) {
        return null;
    }

    $wc = WC();

    return $wc && isset($wc->cart) ? $wc->cart : null;
}

function ev_wc_get_product($product_id) {
    if (!function_exists('wc_get_product')) {
        return false;
    }

    return wc_get_product($product_id);
}
