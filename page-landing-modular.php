<?php
/**
 * Template Name: Landing Modular
 * Descripción: Hero + contenido CPT dinámico (descripción, objetivo, valor) + content con shortcodes.
 */

get_header();

// ACF Campos hero
$titulo      = get_field('titulo_landing');
$subtitulo   = get_field('subtitulo_landing');
$imagen_hero = get_field('imagen_hero');

// Campos personalizados del CPT (por ejemplo 'curso', 'terapia', etc.)
$descripcion        = get_field('descripcion');
$objetivo           = get_field('objetivo');
$propuesta_de_valor = get_field('propuesta_valor');
?>

<section class="landing-hero">
  <?php if ($imagen_hero): ?>
    <img class="landing-hero-bg" src="<?php echo esc_url($imagen_hero['url']); ?>" alt="Fondo hero Escuela Mística" loading="lazy" />
  <?php endif; ?>

  <div class="container" data-aos="fade-up">
    <?php if ($titulo): ?><h1><?php echo esc_html($titulo); ?></h1><?php endif; ?>
    <?php if ($subtitulo): ?><p><?php echo esc_html($subtitulo); ?></p><?php endif; ?>
  </div>
</section>

<section class="landing-content" data-aos="fade-up">
  <div class="container">

    <?php if (is_shop()) : ?>
      <!-- Imagen representativa o header visual -->
      <div class="text-center mb-5">
        <h2 class="text-gold mt-4">Catálogo de Productos</h2>
        <p class="text-muted">Explora nuestras terapias, cursos y programas especiales.</p>
      </div>

      <!-- Carga de shortcodes personalizados directamente -->
      <div class="row justify-content-center">
        <?php
            echo do_shortcode('[ev-menu_botones]');
          ?>
        <div class="col-md-10">
          <div class="div">
            <h3 class="text-primary mt-4 text-center">Terapias</h2>
            <?php echo do_shortcode('[ev-objetos]'); ?>
          </div>
          
          <div>
            <h3 class="text-primary mt-4 text-center">Cursos</h2>
            <?php echo do_shortcode('[ev-objetos tipo="course]'); ?>
          </div>
          
          <div> 
            <h3 class="text-primary mt-4 text-center">Programas</h2>
            <?php echo do_shortcode('[ev-objetos tipo="program"]'); ?>
          </div>

        </div>
        <?php
            echo do_shortcode('[ev-menu_botones]');
          ?>
      </div>
    
    <?php else : ?>
      <!-- Página normal -->
      <?php while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    <?php endif; ?>

  </div>
</section>


<section class="landing-intro" data-aos="fade-up">
  <div class="container">
    <div class="landing-columns">
      <?php if ($descripcion): ?>
        <div class="landing-block">
          <h2><i class="bi bi-book"></i> Descripción</h2>
          <p><?php echo wp_kses_post($descripcion); ?></p>
        </div>
      <?php endif; ?>

      <?php if ($propuesta_de_valor): ?>
        <div class="landing-block">
          <h2><i class="bi bi-stars"></i> Propuesta de Valor</h2>
          <p><?php echo wp_kses_post($propuesta_de_valor); ?></p>
        </div>
      <?php endif; ?>

      <?php if ($objetivo): ?>
        <div class="landing-block">
          <h2><i class="bi bi-bullseye"></i> Objetivo</h2>
          <p><?php echo wp_kses_post($objetivo); ?></p>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php get_footer(); ?>

