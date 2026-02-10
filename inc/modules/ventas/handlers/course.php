<?php
if (!defined('ABSPATH')) exit;

function ev_handle_course_flow($order, $post) {
    $email = $order->get_billing_email();

    ev_send_email_template('curso_en_vivo', $email, [
        'titulo'     => get_the_title($post),
        'instructor' => get_post_meta($post->ID, 'course_instructor', true),
    ]);
}