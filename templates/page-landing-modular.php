<?php
/**
 * Template Name: Landing Modular
 * Description: Plantilla de aterrizaje flexible que combina un bloque Hero,
 * contenido dinámico proveniente de CPTs (descripción, objetivo, valor)
 * y secciones modulares renderizadas mediante shortcodes.
 *
 * Ideal para crear páginas de programas, cursos o experiencias formativas
 * dentro del tema Escuela Mística, integrando diseño, propósito y funcionalidad.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Escuela_Mistica
 * @subpackage Templates
 * @since 1.0.0
 *
 * License: GPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * SPDX-License-Identifier: GPL-3.0-or-later
 *
 * © 2025 Espacios Virtuales — Proyecto Escuela Mística
 * Este archivo forma parte del tema Escuela Mística y se distribuye bajo los
 * términos de la GNU General Public License versión 3 o posterior.
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
            echo do_shortcode('[ev-botonera_anclas]');
          ?>

        <div class="col-md-10">
          <div class="terapias-section" id="terapias">
            <h3 class="text-primary mt-4 text-center">Terapias</h2>
            <?php echo do_shortcode('[ev-objetos]'); ?>
          </div>
          
          <div class="cursos-section" id="cursos">
            <h3 class="text-primary mt-4 text-center">Cursos</h2>
            <?php echo do_shortcode('[ev-objetos tipo="course" cantidad=10]'); ?>
          </div>
          
          <div class="programas-section" id="programas"> 
            <h3 class="text-primary mt-4 text-center">Programas</h2>
            <?php echo do_shortcode('[ev-objetos tipo="program"]'); ?>
          </div>

          <div class="programas-section" id="experiencias"> 
            <h3 class="text-primary mt-4 text-center">Experiencias</h2>
            <?php echo do_shortcode('[ev-objetos tipo="experiencia"]'); ?>
          </div>

        </div>
        <?php echo do_shortcode('[ev-botonera_anclas]');?>

        <?php echo do_shortcode('[ev-seo_intro]');?>
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

