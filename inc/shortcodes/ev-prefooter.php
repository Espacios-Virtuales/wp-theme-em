<?php

function ev_prefooter_shortcode($atts)
{
    $atts = shortcode_atts([
        'page' => 'sobre-nosotros',
    ], $atts, 'ev-prefooter');

    $target_page = get_page_by_path($atts['page']);
    $default_url = $target_page ? get_permalink($target_page->ID) : home_url('/');

    $data = blog_get_page(['pre-footer']);

    $title = '¿Quieres saber más?';
    $description = 'Descubre nuestros valores, propósito y camino de transformación.';
    $button_text = 'Sobre Nosotros';
    $button_url = $default_url;

    if ($data && $data->have_posts()) {
        while ($data->have_posts()) {
            $data->the_post();

            $acf_title = ev_get_field('prefooter_title', false, true, '');
            $acf_description = ev_get_field('prefooter_description', false, true, '');
            $acf_button_text = ev_get_field('prefooter_button_text', false, true, '');
            $acf_button_url = ev_get_field('prefooter_button_url', false, true, '');

            $title = !empty($acf_title) ? $acf_title : $title;
            $description = !empty($acf_description) ? $acf_description : $description;
            $button_text = !empty($acf_button_text) ? $acf_button_text : $button_text;
            $button_url = !empty($acf_button_url) ? $acf_button_url : $button_url;
        }

        wp_reset_postdata();
    }

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

                <a href="<?php echo esc_url($button_url); ?>" class="ev-prefooter__button btn btn-secondary btn-lg text-white">
                    <?php echo esc_html($button_text); ?>
                    <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
    </section>

    <?php
    return ob_get_clean();
}

add_shortcode('ev-prefooter', 'ev_prefooter_shortcode');