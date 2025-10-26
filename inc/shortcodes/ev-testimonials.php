<?php

function ev_page_testimonials_shortcode()
{
    
    // Obtener los testimonios
    $data = blog_get_custom_post_type('testimonial', 9);
    ob_start(); // 👈

    if ($data->have_posts()) {
    ?>
        <section class="testimonials section-ev py-5" id="testimonios" data-aos="fade-up">
            <div class="container-fluid">
                <div class="title text-center mb-4">
                    <h2 class="text-gold" data-aos="fade-up" data-aos-delay="100">Testimonios</h2>
                </div>

                <div id="testimonials-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php
                        $total_slides = ceil($data->post_count / 3);
                        for ($i = 0; $i < $total_slides; $i++) {
                        ?>
                            <button type="button" data-bs-target="#testimonials-carousel" data-bs-slide-to="<?php echo $i; ?>" <?php if ($i === 0) echo 'class="active"'; ?> aria-label="Slide <?php echo $i + 1; ?>"></button>
                        <?php } ?>
                    </div>

                    <div class="carousel-inner">
                        <?php
                        $counter = 0;
                        echo '<div class="carousel-item active"><div class="row justify-content-center">';

                        while ($data->have_posts()) {
                            $data->the_post();
                            $testimonial_link = get_post_meta(get_the_ID(), '_testimonial_link', true);
                        ?>
                            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="<?php echo 100 + ($counter % 3) * 200; ?>">
                                <div class="video-container ratio ratio-16x9 shadow rounded overflow-hidden">
                                    <?php if (!empty($testimonial_link)): ?>
                                        <iframe src="<?php echo esc_url($testimonial_link); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    <?php else: ?>
                                        <p class="text-muted">No hay video disponible.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php
                            $counter++;
                            if ($counter % 3 === 0 && $data->current_post + 1 < $data->post_count) {
                                echo '</div></div>';
                                echo '<div class="carousel-item"><div class="row justify-content-center">';
                            }
                        }
                        echo '</div></div>';
                        ?>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonials-carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonials-carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
        </section>
    <?php
        wp_reset_postdata();
        return ob_get_clean(); // 👈 SIEMPRE return

    } else {
    ?>
        <section class="testimonials-section py-5" id="testimonios">
            <div class="container text-center">
                <p class="text-muted">No hay testimonios disponibles.</p>
            </div>
        </section>
    <?php

    wp_reset_postdata();
    return ob_get_clean(); // 👈 SIEMPRE return
    }

}

add_shortcode('ev-testimonialss', 'ev_page_testimonials_shortcode');