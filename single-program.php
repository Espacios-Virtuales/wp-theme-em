<?php
get_header();

$post_id = get_the_ID();

$ev_get_field = function ($field, $id = null, $default = '') {
    if (!function_exists('get_field')) {
        return $default;
    }

    $value = get_field($field, $id);

    return $value ?: $default;
};

$post_type = get_post_type($post_id);

$type_labels = [
    'program'     => 'Programa',
    'programa'    => 'Programa',
    'course'      => 'Curso',
    'curso'       => 'Curso',
    'therapy'     => 'Terapia',
    'terapia'     => 'Terapia',
    'experience'  => 'Experiencia',
    'experiencia' => 'Experiencia',
];

$type_label = $type_labels[$post_type] ?? 'Experiencia';

// Hero ACF
$titulo      = $ev_get_field(
    'titulo_landing',
    $post_id,
    get_the_title($post_id)
);
$subtitulo   = $ev_get_field('subtitulo_landing', $post_id);
$imagen_hero = $ev_get_field('imagen_hero', $post_id);

// Contenido ACF
$descripcion       = $ev_get_field('descripcion', $post_id);
$objetivo          = $ev_get_field('objetivo', $post_id);
$propuesta_valor   = $ev_get_field('propuesta_valor', $post_id);
$proposito         = $ev_get_field('proposito', $post_id);
$cliente_potencial = $ev_get_field('cliente_potencial', $post_id);

// Acción principal: WhatsApp
$whatsapp_url = esc_url_raw(
    $ev_get_field('cta_whatsapp_url', $post_id)
);

$whatsapp_label = $ev_get_field(
    'cta_whatsapp_label',
    $post_id,
    'Consultar por WhatsApp'
);

// Compra nacional: WooCommerce
$producto_id = get_post_meta($post_id, '_ev_product_id', true);

if (!$producto_id) {
    $possible_product_meta = [
        '_linked_product_id',
        '_program_product_id',
        '_course_product_id',
        '_therapy_product_id',
        '_experience_product_id',
    ];

    foreach ($possible_product_meta as $meta_key) {
        $value = get_post_meta($post_id, $meta_key, true);

        if ($value) {
            $producto_id = $value;
            break;
        }
    }
}

$product_permalink = '';

if ($producto_id && function_exists('wc_get_product')) {
    $producto_id = absint($producto_id);
    $product     = wc_get_product($producto_id);

    if (
        $product &&
        'publish' === get_post_status($producto_id)
    ) {
        $product_permalink = get_permalink($producto_id);
    }
}

// Compra internacional: PayPal
$payment_url = $ev_get_field('payment_url', $post_id);

if (!$payment_url) {
    $payment_url = $ev_get_field('course_payment_url', $post_id);
}

$payment_url = esc_url_raw($payment_url);

$payment_label = $ev_get_field(
    'payment_label',
    $post_id,
    'Pagar con PayPal'
);

// Imagen del hero
$hero_bg = '';

if (
    !empty($imagen_hero) &&
    is_array($imagen_hero) &&
    !empty($imagen_hero['url'])
) {
    $hero_bg = $imagen_hero['url'];
} elseif (is_numeric($imagen_hero)) {
    $hero_bg = wp_get_attachment_image_url(
        absint($imagen_hero),
        'full'
    );
} elseif (is_string($imagen_hero) && !empty($imagen_hero)) {
    $hero_bg = $imagen_hero;
}

$has_whatsapp_action = !empty($whatsapp_url);
$has_purchase_action = !empty($product_permalink) || !empty($payment_url);
?>

<main class="ev-experience-single ev-experience-single--<?php echo esc_attr($post_type); ?>">

    <section
        class="ev-experience-hero"
        <?php if ($hero_bg) : ?>
            style="<?php echo esc_attr("--ev-hero-bg: url('{$hero_bg}');"); ?>"
        <?php endif; ?>
    >
        <div class="ev-experience-hero__overlay"></div>

        <div class="container ev-experience-hero__inner">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <div
                        class="ev-experience-hero__content"
                        data-aos="fade-up"
                        data-aos-duration="900"
                    >
                        <span class="ev-experience-hero__eyebrow">
                            <?php echo esc_html($type_label); ?>
                        </span>

                        <h1 class="ev-experience-hero__title">
                            <?php echo esc_html($titulo); ?>
                        </h1>

                        <?php if ($subtitulo) : ?>
                            <div class="ev-experience-hero__subtitle">
                                <?php echo wp_kses_post(wpautop($subtitulo)); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($has_whatsapp_action) : ?>
                            <div class="ev-experience-hero__actions">
                                <a
                                    class="ev-btn ev-btn--primary"
                                    href="<?php echo esc_url($whatsapp_url); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <?php echo esc_html($whatsapp_label); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if ($descripcion) : ?>
        <section class="ev-experience-section ev-experience-section--intro">
            <div class="container">
                <div
                    class="ev-experience-richtext ev-experience-richtext--lead"
                    data-aos="fade-up"
                >
                    <?php echo wp_kses_post(wpautop($descripcion)); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="ev-experience-section ev-experience-section--grid">
        <div class="container">
            <div class="row g-4">
                <?php
                $cards = [
                    'Objetivo'            => $objetivo,
                    'Propuesta de valor' => $propuesta_valor,
                    'Propósito'          => $proposito,
                    'Cliente potencial'  => $cliente_potencial,
                ];

                $delay = 0;
                ?>

                <?php foreach ($cards as $card_title => $card_body) : ?>
                    <?php if ($card_body) : ?>
                        <div class="col-md-6 col-xl-3">
                            <article
                                class="ev-experience-card"
                                data-aos="fade-up"
                                data-aos-delay="<?php echo esc_attr($delay); ?>"
                            >
                                <h3 class="ev-experience-card__title">
                                    <?php echo esc_html($card_title); ?>
                                </h3>

                                <div class="ev-experience-card__body">
                                    <?php echo wp_kses_post(wpautop($card_body)); ?>
                                </div>
                            </article>
                        </div>

                        <?php $delay += 80; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php if ($has_purchase_action) : ?>
        <section class="ev-experience-section ev-experience-section--closing">
            <div class="container">
                <div
                    class="ev-experience-closing"
                    data-aos="zoom-in-up"
                >
                    <h2 class="ev-experience-closing__title">
                        Elige tu forma de acceso
                    </h2>

                    <p class="ev-experience-closing__text">
                        Selecciona la opción de compra correspondiente a tu territorio.
                    </p>

                    <div class="ev-experience-closing__actions">
                        <?php if ($product_permalink) : ?>
                            <a
                                class="ev-btn ev-btn--primary"
                                href="<?php echo esc_url($product_permalink); ?>"
                            >
                                Compra nacional
                            </a>
                        <?php endif; ?>

                        <?php if ($payment_url) : ?>
                            <a
                                class="ev-btn ev-btn--ghost"
                                href="<?php echo esc_url($payment_url); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                <?php echo esc_html($payment_label); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>