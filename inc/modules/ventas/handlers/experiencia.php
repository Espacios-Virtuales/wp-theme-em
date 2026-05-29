<?php
if (!defined('ABSPATH')) exit;

function ev_handle_experiencia_flow($order, $post) {
    $email  = $order->get_billing_email();
    $titulo = get_the_title($post);
    $fecha  = ev_get_field('date', $post->ID);

    ev_send_email_template(
        'experiencia-ticket',
        $email,
        "Entrada confirmada para $titulo",
        compact('titulo', 'fecha')
    );
}
