<?php
/**
 * Template Name: Sobre Nosotros
 * Description: Plantilla para la página “Sobre Nosotros” del tema Escuela Mística.
 * Presenta el contenido institucional del sitio, combinando bloque Hero,
 * secciones ACF personalizadas y shortcodes modulares de presentación.
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
?>

<main id="sobre-nosotros" class="bg-light text-dark">

    <!-- Shortcode: Hero -->
    <?php echo do_shortcode('[ev-about-hero]'); ?>

    <!-- Shortcode: Propósito -->
    <?php echo do_shortcode('[ev-about-purpose]'); ?>

    <!-- Shortcode: Misión y Visión -->
    <?php echo do_shortcode('[ev-about-mission-vision]'); ?>

    <!-- Shortcode: Valores -->
    <?php echo do_shortcode('[ev-about-values]'); ?>
   
    <!-- Shortcode: Identidad -->
    <?php echo do_shortcode('[ev-about-identity]'); ?>

    <?php echo do_shortcode('[ev-testimonials]'); ?>

    <!-- Llamado a la Acción -->
    <?php echo do_shortcode('[ev-prefooter]'); ?>

   
</main>

<?php
get_footer();
?>
