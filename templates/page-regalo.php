<?php
/* Template Name: Regalo */
get_header();

$title    = get_field('ev_regalo_title') ?: 'Clase de Preparación: La Energía que Está Moviendo tu Vida (y Aún No Sabes Cómo Leerla)';
$subtitle = get_field('ev_regalo_subtitle') ?: 'Una clase exclusiva para quienes se están preparando para la Masterclass “La Inteligencia de los Chakras”.';
$video    = get_field('ev_regalo_video_url') ?: 'https://youtu.be/hOewiT4k3Jg';
$context  = get_field('ev_regalo_context') ?: 'Esta clase es un regalo exclusivo...';
$cta_txt  = get_field('ev_regalo_cta_label') ?: 'IR A LA PÁGINA PRINCIPAL';
$cta_url  = get_field('ev_regalo_cta_url') ?: home_url('/');

function ev_youtube_embed_url($url) {
  if (!$url) return '';
  // youtu.be/ID
  if (preg_match('~youtu\.be/([A-Za-z0-9_-]+)~', $url, $m)) {
    return 'https://www.youtube.com/embed/' . $m[1] . '?rel=0';
  }
  // youtube.com/watch?v=ID
  if (preg_match('~[?&]v=([^&]+)~', $url, $m)) {
    return 'https://www.youtube.com/embed/' . $m[1] . '?rel=0';
  }
  // ya viene en formato embed o algo equivalente
  return $url;
}

$video_embed = ev_youtube_embed_url($video);
?>

<main class="ev-regalo">
  <div class="ev-regalo__container">

    <header class="ev-regalo__hero" data-aos="fade-up">
      <h1 class="ev-regalo__title"><?php echo esc_html($title); ?></h1>
      <?php if ($subtitle): ?>
        <p class="ev-regalo__subtitle"><?php echo esc_html($subtitle); ?></p>
      <?php endif; ?>
    </header>

    <?php if ($video_embed): ?>
      <section class="ev-regalo__video" data-aos="fade-up" data-aos-delay="100">
        <div class="ev-regalo__videoWrap">
          <iframe
            src="<?php echo esc_url($video_embed); ?>"
            title="Clase"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        </div>
      </section>
    <?php endif; ?>

    <section class="ev-regalo__context" data-aos="fade-up" data-aos-delay="150">
      <div class="ev-regalo__richtext">
        <?php echo wp_kses_post(wpautop($context)); ?>
      </div>
    </section>

    <section class="ev-regalo__final" data-aos="fade-up" data-aos-delay="200">
      <div class="ev-regalo__finalBox">
        <h2 class="ev-regalo__finalTitle">¿Quieres ir más profundo desde ya?</h2>
        <p class="ev-regalo__finalText">
          Si deseas conocer mis terapias y procesos personalizados, puedes navegar por la página principal.
        </p>
        <a class="ev-regalo__cta" href="<?php echo esc_url($cta_url); ?>">
          <?php echo esc_html($cta_txt); ?>
        </a>
      </div>
    </section>

  </div>
</main>

<?php get_footer(); ?>