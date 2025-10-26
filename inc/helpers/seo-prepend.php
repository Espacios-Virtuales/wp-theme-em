<?php
/**
 * Prepend del bloque SEO al principio del contenido si está habilitado.
 */
add_filter('the_content', function($content){
  if (!is_singular()) return $content;
  if (!function_exists('get_field')) return $content;

  // Solo si está activo y aún no se insertó manualmente
  if (get_field('seo_enabled') && strpos($content, '[ev-seo_intro]') === false) {
    $intro = do_shortcode('[ev-seo_intro]');
    // Lo anteponemos
    return $intro . "\n\n" . $content;
  }
  return $content;
}, 5); // prioridad baja para ir primero
