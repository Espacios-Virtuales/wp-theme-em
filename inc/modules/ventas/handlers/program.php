<?php
if (!defined('ABSPATH')) exit;

function ev_handle_program_flow($order, $post) {
    $email       = $order->get_billing_email();
    $titulo      = get_the_title($post);
    $externo     = get_post_meta($post->ID, 'course_payment_url', true);

    ev_send_email_template(
        'programa-confirmacion',
        $email,
        "Confirmación de programa: $titulo",
        compact('titulo', 'externo')
    );
}
