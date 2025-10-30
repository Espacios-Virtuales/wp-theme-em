<?php
/**
 * Header Template
 *
 * Contiene la estructura de la cabecera del tema Escuela Mística:
 * todo el bloque <head> y la apertura del <body> hasta el contenedor principal de contenido.
 *
 * Incluye las llamadas a `wp_head()` y `wp_body_open()` necesarias
 * para compatibilidad total con el ecosistema WordPress moderno.
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
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary">
      <?php esc_html_e('Skip to content', 'tiendavirtual'); ?>
    </a>

    <!-- Announcement Bar -->
    <div class="announcement-bar">
      <div class="row">
        <div class="col d-flex justify-content-center justify-content-md-end">
          <ul class="announcement-bar__list ml-2">
            <li><a class="text-white text-decoration-none" href="https://www.youtube.com/@Momistica"><i class="bi bi-youtube rounded-circle"></i></a></li>
            <li><a class="text-white text-decoration-none" href="https://www.instagram.com/momistica/"><i class="bi bi-instagram rounded-circle"></i></a></li>
            <li><a class="text-white text-decoration-none" href="https://web.facebook.com/momistica"><i class="bi bi-facebook rounded-circle"></i></a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Site Header -->
    <header id="masthead" class="site-header">
      <div class="container-fluid p-5">
        <div class="row align-items-center">
          <div class="col d-flex justify-content-center justify-content-md-start site-header__logo">
            <?php the_custom_logo(); ?>
          </div>

          <div class="col-sm-12 col-md-5 pb-2">
            <?php if (function_exists('aws_get_search_form')) {
              aws_get_search_form(true);
            } ?>
          </div>

          <div class="col cart d-flex justify-content-center justify-content-md-end align-items-center pt-2">
            <?php if (function_exists('WC') && WC()->cart) : ?>
              <a href="<?php echo esc_url(wc_get_cart_url()); ?>"><i class="bi bi-bag-dash p-2 text-white"></i></a>
              <a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart'); ?>">
                <?php
                $count = WC()->cart->get_cart_contents_count();
                /* translators: %d: cart items */
                printf(_n('%d item', '%d items', $count), $count);
                ?> – <?php echo WC()->cart->get_cart_total(); ?>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Navigation Menu -->
      <nav id="site-navigation" class="main-navigation">
        <div class="container d-flex justify-content-center">
          <div class="row w-100">
            <div class="col-12 d-flex justify-content-center">
              <button class="menu-toggle bg-primary" aria-controls="primary-menu" aria-expanded="false">
                <i class="bi bi-list"></i>
              </button>
            </div>
            <div class="col-12 text-center">
              <?php
              wp_nav_menu([
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
                'container'      => false,
              ]);
              ?>
            </div>
          </div>
        </div>
      </nav>
    </header>

    <?php
    // Opcional: mover esto a front-page.php para mejor separación.
    if (is_front_page()) {
      echo do_shortcode('[ev-hero]');
    }
    ?>