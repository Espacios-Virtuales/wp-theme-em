<?php


/*
    Función para crear el shortcode de calendario con eventos de ACF y modales
*/ 

function ev_calendar_events_shortcode() {
  $calendar = new Calendar(date('Y-m-d'));
  $data = blog_get_custom_post_type('experiencia');
  $posts = $data->posts;

  foreach ($posts as $post) {
    $on = get_field('on', $post); 
    $date = get_field('date', $post);

    if ($on && $date) {
      $calendar->add_event($post->post_title, $date, 1, $post->ID);
    }
  }

  ob_start(); ?>

  <section class="container-bg pt-5 pb-5" id="eventos-calendar" data-aos="fade-up">
    <?= $calendar ?>
  </section>

  <?php foreach ($posts as $post): 
    $on = get_field('on', $post);
    $date = get_field('date', $post);

    if ($on && $date):
      $modal_id = 'modal_' . $post->ID;
      $titulo = $post->post_title;
      $imagen = get_the_post_thumbnail($post->ID, 'large');
      $descripcion = get_field('descripcion', $post->ID);
      $producto_id = get_post_meta($post->ID, '_linked_product_id', true);
  ?>
    <div class="modal fade" id="<?= esc_attr($modal_id) ?>" tabindex="-1" aria-labelledby="<?= esc_attr($modal_id) ?>Label" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" data-aos="zoom-in">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-gold" id="<?= esc_attr($modal_id) ?>Label"><?= esc_html($titulo); ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <?php if ($imagen): ?>
              <div class="mb-4"><?= $imagen ?></div>
            <?php endif; ?>

            <?php if ($descripcion): ?>
              <div class="ev-modal-section mb-4">
                <strong class="text-gold">Descripción:</strong>
                <p><?= wp_kses_post($descripcion); ?></p>
              </div>
            <?php endif; ?>

            <p><strong class="text-gold">Fecha:</strong> <?= esc_html($date); ?></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <?php if ($producto_id): ?>
              <a href="<?= get_permalink($producto_id); ?>" class="btn btn-primary">
                Comprar entradas
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; endforeach;

  return ob_get_clean();
}
add_shortcode('ev-calendar', 'ev_calendar_events_shortcode');

