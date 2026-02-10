<?php
if (!defined('ABSPATH')) exit;
function ev_handle_program_flow($order, $post) {
    $email = $order->get_billing_email();

    ev_send_email_template('programa_confirmacion', $email, [
        'titulo'       => get_the_title($post),
        'pago_externo' => get_post_meta($post->ID, 'course_payment_url', true),
    ]);
}