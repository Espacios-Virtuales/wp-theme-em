<?php

function ev_page_testimonials_shortcode()
{
    $data = blog_get_custom_post_type('testimonial', 9);
    ob_start();

    if ($data->have_posts()) {
        ?>
        <section class="testimonials section-ev py-5" id="testimonios" data-aos="fade-up">
            <div class="testimonials__veil"></div>

            <div class="container position-relative">
                <div class="title testimonials__header text-center mb-5">
                    <span class="testimonials__eyebrow" data-aos="fade-up">
                        Voces del proceso
                    </span>

                    <h2 class="text-gold" data-aos="fade-up" data-aos-delay="100">
                        Testimonios
                    </h2>

                    <p class="testimonials__intro" data-aos="fade-up" data-aos-delay="150">
                        Experiencias reales de personas que han vivido procesos de aprendizaje,
                        sanación y transformación en Escuela Mística.
                    </p>
                </div>

                <div id="testimonials-carousel" class="carousel slide testimonials-carousel" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php
                        $total_slides = ceil($data->post_count / 3);

                        for ($i = 0; $i < $total_slides; $i++) {
                            ?>
                            <button
                                type="button"
                                data-bs-target="#testimonials-carousel"
                                data-bs-slide-to="<?php echo esc_attr($i); ?>"
                                <?php echo $i === 0 ? 'class="active" aria-current="true"' : ''; ?>
                                aria-label="Slide <?php echo esc_attr($i + 1); ?>">
                            </button>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="carousel-inner">
                        <?php
                        $counter = 0;

                        echo '<div class="carousel-item active"><div class="row justify-content-center g-4">';

                        while ($data->have_posts()) {
                            $data->the_post();

                            $testimonial_link = get_post_meta(get_the_ID(), '_testimonial_link', true);
                            $testimonial_title = get_the_title();
                            ?>
                            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="<?php echo esc_attr(100 + ($counter % 3) * 100); ?>">
                                <article class="testimonial-card h-100">
                                    <div class="testimonial-card__label">
                                        <i class="bi bi-play-circle"></i>
                                        <span><?php echo esc_html($testimonial_title); ?></span>
                                    </div>

                                    <div class="video-container ratio ratio-16x9 shadow rounded overflow-hidden">
                                        <?php if (!empty($testimonial_link)) : ?>
                                            <iframe
                                                src="<?php echo esc_url($testimonial_link); ?>"
                                                title="<?php echo esc_attr($testimonial_title); ?>"
                                                frameborder="0"
                                                loading="lazy"
                                                allow="autoplay; encrypted-media; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        <?php else : ?>
                                            <div class="testimonial-card__empty">
                                                <i class="bi bi-camera-video-off"></i>
                                                <p class="text-muted">No hay video disponible.</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </article>
                            </div>
                            <?php

                            $counter++;

                            if ($counter % 3 === 0 && $data->current_post + 1 < $data->post_count) {
                                echo '</div></div>';
                                echo '<div class="carousel-item"><div class="row justify-content-center g-4">';
                            }
                        }

                        echo '</div></div>';
                        ?>
                    </div>

                    <?php if ($total_slides > 1) : ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonials-carousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#testimonials-carousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php

        wp_reset_postdata();
        return ob_get_clean();
    }
    ?>

    <section class="testimonials testimonials-section py-5" id="testimonios">
        <div class="container text-center">
            <p class="text-muted">No hay testimonios disponibles.</p>
        </div>
    </section>

    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

add_shortcode('ev-testimonials', 'ev_page_testimonials_shortcode');