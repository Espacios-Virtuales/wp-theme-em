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

function ev_send_agenda_email_template($email, $titulo, $link) {
    ob_start();
    include __DIR__ . '/templates/terapia-agenda.php';
    $message = ob_get_clean();

    $subject = "Tu terapia «$titulo» está lista para agendar ✨";
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: Escuela Mística <info@escuelamistica.cl>'
    ];

    wp_mail($email, $subject, $message, $headers);
}
