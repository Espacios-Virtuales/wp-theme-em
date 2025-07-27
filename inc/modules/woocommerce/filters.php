<?php 

add_shortcode('ev-tienda-filtrada', function () {
  ob_start(); ?>
  
  <div id="ev-product-filters" class="product-filters">
    <button data-cat="all">Todos</button>
    <button data-cat="online">Online</button>
    <button data-cat="presencial">Presencial</button>
    <button data-cat="sincronica">Sincrónica</button>
  </div>

  <div id="ev-product-results">
    <?php echo ev_render_productos('all'); ?>
  </div>

  <?php return ob_get_clean();
});

