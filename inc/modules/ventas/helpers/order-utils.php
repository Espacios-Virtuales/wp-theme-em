<?php
if (!defined('ABSPATH')) exit;
function ev_get_linked_post_by_product($product_id) {
    $context = ev_get_product_flow_context($product_id);

    return !empty($context['is_valid']) ? get_post($context['ev_linked_post_id']) : null;
}
