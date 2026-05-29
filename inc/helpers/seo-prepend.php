<?php
/**
 * Append del bloque SEO al final del contenido si está habilitado.
 */
add_filter('the_content', function($content) {
  // Solo en entradas/páginas singulares con ACF activo
  if (!is_singular() || !function_exists('get_field')) {
    return $content;
  }

  /* Si el campo ACF 'seo_enabled' está activo y no se insertó manualmente
  if (ev_get_field('seo_enabled') && strpos($content, '[ev-seo_intro]') === false) {
    $intro = do_shortcode('[ev-seo_intro]');
    // Lo agregamos al final del contenido
    return $content . "\n\n" . $intro;
  } */

  return $content;
}, 999); // prioridad alta → se ejecuta al final
