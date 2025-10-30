<?php
/**
 * Comments Template
 *
 * Plantilla utilizada para mostrar la lista de comentarios y
 * el formulario de envío dentro del tema Escuela Mística.
 *
 * Compatible con jerarquía de comentarios, estilos personalizados y
 * funciones nativas de WordPress (`wp_list_comments()`, `comment_form()`).
 *
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#comments-php
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

if (post_password_required()) return;
?>

<div id="comments" class="comments-area container-fluid">
  <div class="row">
      <?php if (have_comments()) : ?>
        <h2 class="comments-title">
          <?php
          $comment_count = get_comments_number();
          printf(
            esc_html(_n(
              'Un comentario en “%2$s”',
              '%1$s comentarios en “%2$s”',
              $comment_count,
              'escuelamistica'
            )),
            number_format_i18n($comment_count),
            get_the_title()
          );
          ?>
        </h2>

        <ul class="comment-list">
          <?php
          wp_list_comments([
            'style'      => 'ul',
            'short_ping' => true,
            'avatar_size' => 60,
          ]);
          ?>
        </ul>

        <?php the_comments_navigation(); ?>

        <?php if (!comments_open()) : ?>
          <p class="no-comments"><?php esc_html_e('Los comentarios están cerrados.', 'escuelamistica'); ?></p>
        <?php endif; ?>
      <?php endif; ?>

      <?php comment_form(); ?>
  </div>
</div>
