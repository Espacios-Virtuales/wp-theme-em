<?php
if (!defined('ABSPATH')) exit;
function ev_handle_terapia_flow($order, $post) {
    $email   = $order->get_billing_email();
    $titulo  = get_the_title($post);
    $calendly = get_post_meta($post->ID, '_calendly_link', true);

    if ($calendly) {
        ev_send_terapia_agenda($email, $titulo, $calendly);
    }
}