<?php
if (!defined('ABSPATH')) exit;

// Helpers
require_once __DIR__ . '/helpers/order-utils.php';

// Handlers
require_once __DIR__ . '/handlers/terapia.php';
require_once __DIR__ . '/handlers/course.php';
require_once __DIR__ . '/handlers/experiencia.php';
require_once __DIR__ . '/handlers/program.php';


function ev_flow_note($order, $note) {
    if (!$order || !method_exists($order, 'add_order_note')) return;
    $order->add_order_note('[EV-FLOW] ' . $note);
}

add_action('woocommerce_order_status_processing', 'ev_flow_engine_on_order_paid');
add_action('woocommerce_order_status_completed',  'ev_flow_engine_on_order_paid');

function ev_flow_engine_on_order_paid($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;

    $status = $order->get_status();
    ev_flow_log($order_id, 'Engine start', [
        'status' => $status,
        'payment_method' => $order->get_payment_method(),
        'email' => $order->get_billing_email(),
    ]);
    ev_flow_note($order, "Engine start (status={$status})");

    $sent_for_post_ids = [];

    foreach ($order->get_items() as $item_id => $item) {
        $product_id = $item->get_product_id();
        ev_flow_log($order_id, 'Item detected', [
            'item_id' => $item_id,
            'product_id' => $product_id,
            'qty' => $item->get_quantity(),
            'name' => $item->get_name(),
        ]);

        $post = ev_get_linked_post_by_product($product_id);

        if (!$post) {
            ev_flow_log($order_id, 'No linked CPT found', [
                'product_id' => $product_id,
                'ev_linked_post_id' => get_post_meta($product_id, 'ev_linked_post_id', true),
                'ev_linked_post_type' => get_post_meta($product_id, 'ev_linked_post_type', true),
            ]);
            ev_flow_note($order, "Producto {$product_id}: sin CPT vinculado (no se envía correo).");
            continue;
        }

        $post_type = get_post_type($post);
        ev_flow_log($order_id, 'Linked CPT resolved', [
            'product_id' => $product_id,
            'post_id' => $post->ID,
            'post_type' => $post_type,
            'post_title' => get_the_title($post),
        ]);

        if (!empty($sent_for_post_ids[$post->ID])) {
            ev_flow_log($order_id, 'Duplicate CPT skipped', ['post_id' => $post->ID]);
            continue;
        }
        $sent_for_post_ids[$post->ID] = true;

        $handlers = [
            'terapia'     => 'ev_handle_terapia_flow',
            'course'      => 'ev_handle_course_flow',
            'program'     => 'ev_handle_program_flow',
            'experiencia' => 'ev_handle_experiencia_flow',
        ];

        if (empty($handlers[$post_type]) || !is_callable($handlers[$post_type])) {
            ev_flow_log($order_id, 'No handler for post_type', ['post_type' => $post_type]);
            ev_flow_note($order, "CPT {$post_type} ({$post->ID}): sin handler.");
            continue;
        }

        ev_flow_log($order_id, 'Handler dispatch', [
            'handler' => $handlers[$post_type],
            'post_id' => $post->ID,
        ]);
        ev_flow_note($order, "Enviando correo para {$post_type} (post_id={$post->ID})…");

        // Ejecuta handler
        try {
            call_user_func($handlers[$post_type], $order, $post);
            ev_flow_log($order_id, 'Handler success', ['post_type' => $post_type, 'post_id' => $post->ID]);
            ev_flow_note($order, "OK: correo {$post_type} enviado (post_id={$post->ID}).");
        } catch (Throwable $e) {
            ev_flow_log($order_id, 'Handler error', [
                'post_type' => $post_type,
                'post_id' => $post->ID,
                'error' => $e->getMessage(),
            ]);
            ev_flow_note($order, "ERROR enviando {$post_type}: " . $e->getMessage());
        }
    }

    ev_flow_log($order_id, 'Engine end', ['status' => $status]);
    ev_flow_note($order, "Engine end.");
}
