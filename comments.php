<?php
/**
 * Template for displaying comments and comment form
 * @package escuela-mistica
 */

if (post_password_required()) return;
?>

<div id="comments" class="comments-area container-fluid">
  <div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">

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
</div>
