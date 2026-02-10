<?php
if (!defined('ABSPATH')) exit;
function ev_handle_experiencia_flow($order, $post) {
    $email = $order->get_billing_email();

    ev_send_email_template('experiencia_ticket', $email, [
        'titulo' => get_the_title($post),
        'fecha'  => get_field('date', $post->ID),
    ]);
}
