<?php

/* About Us Landing Page */

// Hero

function ev_about_hero_shortcode()
{
?>
    <!-- Hero - Sobre Nosotros -->
    <section class="hero-about position-relative" data-aos="fade-up">
        <div class="container">
            <?php
            $intro = ev_get_field('introductions', false, true, []);
            $intro = is_array($intro) ? $intro : [];
            ?>

            <div class="row align-items-center">
                <!-- Texto de Introducción -->
                <div class="col-lg-6 text-center text-lg-start" data-aos="fade-right" data-aos-delay="100">
                    <h1 class="text-gold hero-title"><?php echo esc_html($intro["intro_1"] ?? ''); ?></h1>
                    <p class="lead hero-description text-muted">
                        <?php echo esc_html($intro["intro_2"] ?? ''); ?>
                    </p>
                </div>

                <!-- Imagen -->
                <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-delay="200">
                    <?php if (has_post_thumbnail()) { ?>
                        <div class="hero-image-container">
                            <?php the_post_thumbnail('full', array('class' => 'hero-image')); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php

}

add_shortcode('ev-about-hero', 'ev_about_hero_shortcode');


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

// Misión y Visión con animaciones y slide responsivo
function ev_about_mission_vision_shortcode()
{
    $mission_vision_group = ev_get_field('mission_vision_group', false, true, []);
    $mission_vision_group = is_array($mission_vision_group) ? $mission_vision_group : [];

    $vision_image = $mission_vision_group['vision_image'] ?? [];
    $vision_image = is_array($vision_image) ? $vision_image : [];

    $mission_image = $mission_vision_group['mission_image'] ?? [];
    $mission_image = is_array($mission_image) ? $mission_image : [];

    ob_start();
    ?>
    <section class="mission-vision-section py-5" id="mission-vision">
        <div class="mission-vision-section__veil"></div>

        <div class="container position-relative">
            <div class="mission-vision-section__header text-center mb-5">
                <span class="mission-vision-section__eyebrow" data-aos="fade-up">
                    Dirección y sentido
                </span>

                <h2 class="text-center text-gold mb-3" data-aos="fade-up" data-aos-delay="100">
                    Visión & Misión
                </h2>

                <p class="mission-vision-section__intro" data-aos="fade-up" data-aos-delay="150">
                    La visión orienta el horizonte. La misión sostiene el camino cotidiano.
                </p>
            </div>

            <div id="missionVisionCarousel" class="carousel slide mission-vision-carousel" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <!-- Visión -->
                    <div class="carousel-item active">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                                <div class="card shadow-lg vision-card mission-vision-card h-100">
                                    <div class="card-body">
                                        <div class="mission-vision-card__icon">
                                            <i class="bi bi-eye"></i>
                                        </div>

                                        <h5 class="text-primary">Visión</h5>

                                        <p>
                                            <?php echo esc_html($mission_vision_group['vision_text'] ?? ''); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-delay="250">
                                <?php if (!empty($vision_image['url'])): ?>
                                    <img
                                        src="<?php echo esc_url($vision_image['url']); ?>"
                                        class="img-fluid rounded vision-image mission-vision-image my-2"
                                        alt="<?php echo esc_attr($vision_image['alt'] ?? 'Visión Escuela Mística'); ?>"
                                    >
                                <?php else: ?>
                                    <div class="mission-vision-symbol">
                                        <i class="bi bi-stars"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Misión -->
                    <div class="carousel-item">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                                <div class="card shadow-lg mission-card mission-vision-card h-100">
                                    <div class="card-body">
                                        <div class="mission-vision-card__icon">
                                            <i class="bi bi-compass"></i>
                                        </div>

                                        <h5 class="text-primary">Misión</h5>

                                        <p>
                                            <?php echo esc_html($mission_vision_group['mission_text'] ?? ''); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-delay="250">
                                <?php if (!empty($mission_image['url'])): ?>
                                    <img
                                        src="<?php echo esc_url($mission_image['url']); ?>"
                                        class="img-fluid rounded mission-image mission-vision-image my-2"
                                        alt="<?php echo esc_attr($mission_image['alt'] ?? 'Misión Escuela Mística'); ?>"
                                    >
                                <?php else: ?>
                                    <div class="mission-vision-symbol">
                                        <i class="bi bi-gem"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controles -->
                <button class="carousel-control-prev" type="button" data-bs-target="#missionVisionCarousel" data-bs-slide="prev" aria-label="Anterior">
                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#missionVisionCarousel" data-bs-slide="next" aria-label="Siguiente">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>
    <?php

    return ob_get_clean();
}

add_shortcode('ev-about-mission-vision', 'ev_about_mission_vision_shortcode');

// Valores
function ev_about_values_shortcode()
{
    $values_group = ev_get_field('values_items', false, true, []);
    $values_group = is_array($values_group) ? $values_group : [];

    ob_start();
?>
    <section class="values-section py-5">
        <div class="container">
            <div class="values-section__header text-center mb-5">
                <span class="values-section__eyebrow">Marco ético</span>
                <h2 class="text-center text-primary mb-4">Nuestros Valores</h2>
                <p class="values-section__intro">
                    Principios que sostienen la experiencia, el acompañamiento y la coherencia de Escuela Mística.
                </p>
            </div>

            <div class="row">
                <?php
                $delay = 0;
                $count = 1;

                foreach ($values_group as $value): ?>
                    <?php if (!is_array($value)) continue; ?>

                    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">
                        <div class="card values-card shadow-lg h-100">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <div class="values-card__icon">
                                    <i class="bi bi-gem"></i>
                                </div>

                                <span class="values-card__number">
                                    <?php echo esc_html(str_pad((string) $count, 2, '0', STR_PAD_LEFT)); ?>
                                </span>

                                <h5 class="text-primary text-center mb-3">
                                    <?php echo esc_html($value['value_title'] ?? ''); ?>
                                </h5>

                                <p class="text-center text-muted">
                                    <?php echo esc_html($value['value_text'] ?? ''); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                <?php
                    $delay += 100;
                    $count++;
                endforeach;
                ?>
            </div>
        </div>
    </section>
<?php
    return ob_get_clean();
}
add_shortcode('ev-about-values', 'ev_about_values_shortcode');

// Identidad
function ev_about_identity_shortcode()
{
    $identity_group = ev_get_field('identity_group', false, true, []);
    $identity_group = is_array($identity_group) ? $identity_group : [];
    ob_start();
?>
    <section class="identity-section py-5">
        <div class="container">
            <h2 class="text-center text-gold mb-4">Nuestra Identidad</h2>
            <p class="text-center text-muted mb-5"><?php echo esc_html($identity_group['identity_intro'] ?? ''); ?></p>

            <?php if (!empty($identity_group['identity_items']) && is_array($identity_group['identity_items'])) : ?>
                <?php $first_item = array_shift($identity_group['identity_items']); // Extraer el primer ítem 
                ?>

                <!-- Hero de Identidad -->
                <div class="identity-hero text-center text-light py-5">
                    <div class="hero-content">
                        <h2 class="hero-title"><?php echo esc_html($first_item['archetype_title'] ?? ''); ?></h2>
                        <p class="hero-description"><?php echo esc_html($first_item['archetype_description'] ?? ''); ?></p>
                    </div>
                </div>

                <!-- Slider de Identidad -->
                <div id="identityCarousel" class="carousel slide mt-5" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php $index = 0; ?>
                        <?php foreach ($identity_group['identity_items'] as $item) : ?>
                            <?php if (!is_array($item)) continue; ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="card identity-card mx-auto">
                                    <div class="card-body text-center">
                                        <h5 class="text-primary"><?php echo esc_html($item['archetype_title'] ?? ''); ?></h5>
                                        <p><?php echo esc_html($item['archetype_description'] ?? ''); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php $index++; ?>
                        <?php endforeach; ?>
                    </div>
                    <!-- Controles del Slider -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#identityCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#identityCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php
    return ob_get_clean();
}
add_shortcode('ev-about-identity', 'ev_about_identity_shortcode');
