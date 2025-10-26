<?php
/**
 * Inicializador de módulos funcionales: WooCommerce, Calendario, Emails, etc.
 */

$modules_path = __DIR__;

// Calendario (no usado aún en este tema)
require_once $modules_path . '/calendario/calendar.php';

// WooCommerce
require_once $modules_path . '/woocommerce/hooks.php';              // Eventos como post-pago
require_once $modules_path . '/woocommerce/filters.php';            // Eventos como post-pago

require_once $modules_path . '/woocommerce/products-linker.php';   // Lógica de relación CPT ↔ productos
require_once $modules_path . '/woocommerce/widgets.php';               


// Emails
require_once $modules_path . '/emails/autoresponder.php';          // Envío de correos centralizado
require_once $modules_path . '/emails/handlers.php';               // Formularios AJAX (contacto, cliente)

