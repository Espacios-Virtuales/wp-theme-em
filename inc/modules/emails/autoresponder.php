<?php

function ev_send_contact_email($email, $subscribe) {
    ob_start();
    include __DIR__ . '/templates/contacto-email.php';
    $message = ob_get_clean();

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Escuela Mística <info@escuelamistica.cl>',
        'Reply-To: Escuela Mística <info@escuelamistica.cl>'
    ];

    wp_mail($email, '¡Gracias por contactarte con nosotros!', $message, $headers);
}

function ev_get_community_config($community_key) {
    $communities = [
        'alquimia' => [
            'label' => 'Alquimia de Chakras',
            'link' => 'https://chat.whatsapp.com/FVFI9iL2aX3FuyVJyEWlUq?mode=wwt',
            'message' => "Escuela Mística te invita a participar en Alquimia de Chakras.\n\nEste chat tiene el propósito de expandirte conocimiento sobre las conexiones álmicas 🫂💞\n\nUn espacio más íntimo y humano, enfocado en lo emocional, vincular y terapéutico.\n\nAquí compartiremos procesos internos, emociones, relaciones, heridas, transformaciones y cómo los chakras pueden ayudarnos a comprender y alivianar lo que vivimos.",
        ],
        'portal' => [
            'label' => 'Portal Místico',
            'link' => 'https://chat.whatsapp.com/JJv4LPycwWJKYpMkefFyYF',
            'message' => "Escuela Mística te invita a participar en Portal Místico.\n\nEste chat tiene el propósito de expandirte conocimiento sobre los distintos portales energéticos y todo lo que se requiere para estar alineados a esa energía disponible ✨\n\nUn espacio para quienes sienten el llamado de lo espiritual, lo energético y lo esotérico.\n\nAquí exploraremos rituales, portales energéticos, activación del cuerpo astral, símbolos, meditaciones y experiencias de expansión de consciencia.",
        ],
        'orientacion' => [
            'label' => 'Orientación personalizada',
            'link' => '',
            'message' => '',
        ],
    ];

    return $communities[$community_key] ?? null;
}

function ev_send_community_onboarding_email($email, $nombre, $community_key) {
    $community = ev_get_community_config($community_key);

    if (!$community || empty($community['link'])) {
        return false;
    }

    $community_label = $community['label'];
    $community_message = $community['message'];
    $community_link = $community['link'];

    ob_start();
    include __DIR__ . '/templates/community-onboarding-email.php';
    $message = ob_get_clean();

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Escuela Mística <info@escuelamistica.cl>',
        'Reply-To: Escuela Mística <info@escuelamistica.cl>'
    ];

    return wp_mail($email, "Tu acceso a {$community_label} · Escuela Mística", $message, $headers);
}

function ev_send_community_admin_notification($data) {
    $admin_email = apply_filters('ev_community_admin_notification_email', 'info@escuelamistica.cl');
    $community = ev_get_community_config($data['community'] ?? '');
    $community_label = $community['label'] ?? ($data['community'] ?? '');

    ob_start();
    include __DIR__ . '/templates/community-admin-notification.php';
    $message = ob_get_clean();

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Escuela Mística <info@escuelamistica.cl>',
        'Reply-To: Escuela Mística <info@escuelamistica.cl>'
    ];

    return wp_mail($admin_email, 'Nueva solicitud de comunidad · Escuela Mística', $message, $headers);
}

function ev_send_welcome_email($email, $nombre) {
    ob_start();
    include __DIR__ . '/templates/bienvenida-email.php';
    $message = ob_get_clean();

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Escuela Mística <info@escuelamistica.cl>',
        'Reply-To: Escuela Mística <info@escuelamistica.cl>'
    ];

    wp_mail($email, "🎉 ¡Bienvenido a Escuela Mística, $nombre! 🎉", $message, $headers);
}

function ev_send_email_template($template, $email, $subject, $vars = []) {
    extract($vars);

    ob_start();
    include __DIR__ . "/templates/{$template}.php";
    $message = ob_get_clean();

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Escuela Mística <info@escuelamistica.cl>',
        'Reply-To: Escuela Mística <info@escuelamistica.cl>'
    ];

    wp_mail($email, $subject, $message, $headers);
}

// — Terapia 
function ev_send_terapia_agenda($email, $titulo, $link) {
    ev_send_email_template('terapia-agenda', $email, "Tu terapia « $titulo » está lista para agendar ✨", compact('titulo','link'));
}

// — Curso
function ev_send_curso_email($email, $titulo, $instructor) {
    ev_send_email_template('curso-confirmacion', $email, "Confirmación de curso: $titulo", compact('titulo','instructor'));
}

// — Curso grabado
function ev_send_curso_grabado_email($email, $titulo, $url) {
    ev_send_email_template('curso-grabado', $email, "Acceso a tu curso grabado: $titulo", compact('titulo','url'));
}

// — Programa
function ev_send_programa_email($email, $titulo, $externo = null) {
    ev_send_email_template('programa-confirmacion', $email, "Confirmación de programa: $titulo", compact('titulo','externo'));
}

// — Experiencia
function ev_send_experiencia_email($email, $titulo, $fecha) {
    ev_send_email_template('experiencia-ticket', $email, "Entrada confirmada para $titulo", compact('titulo','fecha'));
}
