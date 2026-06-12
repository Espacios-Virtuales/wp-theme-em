<?php

// Propósito con slide y animaciones
function ev_about_purpose_shortcode()
{
    $purpose_group = ev_get_field('purpose_group', false, true, []);
    $purpose_group = is_array($purpose_group) ? $purpose_group : [];

    $purpose_items = $purpose_group['purpose_items'] ?? [];
    $purpose_items = is_array($purpose_items) ? $purpose_items : [];

    ob_start();
    ?>
    <section class="purpose-section py-5" id="purpose">
        <div class="purpose-section__veil"></div>

        <div class="container position-relative">
            <div class="purpose-section__header text-center mb-5">
                <span class="purpose-section__eyebrow" data-aos="fade-up">
                    Identidad y camino
                </span>

                <h2 class="text-center text-gold mb-4" data-aos="fade-up" data-aos-delay="100">
                    Nuestro Propósito
                </h2>

                <?php if (!empty($purpose_group['purpose_intro'])): ?>
                    <p class="purpose-section__intro text-center text-white" data-aos="fade-up" data-aos-delay="150">
                        <?php echo esc_html($purpose_group['purpose_intro']); ?>
                    </p>
                <?php endif; ?>
            </div>

            <?php if (!empty($purpose_items)): ?>
                <div id="purpose-carousel" class="carousel slide purpose-carousel" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php $index = 0; ?>
                        <?php foreach ($purpose_items as $item): ?>
                            <?php if (!is_array($item)) continue; ?>

                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="purpose-card shadow-lg" data-aos="zoom-in" data-aos-delay="200">
                                    <div class="card-header text-center">
                                        <div class="purpose-card__icon">
                                            <i class="bi bi-stars"></i>
                                        </div>

                                        <h5 class="mb-0 text-white">
                                            <?php echo esc_html($item['item_title'] ?? ''); ?>
                                        </h5>
                                    </div>

                                    <div class="card-body">
                                        <p>
                                            <?php echo esc_html($item['item_description'] ?? ''); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <?php $index++; ?>
                        <?php endforeach; ?>
                    </div>

                    <?php if (count($purpose_items) > 1): ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#purpose-carousel" data-bs-slide="prev" aria-label="Anterior">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#purpose-carousel" data-bs-slide="next" aria-label="Siguiente">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php

    return ob_get_clean();
}

add_shortcode('ev-about-purpose', 'ev_about_purpose_shortcode');