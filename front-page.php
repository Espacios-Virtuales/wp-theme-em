<?php
/**
 * Front Page Template
 *
 * Plantilla utilizada para mostrar la página de inicio del sitio,
 * cuando se ha configurado una página estática como portada.
 *
 * Si no se define una plantilla específica, esta actúa como
 * el punto de entrada principal del tema Escuela Mística.
 *
 * Compatible con ACF y bloques Gutenberg para construir la
 * estructura modular de la portada.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
   <main id="primary" class="site-main">
     <div class="pt-5">
       <?php
       while ( have_posts() ) :
         the_post();
 
         get_template_part( 'template-parts/content', 'page' );
 
         // If comments are open or we have at least one comment, load up the comment template.
         if ( comments_open() || get_comments_number() ) :
           comments_template();
         endif;
 
       endwhile; // End of the loop.
       ?>
 
     </div>
 
   </main><!-- #main -->   
<?php

$abou_us_page = get_page_by_path('sobre-nosotros'); 
$about_us_url = $abou_us_page ? get_permalink($abou_us_page->ID) : home_url('/'); ?>

<!-- Llamado a la Acción -->
<section class="cta-section bg-primary text-white py-5">
    <div class="container text-center">
        <h2 class="h3 mb-4">¿Quieres saber más?</h2>
        <p class="mb-4">Descubre nuestros valores y propósitos.</p>
        <a href="<?php echo esc_url($about_us_url); ?>" class="btn btn-secondary btn-lg text-white">Sobre Nosotros</a>
    </div>
</section>

<?php
get_footer();
