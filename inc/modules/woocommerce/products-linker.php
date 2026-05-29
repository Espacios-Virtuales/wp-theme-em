<?php
if (!defined('ABSPATH')) exit;

/**
 * Central read-only contract for WooCommerce product flow metadata.
 */

function ev_normalize_flow_post_id($raw_id) {
    if (empty($raw_id)) {
        return 0;
    }

    if ($raw_id instanceof WP_Post) {
        return (int) $raw_id->ID;
    }

    if (is_array($raw_id)) {
        if (!empty($raw_id['ID'])) {
            return (int) $raw_id['ID'];
        }

        $first = reset($raw_id);
        if ($first instanceof WP_Post) {
            return (int) $first->ID;
        }

        return is_numeric($first) ? (int) $first : 0;
    }

    return is_numeric($raw_id) ? (int) $raw_id : 0;
}

function ev_supported_flow_post_types() {
    return ['terapia', 'course', 'program', 'experiencia'];
}

function ev_get_product_flow_context($product_id) {
    $product_id = absint($product_id);
    $product = $product_id ? get_post($product_id) : null;
    $product_post_type = $product ? get_post_type($product) : '';

    $raw_linked_post_id = $product_id ? get_post_meta($product_id, 'ev_linked_post_id', true) : '';
    $linked_post_id = ev_normalize_flow_post_id($raw_linked_post_id);
    $linked_post = $linked_post_id ? get_post($linked_post_id) : null;

    $raw_linked_post_type = $product_id ? get_post_meta($product_id, 'ev_linked_post_type', true) : '';
    $linked_post_type = sanitize_key((string) $raw_linked_post_type);
    $actual_linked_post_type = $linked_post ? get_post_type($linked_post) : '';

    if ($linked_post && $linked_post_type === '') {
        $linked_post_type = $actual_linked_post_type;
    }

    $type_matches = $linked_post
        && ($raw_linked_post_type === '' || $linked_post_type === $actual_linked_post_type);

    $is_supported_type = $linked_post_type !== ''
        && in_array($linked_post_type, ev_supported_flow_post_types(), true);

    return [
        'product_id'              => $product_id,
        'product_exists'          => (bool) $product,
        'product_post_type'       => $product_post_type ?: '',
        'product_title'           => $product ? get_the_title($product) : '',
        'ev_linked_post_id'       => $linked_post_id,
        'ev_linked_post_type'     => $linked_post_type,
        'ev_flow_type'            => sanitize_key((string) ($product_id ? get_post_meta($product_id, 'ev_flow_type', true) : '')),
        'ev_access_type'          => sanitize_key((string) ($product_id ? get_post_meta($product_id, 'ev_access_type', true) : '')),
        'linked_post_exists'      => (bool) $linked_post,
        'linked_post_title'       => $linked_post ? get_the_title($linked_post) : '',
        'linked_post_status'      => $linked_post ? get_post_status($linked_post) : '',
        'actual_linked_post_type' => $actual_linked_post_type ?: '',
        'type_matches'            => (bool) $type_matches,
        'is_supported_type'       => (bool) $is_supported_type,
        'is_valid'                => (bool) ($product && $product_post_type === 'product' && $linked_post && $type_matches && $is_supported_type),
    ];
}

function ev_get_order_flow_context($order_id) {
    $order_id = absint($order_id);

    $context = [
        'order_id'     => $order_id,
        'order_exists' => false,
        'products'     => [],
    ];

    if (!function_exists('wc_get_order')) {
        return $context;
    }

    $order = $order_id ? wc_get_order($order_id) : false;
    if (!$order) {
        return $context;
    }

    $context['order_exists'] = true;

    foreach ($order->get_items() as $item_id => $item) {
        if (!is_object($item) || !method_exists($item, 'get_product_id')) {
            continue;
        }

        $product_id = absint($item->get_product_id());
        $context['products'][] = [
            'order_item_id' => (int) $item_id,
            'product_id'    => $product_id,
            'variation_id'  => method_exists($item, 'get_variation_id') ? absint($item->get_variation_id()) : 0,
            'quantity'      => method_exists($item, 'get_quantity') ? (int) $item->get_quantity() : 0,
            'name'          => method_exists($item, 'get_name') ? (string) $item->get_name() : '',
            'flow_context'  => ev_get_product_flow_context($product_id),
        ];
    }

    return $context;
}
