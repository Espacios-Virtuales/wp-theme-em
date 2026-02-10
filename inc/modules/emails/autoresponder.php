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
