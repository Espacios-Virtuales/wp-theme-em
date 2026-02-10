<?php
if (!defined('ABSPATH')) exit;

// Helpers
require_once __DIR__ . '/helpers/order-utils.php';

// Handlers
require_once __DIR__ . '/handlers/terapia.php';
require_once __DIR__ . '/handlers/course.php';
require_once __DIR__ . '/handlers/experiencia.php';
require_once __DIR__ . '/handlers/program.php';

add_action('woocommerce_order_status_completed', 'ev_flow_engine_on_order_paid');

function ev_flow_engine_on_order_paid($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;

    $handlers = [
        'terapia'     => 'ev_handle_terapia_flow',
        'course'      => 'ev_handle_course_flow',
        'program'     => 'ev_handle_program_flow',
        'experiencia' => 'ev_handle_experiencia_flow',
    ];

    $sent_for_post_ids = [];

    foreach ($order->get_items() as $item) {
        $product_id = $item->get_product_id();
        if (!$product_id) continue;

        $post = ev_get_linked_post_by_product($product_id);
        if (!$post) continue;

        if (!empty($sent_for_post_ids[$post->ID])) continue;
        $sent_for_post_ids[$post->ID] = true;

        $post_type = get_post_type($post);
        if (empty($handlers[$post_type])) continue;

        $fn = $handlers[$post_type];
        if (is_callable($fn)) {
            $fn($order, $post);
        }
    }
}
