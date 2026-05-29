<?php
if (!defined('ABSPATH')) {
    exit;
}

function ev_render_whatsapp_cta_shortcode($atts = []) {
    $atts = shortcode_atts([
        'title' => '¿No sabes por dónde comenzar?',
        'body' => 'Habla directamente con Maureen y recibe orientación para elegir la comunidad, terapia o programa más adecuado para tu momento actual.',
        'button' => 'Hablar con Maureen por WhatsApp',
        'phone' => '56956412047',
        'message' => 'Hola Maureen, me gustaría recibir orientación para comenzar en Escuela Mística.',
    ], $atts, 'ev-whatsapp_cta');

    $phone = preg_replace('/\D+/', '', $atts['phone']);
    $message = rawurlencode($atts['message']);
    $url = "https://wa.me/{$phone}?text={$message}";

    ob_start();
    ?>
    <section class="ev-whatsapp-cta">
        <div class="ev-whatsapp-cta__inner">
            <span class="ev-whatsapp-cta__eyebrow">Escuela Mística</span>

            <h2 class="ev-whatsapp-cta__title">
                <?php echo esc_html($atts['title']); ?>
            </h2>

            <p class="ev-whatsapp-cta__body">
                <?php echo esc_html($atts['body']); ?>
            </p>

            <a
                class="ev-whatsapp-cta__button text-decoration-none text-white"
                href="<?php echo esc_url($url); ?>"
                target="_blank"
                rel="noopener noreferrer">
                <i class="bi bi-whatsapp" aria-hidden="true"></i>
                <span><?php echo esc_html($atts['button']); ?></span>
            </a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('ev-whatsapp_cta', 'ev_render_whatsapp_cta_shortcode');