<?php
/**
 * Registro de todos los shortcodes
 * Estructura modular
 */

// 🏠 Página de inicio
require_once __DIR__ . '/ev-home.php';

// 👤 Página sobre nosotros/mí
require_once __DIR__ . '/ev-about.php';

// 🌱 Comunidad y membresía
require_once __DIR__ . '/ev-community.php';

// ✨ Servicios
require_once __DIR__ . '/ev-services.php';

// 💌 Contacto
require_once __DIR__ . '/ev-contact.php';

// 📅 Eventos
require_once __DIR__ . '/ev-events.php';

// 💬 Testimonios
require_once __DIR__ . '/ev-testimonios.php';

// 🧩 Componentes compartidos (modales, video, etc.)
require_once __DIR__ . '/shortcodes/ev-objetos.php';
