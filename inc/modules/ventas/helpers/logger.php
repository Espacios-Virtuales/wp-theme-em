<?php
if (!defined('ABSPATH')) exit;

function ev_flow_log($order_id, $message, $context = []) {
    if (!function_exists('wc_get_logger')) return;

    $logger = wc_get_logger();
    $prefix = '[EV-FLOW] ';
    $logger->info($prefix . $message . ' | ' . wp_json_encode($context), [
        'source' => 'ev-flow',
    ]);
}
