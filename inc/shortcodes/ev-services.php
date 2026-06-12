<?php


// Landing Servicios 
function ev_services_hero_shortcode()
{
    $intro = ev_get_field('introductions', false, true, []);
    $intro = is_array($intro) ? $intro : [];

    $eyebrow = ev_get_field('services_hero_eyebrow', false, true, '');
    $cta_text = ev_get_field('services_hero_cta_text', false, true, '');
    $cta_url = ev_get_field('services_hero_cta_url', false, true, '');
    $secondary_text = ev_get_field('services_hero_secondary_text', false, true, '');
    $secondary_url = ev_get_field('services_hero_secondary_url', false, true, '');
    $note = ev_get_field('services_hero_note', false, true, '');

    $eyebrow = !empty($eyebrow) ? $eyebrow : 'Servicios Escuela Mística';
    $cta_text = !empty($cta_text) ? $cta_text : 'Explorar servicios';
    $cta_url = !empty($cta_url) ? $cta_url : '#servicios';
    $secondary_text = !empty($secondary_text) ? $secondary_text : 'Hablar con orientación';
    $secondary_url = !empty($secondary_url) ? $secondary_url : '#contact';
    $note = !empty($note) ? $note : 'Terapias, cursos, programas y experiencias para acompañar tu proceso con claridad y cuidado.';

    ob_start();
?>
    <section class="services-hero py-5 text-center text-light" data-aos="fade-up">
        <div class="services-hero__veil"></div>

        <div class="container position-relative">
            <span class="services-hero__eyebrow" data-aos="fade-up">
                <?php echo esc_html($eyebrow); ?>
            </span>

            <h1 class="display-4 fw-bold mb-3 text-gold ml9" data-aos="fade-down" data-aos-delay="100">
                <span class="text-wrapper">
                    <span class="letters"><?php echo esc_html($intro["intro_1"] ?? ''); ?></span>
                </span>
            </h1>

            <p class="lead mb-4" data-aos="fade-up" data-aos-delay="200">
                <?php echo esc_html($intro["intro_2"] ?? ''); ?>
            </p>

            <p class="services-hero__note" data-aos="fade-up" data-aos-delay="250">
                <?php echo esc_html($note); ?>
            </p>

            <div class="services-hero__actions" data-aos="fade-up" data-aos-delay="300">
                <a href="<?php echo esc_url($cta_url); ?>" class="btn services-hero__primary-btn">
                    <?php echo esc_html($cta_text); ?>
                    <i class="bi bi-arrow-right-short"></i>
                </a>

                <a href="<?php echo esc_url($secondary_url); ?>" class="btn services-hero__secondary-btn">
                    <i class="bi bi-whatsapp"></i>
                    <?php echo esc_html($secondary_text); ?>
                </a>
            </div>

            <div class="row justify-content-center mt-5 services-hero__pillars">
                <div class="col-12 col-md-4 col-lg-3 mb-3" data-aos="zoom-in" data-aos-delay="350">
                    <div class="services-hero__pillar">
                        <i class="bi bi-heart-fill"></i>
                        <p>Terapias</p>
                        <span>Acompañamiento individual</span>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mb-3" data-aos="zoom-in" data-aos-delay="450">
                    <div class="services-hero__pillar">
                        <i class="bi bi-mortarboard-fill"></i>
                        <p>Cursos & Talleres</p>
                        <span>Aprendizaje consciente</span>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mb-3" data-aos="zoom-in" data-aos-delay="550">
                    <div class="services-hero__pillar">
                        <i class="bi bi-arrow-repeat"></i>
                        <p>Programas</p>
                        <span>Procesos de transformación</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
    return ob_get_clean();
}

add_shortcode('ev-services-hero', 'ev_services_hero_shortcode');
function ev_services_value_shortcode()
{
    $values = ev_get_field('values_group', false, true, []); // Group: value_group
    $values = is_array($values) ? $values : [];
    ob_start();
?>
    <div class="value-section py-5">
        <h2 class="text-center text-primary mb-4" data-aos="fade-up">Nuestra Propuesta de Valor</h2>
        <p class="text-center text-muted mb-5" data-aos="fade-up" data-aos-delay="100"><?php echo esc_html($values['values_descriptions'] ?? ''); ?></p>
        <div class="row">
            <?php foreach (($values['values_items'] ?? []) as $item): ?>
                <?php if (!is_array($item)) continue; ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 h-100" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body text-center">
                            <i class="<?php echo esc_attr($item['value_icon'] ?? ''); ?> text-primary display-4 mb-3"></i>
                            <h5 class="text-primary"><?php echo esc_html($item['value_title'] ?? ''); ?></h5>
                            <p class="text-muted"><?php echo esc_html($item['value_text'] ?? ''); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('ev-services-value', 'ev_services_value_shortcode');

function ev_services_list_shortcode()
{
    $services_group = ev_get_field('services_group');
    ob_start();

    if (!$services_group || empty($services_group['services']) || !is_array($services_group['services'])) {
        return '<p class="text-muted text-center">No se encontraron servicios disponibles.</p>';
    }
?>
    <div class="services-list py-5">
        <h2 class="text-center text-primary mb-4" data-aos="fade-up">Nuestros Servicios</h2>
        <div class="row">
            <?php $delay = 100; ?>
            <?php foreach ($services_group['services'] as $service): ?>
                <?php if (!is_array($service)) continue; ?>

                <?php
                $modal_id = 'serviceModal_' . uniqid();
                $title = !empty($service['item_title']) ? esc_html($service['item_title']) : 'Servicio';
                $description = !empty($service['item_description']) ? esc_html($service['item_description']) : '';
                $full_description = !empty($service['item_full_description']) ? esc_html($service['item_full_description']) : '';
                $icon_class = !empty($service['item_icon']) ? esc_attr($service['item_icon']) : 'bi bi-circle';
                $video_link = !empty($service['item_link']) ? esc_url($service['item_link']) : '';
                $cta_link = !empty($service['item_cta_link']) ? esc_url($service['item_cta_link']) : '';
                $cta_text = !empty($service['item_cta_text']) ? esc_html($service['item_cta_text']) : 'Ver Detalles';
                ?>

                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                    <div class="card service-card shadow-lg border-0 h-100 text-center">
                        <div class="card-body">
                            <i class="<?php echo $icon_class; ?> text-primary display-4 mb-3"></i>
                            <h5 class="text-primary"><?php echo $title; ?></h5>
                            <p class="text-muted"><?php echo $description; ?></p>
                            <div class="row">
                                <div class="col">
                                    <?php if (!empty($video_link)): ?>
                                        <button
                                            type="button"
                                            class="btn btn-outline-primary mt-3 open-video-modal round-circle"
                                            data-bs-toggle="modal"
                                            data-bs-target="#<?php echo $modal_id; ?>"
                                            data-video="<?php echo $video_link; ?>">
                                            <i class="bi bi-play-circle-fill display-5"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                                <div class="col">
                                    <a
                                        class="btn btn-outline-primary mt-3 open-video-modal round-circle"
                                        href="<?php echo $cta_link; ?>">
                                        <i class="bi bi-arrow-right-circle-fill display-5"></i>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- Modal por servicio -->
                <div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" aria-labelledby="<?php echo $modal_id; ?>_label" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content bg-dark text-white rounded-4 shadow-lg">
                            <div class="modal-header border-0">
                                <h5 class="modal-title text-gold" id="<?php echo $modal_id; ?>_label"><?php echo $title; ?></h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <?php if ($full_description): ?>
                                    <p class="mb-4"><?php echo $full_description; ?></p>
                                <?php endif; ?>
                                <?php if ($video_link): ?>
                                    <div class="ratio ratio-16x9 mb-4">
                                        <iframe id="videoFrame_<?php echo $modal_id; ?>" src="" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                                    </div>
                                <?php endif; ?>
                                <?php if ($cta_link): ?>
                                    <div class="text-center">
                                        <a href="<?php echo $cta_link; ?>" class="btn btn-em-gold btn-lg shadow-sm">
                                            <?php echo $cta_text; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $delay += 100; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('ev-services-list', 'ev_services_list_shortcode');
