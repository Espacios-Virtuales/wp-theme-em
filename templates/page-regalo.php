<?php
/* Template Name: Regalo */
get_header();

$title    = get_field('ev_regalo_title') ?: 'Clase de Preparación: La Energía que Está Moviendo tu Vida (y Aún No Sabes Cómo Leerla)';
$subtitle = get_field('ev_regalo_subtitle') ?: 'Una clase exclusiva para quienes se están preparando para la Masterclass “La Inteligencia de los Chakras”.';
$video    = get_field('ev_regalo_video_url') ?: 'https://youtu.be/hOewiT4k3Jg';
$context  = get_field('ev_regalo_context') ?: 'Esta clase es un regalo exclusivo...';
$cta_txt  = get_field('ev_regalo_cta_label') ?: 'IR A LA PÁGINA PRINCIPAL';
$cta_url  = get_field('ev_regalo_cta_url') ?: home_url('/');
?>

<main class="ev-regalo">
  <section class="ev-regalo__hero" data-aos="fade-up">
    <div class="ev-regalo__container">
      <h1 class="ev-regalo__title"><?php echo esc_html($title); ?></h1>
      <?php if ($subtitle): ?>
        <p class="ev-regalo__subtitle"><?php echo esc_html($subtitle); ?></p>
      <?php endif; ?>
    </div>
  </section>

  <section class="ev-regalo__video" data-aos="fade-up" data-aos-delay="100">
    <div class="ev-regalo__container">
      <button class="ev-regalo__videoBtn" type="button"
              data-ev-video="<?php echo esc_url($video); ?>">
        ▶ Ver clase (abrir portal)
      </button>
      <p class="ev-regalo__hint">Reproducción en modal — luz y sombra.</p>
    </div>
  </section>

  <section class="ev-regalo__context" data-aos="fade-up" data-aos-delay="150">
    <div class="ev-regalo__container">
      <div class="ev-regalo__richtext">
        <?php echo wp_kses_post(wpautop($context)); ?>
      </div>
    </div>
  </section>

  <section class="ev-regalo__final" data-aos="fade-up" data-aos-delay="200">
    <div class="ev-regalo__container ev-regalo__finalBox">
      <h2>¿Quieres ir más profundo desde ya?</h2>
      <p>Si deseas conocer mis terapias y procesos personalizados, puedes navegar por la página principal.</p>
      <a class="ev-regalo__cta" href="<?php echo esc_url($cta_url); ?>">
        <?php echo esc_html($cta_txt); ?>
      </a>
    </div>
  </section>

  <!-- Modal -->
  <div class="ev-modal" id="evVideoModal" aria-hidden="true" role="dialog" aria-label="Video">
    <div class="ev-modal__backdrop" data-ev-close></div>
    <div class="ev-modal__panel" role="document">
      <button class="ev-modal__close" type="button" data-ev-close aria-label="Cerrar">×</button>
      <div class="ev-modal__frameWrap">
        <iframe id="evVideoFrame" src="" title="Video" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen></iframe>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>