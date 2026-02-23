<?php
/**
 * Footer Template
 *
 * Contiene el cierre del contenedor principal del sitio y la estructura
 * de pie de página del tema Escuela Mística. Incluye la llamada a `wp_footer()`
 * necesaria para que los scripts globales y plugins funcionen correctamente.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Escuela_Mistica
 * @subpackage Core
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


if ( ! is_checkout() ) {
  ?>
  <a href="https://wa.me/56956412047?text=Maureen,%20Me%20gustaria%20recibir%20información%20sobre%20los%20Servicios%20de%20Escuela%20Mistica"
     class="whatsapp-button"
     target="_blank" rel="noopener" aria-label="WhatsApp Maureen">
    <i class="bi bi-whatsapp"></i>
  </a>
  <?php
} ?>

<footer id="colophon" class="site-footer">
  <div class="text-white pt-5 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-2">
          <?php dynamic_sidebar('footer-widget-col-one'); ?>
        </div>
        <div class="col-sm-6 col-md-2">
          <?php dynamic_sidebar('footer-widget-col-two'); ?>
        </div>
        <div class="col-md-4 ms-auto col-sm-12">
          <?php dynamic_sidebar('footer-widget-col-three'); ?>
        </div>
        <div class="col-sm-6 col-md-2">
          <?php dynamic_sidebar('footer-widget-col-four'); ?>
        </div>
      </div>
    </div>
  </div>

  <div class="container pt-3 pb-3">
    <div class="row d-flex align-items-center justify-content-between">
      <div class="col text-center text-md-start">
        <p class="mb-0">
          &copy; <?php echo esc_html( get_bloginfo('name') . ' ' . date_i18n('Y') ); ?><br>
          Creado por <a href="https://espaciosvirtuales.cl" class="text-light text-decoration-none" target="_blank" rel="noopener">Espacios Virtuales</a>
        </p>
      </div>
      <div class="col-auto text-center text-md-end">
        <img src="<?php echo esc_url( get_template_directory_uri(). '/assets/imgs/logo.png' ); ?>"
             class="img-fluid w-50" loading="lazy" alt="<?php echo esc_attr__('Logotipo de EM','blog-theme'); ?>">
      </div>
    </div>
  </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
