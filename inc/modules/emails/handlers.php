<?php 

add_action('wp_ajax_nopriv_handle_contact_form', 'ev_handle_contact_form');
add_action('wp_ajax_handle_contact_form', 'ev_handle_contact_form');
add_action('wp_ajax_nopriv_handle_community_onboarding', 'ev_handle_community_onboarding');
add_action('wp_ajax_handle_community_onboarding', 'ev_handle_community_onboarding');

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

function ev_handle_community_onboarding() {
    if (
        empty($_POST['community_nonce']) ||
        ! wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['community_nonce'])), 'ev_community_onboarding')
    ) {
        wp_send_json_error('No fue posible enviar el formulario.');
    }

    $honeypot = isset($_POST['community_website']) ? trim((string) wp_unslash($_POST['community_website'])) : '';
    if ($honeypot !== '') {
        wp_send_json_error('No fue posible enviar el formulario.');
    }

    $name = isset($_POST['community_name']) ? sanitize_text_field(wp_unslash($_POST['community_name'])) : '';
    $email = isset($_POST['community_email']) ? sanitize_email(wp_unslash($_POST['community_email'])) : '';
    $whatsapp = isset($_POST['community_whatsapp']) ? sanitize_text_field(wp_unslash($_POST['community_whatsapp'])) : '';
    $community = isset($_POST['community_interest']) ? sanitize_key(wp_unslash($_POST['community_interest'])) : '';
    $intention = isset($_POST['community_intention']) ? sanitize_textarea_field(wp_unslash($_POST['community_intention'])) : '';
    $origin = isset($_POST['community_origin']) ? sanitize_text_field(wp_unslash($_POST['community_origin'])) : '';
    $consent = isset($_POST['community_consent']) ? sanitize_text_field(wp_unslash($_POST['community_consent'])) : '';

    if ($name === '' || $whatsapp === '') {
        wp_send_json_error('No fue posible enviar el formulario.');
    }

    if (! is_email($email)) {
        wp_send_json_error('Email inválido.');
    }

    if (! in_array($community, ['alquimia', 'portal', 'orientacion'], true)) {
        wp_send_json_error('Debes seleccionar una comunidad.');
    }

    if ($consent !== 'yes') {
        wp_send_json_error('Debes aceptar recibir la información.');
    }

    $post_id = wp_insert_post([
        'post_type' => 'contacto',
        'post_title' => $name,
        'post_status' => 'publish',
    ]);

    if (is_wp_error($post_id) || ! $post_id) {
        wp_send_json_error('No fue posible enviar el formulario.');
    }

    update_post_meta($post_id, '_contact_name', $name);
    update_post_meta($post_id, '_contact_email', $email);
    update_post_meta($post_id, '_contact_whatsapp', $whatsapp);
    update_post_meta($post_id, '_contact_community', $community);
    update_post_meta($post_id, '_contact_intention', $intention);
    update_post_meta($post_id, '_contact_origin', $origin);
    update_post_meta($post_id, '_contact_consent', $consent);
    update_post_meta($post_id, '_contact_type', 'community_onboarding');
    update_post_meta($post_id, '_contact_subscribe', 'yes');
    update_post_meta($post_id, '_contact_message', $intention);

    $notification_data = [
        'name' => $name,
        'email' => $email,
        'whatsapp' => $whatsapp,
        'community' => $community,
        'intention' => $intention,
        'origin' => $origin,
        'date' => current_time('d/m/Y H:i'),
    ];

    if ($community !== 'orientacion') {
        ev_send_community_onboarding_email($email, $name, $community);
    }

    ev_send_community_admin_notification($notification_data);

    $message = ($community === 'orientacion')
        ? 'Gracias, tu respuesta fue recibida. Maureen revisará tu intención y podrá orientarte hacia la comunidad más adecuada.'
        : 'Gracias, tu inscripción fue recibida. Te enviamos al correo el enlace para ingresar a la comunidad elegida.';

    wp_send_json_success($message);
}
