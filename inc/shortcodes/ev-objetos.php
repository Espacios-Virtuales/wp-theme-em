<?php

/**
 * Shortcode: [ev-objetos tipo="terapia"]
 *
 * Flujo actualizado:
 * Catálogo → Card → Landing CPT
 *
 * El shortcode NO abre modal.
 * El botón deriva directamente al single del CPT correspondiente.
 */
function ev_objetos_shortcode($atts)
{
  $atts = shortcode_atts([
    'tipo'      => 'terapia',
    'cantidad'  => -1,
    'cta_text'  => 'Ver más',
  ], $atts, 'ev-objetos');

  $tipo = sanitize_key($atts['tipo']);

  $query = blog_get_custom_post_type($tipo, intval($atts['cantidad']));

  ob_start();

  if ($query && $query->have_posts()) :
?>
    <div class="ev-objetos-grid" id="<?php echo esc_attr($tipo); ?>">
      <?php while ($query->have_posts()) : $query->the_post(); ?>
        <?php
        $post_id = get_the_ID();

        $titulo  = get_the_title($post_id);
        $imagen  = get_the_post_thumbnail($post_id, 'medium');
        $cpt_url = get_permalink($post_id);

        $cta_text = trim($atts['cta_text']);
        if (empty($cta_text)) {
          $cta_text = 'Ver más';
        }
        ?>

        <div class="ev-objeto-card">
          <?php if (!empty($imagen)) : ?>
            <a href="<?php echo esc_url($cpt_url); ?>" class="ev-objeto-card__image-link" aria-label="<?php echo esc_attr('Ver ' . $titulo); ?>">
              <?php echo $imagen; ?>
            </a>
          <?php endif; ?>

          <h3><?php echo esc_html($titulo); ?></h3>

          <?php if (!empty($cpt_url)) : ?>
            <a href="<?php echo esc_url($cpt_url); ?>" class="ev-open-modal ev-objeto-card__link">
              <?php echo esc_html($cta_text); ?>
            </a>
          <?php else : ?>
            <span class="ev-cta-unavailable">
              Disponible pronto
            </span>
          <?php endif; ?>
        </div>

      <?php endwhile; ?>
    </div>
<?php
  else :
?>
    <p class="text-muted text-center">
      No se encontraron contenidos disponibles.
    </p>
<?php
  endif;

  wp_reset_postdata();

  return ob_get_clean();
}

add_shortcode('ev-objetos', 'ev_objetos_shortcode');