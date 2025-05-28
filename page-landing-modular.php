<?php
/**
 * Template Name: Landing Modular Unificada
 */
get_header();

$titulo = get_field('titulo_landing');
$subtitulo = get_field('subtitulo_landing');
$imagen_hero = get_field('imagen_hero');
?>

<section class="landing-hero">
  <?php if ($imagen_hero): ?>
    <img class="landing-hero-bg" src="<?php echo esc_url($imagen_hero['url']); ?>" alt="Fondo hero Escuela Mística" loading="lazy" />
  <?php endif; ?>

  <div class="container" data-aos="fade-up">
    <h1><?php echo esc_html($titulo); ?></h1>
    <p><?php echo esc_html($subtitulo); ?></p>
  </div>
</section>

<section class="landing-content" data-aos="fade-up">
  <div class="container">
    <?php
      while (have_posts()) : the_post();
        the_content(); // Aquí insertas los shortcodes [ev-cursos], [ev-terapias], etc.
      endwhile;
    ?>
  </div>
</section>

<?php get_footer(); ?>
