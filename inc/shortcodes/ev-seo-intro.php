<?php
function ev_seo_intro_shortcode($atts = []) {
  if (!function_exists('get_field')) return '';

  if (!(ev_get_field('seo_enabled') ?: false)) return '';

  // Campos base
  $kw        = trim((string) ev_get_field('seo_keyword'));
  $title     = (string) ev_get_field('seo_title');
  $lead      = (string) ev_get_field('seo_lead');
  $body      = (string) ev_get_field('seo_body');
  $img_id    = ev_get_field('seo_image');
  $img_alt   = (string) ev_get_field('seo_image_alt');
  $collapsed = (bool) ev_get_field('seo_collapsed');

  // Enlaces fijos (hasta 5) – ACF Free
  $links = [];
  $seo_links = ev_get_field('seo_links') ?: [];
  
  for ($i = 1; $i <= 5; $i++) {
    $lab = isset($seo_links["seo_link_{$i}_label"]) ? $seo_links["seo_link_{$i}_label"] : '';
    $url = isset($seo_links["seo_link_{$i}_url"]) ? $seo_links["seo_link_{$i}_url"] : '';
    if ($lab && $url) {
      $links[] = ['label' => $lab, 'url' => $url];
    }
  }

  // Seguridad
  $kw_safe    = esc_html($kw);
  $title_safe = esc_html($title);
  $lead_safe  = esc_html($lead);
  $body_html  = wp_kses_post($body);

  // Collapse
  $is_open_class = $collapsed ? '' : ' show';
  $aria_expanded = $collapsed ? 'false' : 'true';

  // ID único por post
  $uid = 'seoIntro-' . get_the_ID();

  // Imagen opcional
  $img_html = '';
  if ($img_id) {
    $src = wp_get_attachment_image_url($img_id, 'large');
    if ($src) {
      $img_html = sprintf(
        '<figure class="seo-intro__figure mb-3 mx-auto"><img src="%s" alt="%s" class="img-fluid rounded shadow"/></figure>',
        esc_url($src),
        esc_attr($img_alt ?: $kw)
      );
    }
  }

  ob_start(); ?>
  <section class="seo-intro section-ev py-5" data-aos="fade-up" aria-label="Introducción SEO">
    <div class="container">
      <?php if ($title_safe) : ?>
        <h2 class="seo-intro__title h4 text-center mb-2"><?php echo $title_safe; ?></h2>
      <?php endif; ?>

      <p class="seo-intro__lead lead text-center mb-3">
        <strong><?php echo $kw_safe ?: 'escuela mística'; ?></strong>
        <?php echo $lead_safe ? ' ' . $lead_safe : ' es nuestro espacio de formación y práctica espiritual.'; ?>
        <button class="btn btn-link p-0 align-baseline" type="button"
                data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($uid); ?>"
                aria-expanded="<?php echo esc_attr($aria_expanded); ?>"
                aria-controls="<?php echo esc_attr($uid); ?>">
          Leer más
        </button>
      </p>

      <div id="<?php echo esc_attr($uid); ?>" class="collapse<?php echo $is_open_class; ?>">
        <div class="seo-intro__inner text-center mx-auto">
          <?php echo $img_html; ?>
          <div class="seo-intro__content mx-auto"><?php echo $body_html; ?></div>

          <?php if (!empty($links)) : ?>
            <ul class="seo-intro__links list-unstyled mx-auto">
              <?php foreach ($links as $l) : ?>
                <li><a href="<?php echo esc_url($l['url']); ?>"><?php echo esc_html($l['label']); ?></a></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <?php
  return ob_get_clean();
}
add_shortcode('ev-seo_intro', 'ev_seo_intro_shortcode');

