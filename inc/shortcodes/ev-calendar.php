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
      $titulo = get_the_title($post);
      $imagen = get_the_post_thumbnail($post->ID, 'large');
      $descripcion = get_field('descripcion', $post->ID);
      $producto_id = get_post_meta($post->ID, '_linked_product_id', true);
  ?>
    <!-- Modal estilo objeto -->
    <div id="<?= esc_attr($modal_id) ?>" class="ev-modal" aria-hidden="true">
      <div class="ev-modal-content" role="dialog" aria-modal="true" aria-labelledby="<?= esc_attr($modal_id) ?>-title">
        <a href="#" class="ev-close-modal" aria-label="Cerrar">×</a>
        <h2 id="<?= esc_attr($modal_id) ?>-title"><?= esc_html($titulo); ?></h2>

        <?php if ($imagen): ?>
          <div class="mb-4"><?= $imagen ?></div>
        <?php endif; ?>

        <?php if ($descripcion): ?>
          <div class="ev-modal-section mb-4">
            <strong>Descripción:</strong>
            <p><?= wp_kses_post($descripcion); ?></p>
          </div>
        <?php endif; ?>

        <div class="ev-modal-section">
          <strong>Fecha:</strong>
          <p><?= esc_html($date); ?></p>
        </div>

        <div class="ev-modal-section text-center">
          <?php if ($producto_id): ?>
            <a href="<?= esc_url(get_permalink($producto_id)); ?>" class="ev-cta-button">
              Comprar entradas
            </a>
          <?php else: ?>
            <span class="ev-cta-unavailable">Entradas disponibles pronto</span>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endif; endforeach; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('[data-modal-experiencia]').forEach(button => {
        button.addEventListener('click', function (e) {
          e.preventDefault();
          const targetId = button.getAttribute('data-modal-experiencia');
          const modal = document.getElementById(targetId);
          if (modal) {
            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');
            modal.style.display = 'flex';
          }
        });
      });

      document.querySelectorAll('.ev-close-modal').forEach(closeBtn => {
        closeBtn.addEventListener('click', function (e) {
          e.preventDefault();
          const modal = closeBtn.closest('.ev-modal');
          modal.classList.remove('show');
          modal.setAttribute('aria-hidden', 'true');
          modal.style.display = 'none';
        });
      });

      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
          const openModal = document.querySelector('.ev-modal.show');
          if (openModal) {
            openModal.classList.remove('show');
            openModal.setAttribute('aria-hidden', 'true');
            openModal.style.display = 'none';
          }
        }
      });
    });
  </script>

<?php
  return ob_get_clean();
}
add_shortcode('ev-calendar', 'ev_calendar_events_shortcode');
