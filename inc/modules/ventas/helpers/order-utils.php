<?php
if (!defined('ABSPATH')) exit;
function ev_get_linked_post_by_product($product_id) {
    $raw_id   = get_post_meta($product_id, 'ev_linked_post_id', true);
    $raw_type = get_post_meta($product_id, 'ev_linked_post_type', true);

    // Normaliza ID (siempre int)
    $post_id = ev_normalize_post_id($raw_id);
    if (!$post_id) return null;

    $post = get_post($post_id);
    if (!$post) return null;

    $post_type = get_post_type($post);

    // Validación si viene type declarado en el producto
    if (!empty($raw_type) && $raw_type !== $post_type) {
        // Si hay mismatch, preferimos NO enviar (evita cruces silenciosos)
        return null;
    }

    // Lista blanca de CPT soportados
    $allowed = ['terapia', 'course', 'program', 'experiencia'];
    if (!in_array($post_type, $allowed, true)) return null;

    return $post;
}