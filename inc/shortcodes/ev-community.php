<?php
function community_membership_gallery_shortcode()
{
    $data = blog_get_page(['membresia-comunidad']);

    if (!$data->have_posts()) {
        return '<p class="text-muted text-center">No se encontró contenido para esta sección.</p>';
    }

    ob_start();

    while ($data->have_posts()) {
        $data->the_post();

        $intro = ev_get_field('introductions', false, true, []);
        $intro = is_array($intro) ? $intro : [];

        $description_group = ev_get_field('description_group', false, true, []);
        $description_group = is_array($description_group) ? $description_group : [];

        $community_items = ev_get_field('community_comunity_group', false, true, []);
        $community_items = is_array($community_items) ? $community_items : [];

        $items = [
            $community_items['item_1'] ?? [],
            $community_items['item_2'] ?? [],
        ];
        ?>

        <section class="community-membership py-5" id="community">
            <div class="community-membership__veil"></div>

            <div class="container position-relative">
                <div class="community-membership__header text-center mb-5">
                    <span class="community-membership__eyebrow" data-aos="fade-up">
                        Comunidad viva
                    </span>

                    <h2 class="text-gold display-6" data-aos="fade-up">
                        <?php echo esc_html($intro['intro_1'] ?? ''); ?>
                    </h2>

                    <p class="lead text-white" data-aos="fade-up" data-aos-delay="100">
                        <?php echo esc_html($intro['intro_2'] ?? ''); ?>
                    </p>
                </div>

                <?php if ($description_group): ?>
                    <div class="community-membership__founder row align-items-center mb-5" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <?php if (!empty($description_group['maureen_image']) && is_array($description_group['maureen_image'])): ?>
                                <img
                                    src="<?php echo esc_url($description_group['maureen_image']['url'] ?? ''); ?>"
                                    alt="<?php echo esc_attr($description_group['maureen_image']['alt'] ?? 'Maureen Escuela Mística'); ?>"
                                    class="img-fluid rounded-circle maureen-photo"
                                >
                            <?php endif; ?>
                        </div>

                        <div class="col-md-8">
                            <blockquote class="maureen-thought text-center text-md-start">
                                <p class="fs-4 text-dark">
                                    <?php echo esc_html($description_group['maureen_thought'] ?? ''); ?>
                                </p>
                            </blockquote>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">
                    <?php foreach ($items as $index => $item): ?>
                        <?php if (!empty($item) && is_array($item)): ?>
                            <div class="col" data-aos="fade-up" data-aos-delay="<?php echo esc_attr(300 + ($index * 100)); ?>">
                                <article class="community-card h-100">
                                    <?php if (!empty($item['image']) && is_array($item['image'])): ?>
                                        <div class="community-card__image-wrap">
                                            <img
                                                src="<?php echo esc_url($item['image']['url'] ?? ''); ?>"
                                                alt="<?php echo esc_attr($item['image']['alt'] ?? 'Comunidad Escuela Mística'); ?>"
                                                class="img-fluid rounded community-icon"
                                            >
                                        </div>
                                    <?php endif; ?>

                                    <div class="community-card__body">
                                        <h5 class="text-gold">
                                            <?php echo esc_html($item['title'] ?? ''); ?>
                                        </h5>

                                        <p class="text-white">
                                            <?php echo esc_html($item['description'] ?? ''); ?>
                                        </p>

                                        <div class="community-card__actions">
                                            <button
                                                type="button"
                                                class="ev-community-cta"
                                                data-bs-toggle="modal"
                                                data-bs-target="#subscribeModal"
                                            >
                                                <i class="bi bi-whatsapp"></i>
                                                <span>Unirme a la comunidad</span>
                                            </button>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php
    }

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('ev-community_member', 'community_membership_gallery_shortcode');