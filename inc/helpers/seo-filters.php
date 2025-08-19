<?php
/**
 * SEO Filters – integra campos ACF en meta tags
 */

// Rank Math – descripción
add_filter('rank_math/frontend/description', function($desc) {
  if (function_exists('get_field')) {
    $acf_desc = get_field('seo_meta_description');
    if ($acf_desc) {
      return wp_strip_all_tags($acf_desc);
    }
  }
  return $desc;
}, 10, 1);

// Yoast – descripción
add_filter('wpseo_metadesc', function($desc) {
  if (function_exists('get_field')) {
    $acf_desc = get_field('seo_meta_description');
    if ($acf_desc) {
      return wp_strip_all_tags($acf_desc);
    }
  }
  return $desc;
}, 10, 1);

// Rank Math – título
add_filter('rank_math/frontend/title', function($title) {
  if (function_exists('get_field')) {
    $acf_title = get_field('seo_title');
    if ($acf_title) {
      return wp_strip_all_tags($acf_title);
    }
  }
  return $title;
}, 10, 1);

// Yoast – título
add_filter('wpseo_title', function($title) {
  if (function_exists('get_field')) {
    $acf_title = get_field('seo_title');
    if ($acf_title) {
      return wp_strip_all_tags($acf_title);
    }
  }
  return $title;
}, 10, 1);
