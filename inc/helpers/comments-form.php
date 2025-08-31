<?php
function ev_custom_comment_form($defaults) {
    $defaults['fields'] = [
      'author' => '
        <div class="ev-form-row">
          <label for="author">Nombre *</label>
          <input id="author" name="author" type="text" required>
        </div>',
      'email' => '
        <div class="ev-form-row">
          <label for="email">Mail *</label>
          <input id="email" name="email" type="email" required>
        </div>',
      'url' => '
        <div class="ev-form-row">
          <label for="url">Web</label>
          <input id="url" name="url" type="url">
        </div>',
    ];
  
    $defaults['comment_field'] = '
      <div class="ev-form-row">
        <label for="comment">Comentario *</label>
        <textarea id="comment" name="comment" rows="6" required></textarea>
      </div>';
  
    $defaults['submit_button'] = '<button type="submit" class="ev-btn">%1$s</button>';
    $defaults['class_form'] = 'ev-form';
    $defaults['title_reply'] = 'Deja una respuesta';
  
    return $defaults;
  }
  add_filter('comment_form_defaults', 'ev_custom_comment_form');
  