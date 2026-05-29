<?php
/**
 * ACF Local JSON configuration.
 *
 * Keeps field group structure versioned with the theme without defining fields
 * manually in PHP.
 */

function ev_acf_json_path() {
    return get_stylesheet_directory() . '/acf-json';
}

add_filter('acf/settings/save_json', function() {
    return ev_acf_json_path();
});

add_filter('acf/settings/load_json', function($paths) {
    $paths[] = ev_acf_json_path();

    return $paths;
});
