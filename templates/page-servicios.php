<?php
/**
 * Template Name: Servicios
 * Description: Plantilla utilizada para mostrar la sección de servicios del tema Escuela Mística.
 * Presenta bloques o tarjetas dinámicas con información proveniente de campos ACF
 * o shortcodes modulares, permitiendo configurar catálogos, programas o terapias.
 *
 * Compatible con el sistema visual modular del tema, integrando estilos SCSS y animaciones AOS.
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

get_header(); ?>

<!-- Hero Section -->
<section class="hero-section bg-primary mb-5">
    <?php echo do_shortcode('[ev-services-hero]'); ?>
</section>

<div class="page-servicios p-5">

    <!-- Main Content -->
    <?php echo do_shortcode('[ev-services-list]'); ?>


    <!-- contenido -->
    <section class="container-fluid p-5">
        <?php
        while (have_posts()) : the_post();
            the_content(); // Aquí irán los shortcodes [ev-*]
        endwhile;   
        ?>
    </section>

</div>

<?php echo do_shortcode('[ev-prefooter]'); ?>

<?php 


get_footer(); ?>
