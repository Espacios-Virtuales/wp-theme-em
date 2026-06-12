<?php
/**
 * Shortcode: [ev-objetos tipo="terapia"]
 *
 * Flujo actualizado:
 * Catálogo → Card → Modal → Landing CPT → Venta
 *
 * El shortcode NO vende directamente.
 * El CTA del modal deriva al single del CPT correspondiente.
 */
function ev_objetos_shortcode($atts)
{
  $atts = shortcode_atts([
    'tipo'      => 'terapia',
    'cantidad'  => -1,
    'cta_text'  => 'Conocer',
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

        $titulo      = get_the_title($post_id);
        $imagen      = get_the_post_thumbnail($post_id, 'medium');
        $descripcion = function_exists('ev_get_field') ? ev_get_field('descripcion') : '';
        $objetivo    = function_exists('ev_get_field') ? ev_get_field('objetivo') : '';
        $propuesta   = function_exists('ev_get_field') ? ev_get_field('propuesta_valor') : '';
        $proposito   = function_exists('ev_get_field') ? ev_get_field('proposito') : '';
        $cliente     = function_exists('ev_get_field') ? ev_get_field('cliente_potencial') : '';

        $modal_id = 'modal-' . $post_id;

        /**
         * Nuevo flujo:
         * el modal deriva SIEMPRE al single del CPT.
         * La venta real ocurre dentro de single-programa.php,
         * single-curso.php, single-terapia.php o single-experiencia.php.
         */
        $cpt_url = get_permalink($post_id);

        $cta_text = trim($atts['cta_text']);
        if (empty($cta_text)) {
          $cta_text = 'Conocer';
        }
        ?>

        <div class="ev-objeto-card">
          <?php echo $imagen; ?>

          <h3><?php echo esc_html($titulo); ?></h3>

          <button class="ev-open-modal" data-target="<?php echo esc_attr($modal_id); ?>">
            Ver más
          </button>
        </div>

        <!-- Modal -->
        <div id="<?php echo esc_attr($modal_id); ?>" class="ev-modal" aria-hidden="true">
          <div class="ev-modal-content" role="dialog" aria-modal="true" aria-labelledby="<?php echo esc_attr($modal_id); ?>-title">
            <a href="#" class="ev-close-modal" aria-label="Cerrar">×</a>

            <h2 id="<?php echo esc_attr($modal_id); ?>-title">
              <?php echo esc_html($titulo); ?>
            </h2>

            <?php echo get_the_post_thumbnail($post_id, 'large'); ?>

            <?php if ($descripcion): ?>
              <div class="ev-modal-section">
                <strong>Descripción:</strong>
                <p><?php echo wp_kses_post($descripcion); ?></p>
              </div>
            <?php endif; ?>

            <?php if ($objetivo): ?>
              <div class="ev-modal-section">
                <strong>Objetivo:</strong>
                <p><?php echo wp_kses_post($objetivo); ?></p>
              </div>
            <?php endif; ?>

            <?php if ($propuesta): ?>
              <div class="ev-modal-section">
                <strong>Propuesta de Valor:</strong>
                <p><?php echo wp_kses_post($propuesta); ?></p>
              </div>
            <?php endif; ?>

            <?php if ($proposito): ?>
              <div class="ev-modal-section">
                <strong>Propósito:</strong>
                <p><?php echo wp_kses_post($proposito); ?></p>
              </div>
            <?php endif; ?>

            <?php if ($cliente): ?>
              <div class="ev-modal-section">
                <strong>Cliente Ideal:</strong>
                <p><?php echo wp_kses_post($cliente); ?></p>
              </div>
            <?php endif; ?>

            <!-- Acción -->
            <div class="ev-modal-section text-center">
              <?php if (!empty($cpt_url)) : ?>
                <a href="<?php echo esc_url($cpt_url); ?>" class="ev-cta-button text-dark">
                  <?php echo esc_html($cta_text . ' ' . $titulo); ?>
                </a>
              <?php else : ?>
                <span class="ev-cta-unavailable">
                  Este contenido estará disponible pronto
                </span>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
<?php
  endif;

  wp_reset_postdata();

  return ob_get_clean();
}

add_shortcode('ev-objetos', 'ev_objetos_shortcode');

function ev_normalize_post_id($raw)
{
  if (empty($raw)) return 0;

  // Si ACF devuelve un objeto WP_Post
  if ($raw instanceof WP_Post) return (int) $raw->ID;

  // Si viene como array (ACF a veces devuelve ['ID'=>...])
  if (is_array($raw)) {
    if (!empty($raw['ID'])) return (int) $raw['ID'];
    // Si viene como [0 => ID]
    $first = reset($raw);
    if (is_numeric($first)) return (int) $first;
    if ($first instanceof WP_Post) return (int) $first->ID;
  }

  // Si viene como string numérico
  if (is_numeric($raw)) return (int) $raw;

  return 0;
}
