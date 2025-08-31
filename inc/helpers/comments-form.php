<?php
function ev_custom_comment_form($defaults) {
    $defaults['fields'] = [
      'author' => '
        <div class="col-md-6">
          <label for="author" class="form-label text-primary fw-semibold">Nombre <span class="text-danger">*</span></label>
          <input id="author" name="author" type="text" class="form-control" required>
        </div>',
      'email' => '
        <div class="col-md-6">
          <label for="email" class="form-label text-primary fw-semibold">Correo <span class="text-danger">*</span></label>
          <input id="email" name="email" type="email" class="form-control" required>
        </div>',
      'url' => '
        <div class="col-12">
          <label for="url" class="form-label text-primary fw-semibold">Sitio Web</label>
          <input id="url" name="url" type="url" class="form-control">
        </div>',
    ];
  
    $defaults['comment_field'] = '
      <div class="col-12">
        <label for="comment" class="form-label text-primary fw-semibold">Comentario <span class="text-danger">*</span></label>
        <textarea id="comment" name="comment" class="form-control" rows="6" required></textarea>
      </div>';
  
    $defaults['submit_button'] = '
      <div class="col-12 text-start mt-3">
        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-bold text-uppercase shadow-sm">%1$s</button>
      </div>';
  
    $defaults['class_form'] = 'row g-4 ev-form'; // g-4 = spacing entre campos
    $defaults['title_reply'] = 'Deja una respuesta';
  
    return $defaults;
  }
  add_filter('comment_form_defaults', 'ev_custom_comment_form');
  