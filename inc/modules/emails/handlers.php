<?php 

add_action('wp_ajax_nopriv_handle_contact_form', 'ev_handle_contact_form');
add_action('wp_ajax_handle_contact_form', 'ev_handle_contact_form');

function ev_handle_contact_form() {
    $name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['contact_email']);
    $subscribe = $_POST['contact_subscribe'] ?? 'no';

    if (!is_email($email)) {
        wp_send_json_error('Email inválido');
    }

    $post_id = wp_insert_post([
        'post_type' => 'contacto',
        'post_title' => $name,
        'post_status' => 'publish',
    ]);

    if (!is_wp_error($post_id)) {
        update_post_meta($post_id, '_contact_email', $email);
        update_post_meta($post_id, '_contact_subscribe', $subscribe);

        ev_send_contact_email($email, $subscribe);
        wp_send_json_success('Mensaje recibido');
    }

    wp_send_json_error('Error en el envío');
    wp_die();
}
