<?php

// Función para crear el shortcode de comunidad y membresía optimizado
function community_membership_gallery_shortcode()
{
    // Obtener datos de la página con el slug 'membresia-comunidad'
    $data = blog_get_page(array('membresia-comunidad'));

    if ($data->have_posts()) {
        ob_start();

        while ($data->have_posts()) {
            $data->the_post();

            // Obtener los datos necesarios
            $intro = get_field('introductions');
            $description_group = get_field('description_group');
            $community_items = get_field('community_comunity_group');

            $item_1 = $community_items['item_1'];
            $item_2 = $community_items['item_2'];
        ?>
            <section class="community-membership py-5" id="community">
                <div class="container">
                    <div class="text-center mb-4">
                        <h2 class="text-gold display-6" data-aos="fade-up"><?php echo esc_html($intro["intro_1"]); ?></h2>
                        <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100"><?php echo esc_html($intro["intro_2"]); ?></p>
                    </div>
                    <?php if ($description_group): ?>
                        <div class="row align-items-center mb-5" data-aos="fade-up" data-aos-delay="200">
                            <div class="col-md-4 text-center">
                                <?php if ($description_group['maureen_image']): ?>
                                    <img src="<?php echo esc_url($description_group['maureen_image']['url']); ?>" alt="<?php echo esc_attr($description_group['maureen_image']['alt']); ?>" class="img-fluid rounded-circle maureen-photo">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-8">
                                <blockquote class="maureen-thought text-center text-md-start">
                                    <p class="fs-4 text-white"><?php echo esc_html($description_group['maureen_thought']); ?></p>
                                </blockquote>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">
                        <?php if ($item_1): ?>
                            <div class="col" data-aos="fade-up" data-aos-delay="300">
                                <div class="text-center">
                                    <?php if ($item_1['image']): ?>
                                        <img src="<?php echo esc_url($item_1['image']['url']); ?>" alt="<?php echo esc_attr($item_1['image']['alt']); ?>" class="img-fluid rounded community-icon mb-3">
                                    <?php endif; ?>
                                    <h5 class="text-gold"><?php echo esc_html($item_1['title']); ?></h5>
                                    <p class="text-muted"><?php echo esc_html($item_1['description']); ?></p>
                                    <div class="d-flex justify-content-center gap-3 mt-3">
                                            <button
                                                type="button"
                                                class="d-flex justify-content-center align-items-center w-100 h-100 ustom-rounded-btn bg-cyan"
                                                data-bs-toggle="modal"
                                                data-bs-target="#subscribeModal">
                                                <i class="bi bi-whatsapp"></i>
                                            </button>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
    <?php
        }

        wp_reset_postdata();
        return ob_get_clean();
    } else {
        return '<p class="text-muted text-center">No se encontró contenido para esta sección.</p>';
    }
}
add_shortcode('ev-community_member', 'community_membership_gallery_shortcode');