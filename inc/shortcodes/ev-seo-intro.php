<?php
// inc/shortcodes/ev-seo-intro.php
function ev_seo_intro_shortcode($atts = []) {
  if (!function_exists('get_field')) return ''; // ACF requerido

  $enabled   = get_field('seo_enabled') ?: false;
  if (!$enabled) return '';

  $kw        = trim((string)get_field('seo_keyword'));
  $title     = (string)get_field('seo_title');
  $lead      = (string)get_field('seo_lead');
  $body      = (string)get_field('seo_body');
  $links     = get_field('seo_links') ?: [];
  $img_id    = get_field('seo_image');
  $img_alt   = (string)get_field('seo_image_alt');
  $collapsed = (bool)get_field('seo_collapsed');

  // Seguridad básica
  $kw_safe    = esc_html($kw);
  $title_safe = esc_html($title);
  $lead_safe  = esc_html($lead);
  $body_html  = wp_kses_post($body);
  $is_open    = $collapsed ? '' : ' show';

  // Imagen opcional
  $img_html = '';
  if ($img_id) {
    $src = wp_get_attachment_image_url($img_id, 'large');
    if ($src) {
      $img_html = sprintf(
        '<figure class="seo-intro__figure mb-3"><img src="%s" alt="%s" class="img-fluid rounded shadow"/></figure>',
        esc_url($src),
        esc_attr($img_alt ?: $kw)
      );
    }
  }

  ob_start(); ?>
  <section class="seo-intro container my-3" aria-label="Introducción SEO">
    <?php if (!empty($title_safe)) : ?>
      <h2 class="h4 text-center mb-2"><?php echo $title_safe; ?></h2>
    <?php endif; ?>

    <!-- Lead visible con keyword al inicio -->
    <p class="lead text-center mb-2">
      <strong><?php echo $kw_safe; ?></strong>
      <?php echo $lead_safe ? ' ' . $lead_safe : ' es nuestro espacio de formación y práctica espiritual.'; ?>
      <button class="btn btn-link p-0 align-baseline" type="button"
              data-bs-toggle="collapse" data-bs-target="#seoIntro"
              aria-expanded="<?php echo $collapsed ? 'false' : 'true'; ?>"
              aria-controls="seoIntro">Leer más</button>
    </p>

    <div id="seoIntro" class="collapse<?php echo $is_open; ?>">
      <div class="seo-intro__inner mx-auto">
        <?php echo $img_html; ?>
        <?php echo $body_html; ?>

        <?php if (!empty($links)) : ?>
          <ul class="seo-intro__links list-unstyled mt-3">
            <?php foreach ($links as $l) :
              $url = isset($l['url']) ? esc_url($l['url']) : '#';
              $lab = isset($l['label']) ? esc_html($l['label']) : $url; ?>
              <li>→ <a href="<?php echo $url; ?>"><?php echo $lab; ?></a></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php
  return ob_get_clean();
}
add_shortcode('ev-seo_intro', 'ev_seo_intro_shortcode');
