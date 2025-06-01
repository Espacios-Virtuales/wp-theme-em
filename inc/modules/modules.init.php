<?php
/**
 * Inicializador de módulos funcionales: WooCommerce, Calendario, Emails, etc.
 */

$modules_path = __DIR__;

// Calendario
require_once $modules_path . '/calendario/calendar.php';

// WooCommerce
require_once $modules_path . '/woocommerce/hooks.php';
require_once $modules_path . '/woocommerce/products-linker.php';

// Emails
require_once $modules_path . '/emails/emails.php';
require_once $modules_path . '/emails/helpers.php';
