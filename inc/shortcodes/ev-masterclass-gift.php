<?php
if (!defined('ABSPATH')) exit;

/**
 * Shortcode: [ev_masterclass_gift]
 * Requiere ACF (free). Lee campos:
 * - mc_whatsapp_url
 * - mc_button_label
 * - mc_gift_title
 * - mc_gift_body
 * - mc_gift_note
 * - mc_style_variant (default|vortice)
 */
function ev_sc_masterclass_gift($atts = []) {
    if (!function_exists('get_field')) {
        return '<!-- ACF no disponible -->';
    }

    $whatsapp_url  = trim((string) get_field('mc_whatsapp_url'));
    $button_label  = trim((string) get_field('mc_button_label')) ?: 'UNIRME AL GRUPO DE WHATSAPP';
    $gift_title    = trim((string) get_field('mc_gift_title')) ?: 'REGALO EXCLUSIVO PARA MIEMBROS DEL GRUPO';
    $gift_body     = (string) get_field('mc_gift_body');
    $gift_note     = trim((string) get_field('mc_gift_note'));
    $style_variant = trim((string) get_field('mc_style_variant')) ?: 'vortice';

    // Body class auxiliar para scss por variante
    $variant_class = 'ev-mc--' . sanitize_html_class($style_variant);

    // Si no hay link, igual mostramos el bloque (solo sin botón)
    $btn_html = '';
    if (!empty($whatsapp_url)) {
        $btn_html = sprintf(
            '<a class="ev-mc__btn" href="%s" target="_blank" rel="noopener">%s</a>',
            esc_url($whatsapp_url),
            esc_html($button_label)
        );
    }

    // gift body: textarea con new_lines=br → suele venir con <br>, pero igual saneamos.
    $gift_body_html = '';
    if (!empty(trim($gift_body))) {
        $gift_body_html = wp_kses_post(wpautop($gift_body));
    }

    ob_start(); ?>
    <section class="ev-masterclass-gift <?php echo esc_attr($variant_class); ?>">
      <div class="ev-mc__inner">
        <h3 class="ev-mc__title"><?php echo esc_html($gift_title); ?></h3>

        <?php if ($gift_body_html): ?>
          <div class="ev-mc__body"><?php echo $gift_body_html; ?></div>
        <?php endif; ?>

        <?php if ($btn_html): ?>
          <div class="ev-mc__cta">
            <?php echo $btn_html; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($gift_note)): ?>
          <div class="ev-mc__note"><?php echo esc_html($gift_note); ?></div>
        <?php endif; ?>
      </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('ev_masterclass_gift', 'ev_sc_masterclass_gift');