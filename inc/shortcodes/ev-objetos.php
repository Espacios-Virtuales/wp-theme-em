<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcode: [ev-objetos tipo="program"]
 *
 * Flujo:
 * Catálogo → Card → Modal → Landing CPT → Venta
 *
 * Tipos soportados:
 * - program / programa
 * - course / curso
 * - terapia
 * - experiencia
 */
function ev_objetos_shortcode($atts = [])
{
    $atts = shortcode_atts(
        [
            'tipo'           => '',
            'type'           => '',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'button_text'    => 'Conocer',
            'class'          => '',
        ],
        $atts,
        'ev-objetos'
    );

    $tipo = !empty($atts['tipo']) ? $atts['tipo'] : $atts['type'];
    $tipo = sanitize_key($tipo);

    $post_type_candidates = [
        'program'     => ['program', 'programa'],
        'programa'    => ['programa', 'program'],
        'course'      => ['course', 'curso'],
        'curso'       => ['curso', 'course'],
        'terapia'     => ['terapia', 'therapy'],
        'therapy'     => ['therapy', 'terapia'],
        'experiencia' => ['experiencia', 'experience'],
        'experience'  => ['experience', 'experiencia'],
    ];

    $candidate_post_types = $post_type_candidates[$tipo] ?? [$tipo];

    $post_types = array_values(array_filter($candidate_post_types, function ($post_type) {
        return post_type_exists($post_type);
    }));

    if (empty($post_types)) {
        return '';
    }

    $query = new WP_Query([
        'post_type'      => $post_types,
        'post_status'    => 'publish',
        'posts_per_page' => intval($atts['posts_per_page']),
        'orderby'        => sanitize_key($atts['orderby']),
        'order'          => strtoupper($atts['order']) === 'DESC' ? 'DESC' : 'ASC',
    ]);

    if (!$query->have_posts()) {
        return '';
    }

    $safe_get_field = function ($field, $post_id, $default = '') {
        if (!function_exists('get_field')) {
            return $default;
        }

        $value = get_field($field, $post_id);

        return $value ?: $default;
    };

    $get_image_url = function ($image, $post_id) {
        if (is_array($image) && !empty($image['url'])) {
            return $image['url'];
        }

        if (is_numeric($image)) {
            return wp_get_attachment_image_url(absint($image), 'large');
        }

        if (is_string($image) && !empty($image)) {
            return $image;
        }

        if (has_post_thumbnail($post_id)) {
            return get_the_post_thumbnail_url($post_id, 'large');
        }

        return '';
    };

    $wrapper_classes = trim('ev-objetos ev-objetos--' . esc_attr($tipo) . ' ' . esc_attr($atts['class']));

    ob_start();
    ?>

    <section class="<?php echo esc_attr($wrapper_classes); ?>">
        <div class="container">
            <div class="row g-4">

                <?php while ($query->have_posts()) : ?>
                    <?php
                    $query->the_post();

                    $post_id   = get_the_ID();
                    $post_type = get_post_type($post_id);

                    $titulo = $safe_get_field('titulo_landing', $post_id, get_the_title($post_id));

                    $descripcion = $safe_get_field('descripcion', $post_id);
                    if (empty($descripcion)) {
                        $descripcion = get_the_excerpt($post_id);
                    }

                    $objetivo          = $safe_get_field('objetivo', $post_id);
                    $propuesta_valor   = $safe_get_field('propuesta_valor', $post_id);
                    $proposito         = $safe_get_field('proposito', $post_id);
                    $cliente_potencial = $safe_get_field('cliente_potencial', $post_id);

                    $imagen = $safe_get_field('imagen_hero', $post_id);
                    if (empty($imagen)) {
                        $imagen = $safe_get_field('imagen', $post_id);
                    }

                    $image_url = $get_image_url($imagen, $post_id);
                    $cpt_url   = get_permalink($post_id);

                    $modal_id = 'ev-modal-' . $post_type . '-' . $post_id;
                    ?>

                    <div class="col-md-6 col-xl-4">
                        <article class="ev-objeto-card">

                            <?php if ($image_url) : ?>
                                <figure class="ev-objeto-card__media">
                                    <img
                                        src="<?php echo esc_url($image_url); ?>"
                                        alt="<?php echo esc_attr($titulo); ?>"
                                        loading="lazy">
                                </figure>
                            <?php endif; ?>

                            <div class="ev-objeto-card__body">
                                <span class="ev-objeto-card__eyebrow">
                                    <?php echo esc_html(ucfirst($tipo)); ?>
                                </span>

                                <h3 class="ev-objeto-card__title">
                                    <?php echo esc_html($titulo); ?>
                                </h3>

                                <?php if ($descripcion) : ?>
                                    <div class="ev-objeto-card__excerpt">
                                        <?php echo wp_kses_post(wp_trim_words(wp_strip_all_tags($descripcion), 24)); ?>
                                    </div>
                                <?php endif; ?>

                                <button
                                    type="button"
                                    class="ev-btn ev-btn--primary ev-objeto-card__button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#<?php echo esc_attr($modal_id); ?>">
                                    Ver detalles
                                </button>
                            </div>
                        </article>
                    </div>

                    <div
                        class="modal fade ev-modal"
                        id="<?php echo esc_attr($modal_id); ?>"
                        tabindex="-1"
                        aria-labelledby="<?php echo esc_attr($modal_id); ?>-label"
                        aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content ev-modal__content">

                                <button
                                    type="button"
                                    class="btn-close ev-modal__close"
                                    data-bs-dismiss="modal"
                                    aria-label="Cerrar">
                                </button>

                                <?php if ($image_url) : ?>
                                    <figure class="ev-modal__media">
                                        <img
                                            src="<?php echo esc_url($image_url); ?>"
                                            alt="<?php echo esc_attr($titulo); ?>">
                                    </figure>
                                <?php endif; ?>

                                <div class="ev-modal__body">
                                    <span class="ev-modal__eyebrow">
                                        <?php echo esc_html(ucfirst($tipo)); ?>
                                    </span>

                                    <h2 id="<?php echo esc_attr($modal_id); ?>-label" class="ev-modal__title">
                                        <?php echo esc_html($titulo); ?>
                                    </h2>

                                    <?php if ($descripcion) : ?>
                                        <div class="ev-modal__description">
                                            <?php echo wp_kses_post(wpautop($descripcion)); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="ev-modal__grid">
                                        <?php if ($objetivo) : ?>
                                            <div class="ev-modal__section">
                                                <h3>Objetivo</h3>
                                                <?php echo wp_kses_post(wpautop($objetivo)); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($propuesta_valor) : ?>
                                            <div class="ev-modal__section">
                                                <h3>Propuesta de valor</h3>
                                                <?php echo wp_kses_post(wpautop($propuesta_valor)); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($proposito) : ?>
                                            <div class="ev-modal__section">
                                                <h3>Propósito</h3>
                                                <?php echo wp_kses_post(wpautop($proposito)); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($cliente_potencial) : ?>
                                            <div class="ev-modal__section">
                                                <h3>Para quién es</h3>
                                                <?php echo wp_kses_post(wpautop($cliente_potencial)); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="ev-modal__actions">
                                        <?php if ($cpt_url) : ?>
                                            <a href="<?php echo esc_url($cpt_url); ?>" class="ev-btn ev-btn--primary">
                                                <?php echo esc_html($atts['button_text']); ?> <?php echo esc_html($titulo); ?>
                                            </a>
                                        <?php else : ?>
                                            <span class="ev-modal__unavailable">
                                                Este contenido estará disponible pronto.
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>

            </div>
        </div>
    </section>

    <?php
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
