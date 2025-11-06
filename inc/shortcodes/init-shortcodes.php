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
require_once __DIR__ . '/ev-calendar.php';

// 💬 Testimonios
require_once __DIR__ . '/ev-testimonials.php';

// 🧩 Componentes compartidos (modales, video, etc.)
require_once __DIR__ . '/ev-objetos.php';
require_once __DIR__ . '/ev-menu_botones.php';
require_once __DIR__ . '/ev-seo-intro.php';

// 🧩Tienda
require_once __DIR__ . '/ev-product-links.php';