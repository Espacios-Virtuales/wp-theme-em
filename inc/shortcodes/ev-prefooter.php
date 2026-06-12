<?php

function ev_prefooter_shortcode()
{
    $current_id = get_the_ID();

    $title = get_field('prefooter_title', $current_id);
    $description = get_field('prefooter_description', $current_id);
    $button_text = get_field('prefooter_button_text', $current_id);
    $button_url = get_field('prefooter_button_url', $current_id);

    $title = !empty($title) ? $title : '¿Quieres saber más?';
    $description = !empty($description) ? $description : 'Descubre nuestros valores, propósito y camino de transformación.';
    $button_text = !empty($button_text) ? $button_text : 'Sobre Nosotros';
    $button_url = !empty($button_url) ? $button_url : home_url('/sobre-nosotros/');

    ob_start();
    ?>

    <section class="ev-prefooter cta-section bg-primary text-white py-5" data-aos="fade-up">
        <div class="container">
            <div class="ev-prefooter__inner text-center">
                <span class="ev-prefooter__eyebrow">
                    Escuela Mística
                </span>

                <h2 class="ev-prefooter__title h3 mb-3">
                    <?php echo esc_html($title); ?>
                </h2>

                <p class="ev-prefooter__description mb-4">
                    <?php echo esc_html($description); ?>
                </p>

                <?php if (!empty($button_url) && !empty($button_text)) : ?>
                    <a href="<?php echo esc_url($button_url); ?>" class="ev-prefooter__button btn btn-secondary btn-lg text-white">
                        <?php echo esc_html($button_text); ?>
                        <i class="bi bi-arrow-right-short"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    return ob_get_clean();
}

add_shortcode('ev-prefooter', 'ev_prefooter_shortcode');