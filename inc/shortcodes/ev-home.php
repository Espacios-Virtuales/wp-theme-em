<?php

function hero_slider_shortcode()
{
    ob_start();
?>
    <div id="hero" class="carousel slide" data-bs-ride="carousel">
        <?php
        $page_id = get_option('page_on_front');
        $slides = [];

        if ($page_id) {
            for ($i = 1; $i <= 3; $i++) {
                $card = ev_get_field("hero_$i", $page_id);

                if (!empty($card) && is_array($card)) {
                    $image    = $card["image_$i"] ?? null;
                    $title    = $card["title_$i"] ?? '';
                    $body     = $card["body_$i"] ?? '';
                    $cta_text = $card["cta_text_$i"] ?? '';
                    $cta_url  = $card["cta_url_$i"] ?? '';

                    if (!empty($image) && (!empty($title) || !empty($body))) {
                        $slides[] = [
                            'index'    => $i,
                            'image'    => $image,
                            'title'    => $title,
                            'body'     => $body,
                            'cta_text' => $cta_text,
                            'cta_url'  => $cta_url,
                        ];
                    }
                }
            }
        }
        ?>

        <?php if (!empty($slides)) : ?>

            <div class="carousel-indicators">
                <?php foreach ($slides as $slide_index => $slide) : ?>
                    <button
                        type="button"
                        data-bs-target="#hero"
                        data-bs-slide-to="<?php echo esc_attr($slide_index); ?>"
                        class="<?php echo $slide_index === 0 ? 'active' : ''; ?>"
                        aria-current="<?php echo $slide_index === 0 ? 'true' : 'false'; ?>"
                        aria-label="Slide <?php echo esc_attr($slide_index + 1); ?>">
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="carousel-inner">
                <?php foreach ($slides as $slide_index => $slide) : ?>
                    <?php
                    $image_url = '';

                    if (is_numeric($slide['image'])) {
                        $image_url = wp_get_attachment_image_src($slide['image'], 'full')[0] ?? '';
                    } elseif (is_array($slide['image']) && !empty($slide['image']['url'])) {
                        $image_url = $slide['image']['url'];
                    } elseif (is_string($slide['image'])) {
                        $image_url = $slide['image'];
                    }
                    ?>

                    <?php if ($image_url) : ?>
                        <div class="carousel-item <?php echo $slide_index === 0 ? 'active' : ''; ?>">
                            <div class="position-relative w-100 h-100">
                                <img
                                    src="<?php echo esc_url($image_url); ?>"
                                    class="d-block w-100 h-100"
                                    style="object-fit: cover;"
                                    alt="<?php echo esc_attr($slide['title'] ?: 'Slide ' . $slide['index']); ?>">

                                <div class="carousel-caption">
                                    <div class="ev-hero-content">
                                        <?php if (!empty($slide['title'])) : ?>
                                            <h1><?php echo esc_html($slide['title']); ?></h1>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['body'])) : ?>
                                            <div class="ev-hero-body">
                                                <?php echo wp_kses_post($slide['body']); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($slide['cta_text']) && !empty($slide['cta_url'])) : ?>
                                            <div class="ev-hero-actions">
                                                <a href="<?php echo esc_url($slide['cta_url']); ?>" class="ev-btn ev-btn-primary">
                                                    <?php echo esc_html($slide['cta_text']); ?>
                                                </a>
                                            </div>

                                            <?php else : ?>
                                            <div class="ev-hero-actions">
                                                <button
                                                    type="button"
                                                    class="ev-btn ev-btn-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#subscribeModal">
                                                    Suscríbete
                                                </button>
                                            </div>

                                        <?php endif; ?>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <?php if (count($slides) > 1) : ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#hero" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#hero" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            <?php endif; ?>

        <?php endif; ?>
    </div>
    <?php ev_subscribe_modal(); ?>
    <?php
    return ob_get_clean();
}
add_shortcode('ev-hero', 'hero_slider_shortcode');

// About Section con imágenes, Lightbox y Modal adaptado + AOS
function ev_about_shortcode()
{
    $data = blog_get_page(array('sobre-nosotros'));
    while ($data->have_posts()) {
        $data->the_post(); ?>

        <section id="about" class="about section-ev py-5 mb-5" data-aos="fade-up">
            <div class="container-fluid shadow-custom rounded p-4 text-center">
                <?php
                $intro = ev_get_field('introductions', false, true, []);
                $intro = is_array($intro) ? $intro : [];
                ?>
                <h2 class="display-6" data-aos="fade-up" data-aos-delay="100">
                    <?php echo esc_html($intro["intro_1"] ?? ''); ?>
                </h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="200">
                    <?php echo esc_html($intro["intro_2"] ?? ''); ?>
                </p>

                <!-- Botón de suscripción -->
                <a href="https://calendly.com/momistica/asesoria" target="_blank" class="btn btn-em-gold btn-lg shadow-lg" data-aos="zoom-in" data-aos-delay="300">
                    Agenda <i class="bi bi-calendar rounded-circle d-none"></i>
                </a>
            </div>
        </section>

    <?php
    }
    wp_reset_postdata();
}
add_shortcode('ev-sobre_nosotros', 'ev_about_shortcode');


function ev_subscribe_modal()
{ ?>
    <!-- Modal de Bootstrap -->
    <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="subscribeModalLabel">Suscríbete a Nuevas Aventuras</h5> <!-- Texto en negro -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de contacto -->
                    <form id="modalContactForm" class="needs-validation mt-4" novalidate>
                        <div class="mb-3">
                            <label for="modalName" class="form-label text-white">Nombre:</label> <!-- Texto en negro -->
                            <input type="text" class="form-control text-white" id="modalName" name="contact_name" required minlength="3" placeholder="Ingresa tu nombre">
                            <div class="invalid-feedback">Ingrese un nombre con al menos 3 caracteres</div>
                        </div>
                        <div class="mb-3">
                            <label for="modalEmail" class="form-label text-white">Correo Electrónico:</label> <!-- Texto en negro -->
                            <input type="email" class="form-control text-white" id="modalEmail" name="contact_email" required placeholder="email@ejemplo.cl">
                            <div class="invalid-feedback">Ingrese un correo electrónico válido</div>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" id="subscribeCheck" name="contact_subscribe" value="yes" checked="checked">
                            <label class="form-check-label text-white" for="subscribeCheck">
                                Deseo recibir actualizaciones y promociones
                            </label>
                        </div>
                        <button type="submit" id="modalSubmitBtn" class="btn btn-gold w-100">Enviar</button> <!-- Botón con color amarillo oro -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}

add_action('ev_modal_subscribe', 'blog_subscribe_modal');

// Servicios & Programas adaptado para Escuela Mística + AOS
function ev_servicios_shortcode()
{
    $data = blog_get_page(array('servicios'));

    ob_start();

    while ($data->have_posts()) {
        $data->the_post();
        $intro = ev_get_field('introductions', false, true, []);
        $intro = is_array($intro) ? $intro : [];
    ?>
        <section class="servicios section-ev py-5 bg-dark-blue text-light " id="servicios-programas" data-aos="fade-up">
            <div class="container-fluid">

                <!-- Carousel de Servicios -->
                <div id="carousel-servicios" class="carousel slide overflow-hidden rounded" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php for ($i = 0; $i < 3; $i++) { ?>
                            <button type="button" data-bs-target="#carousel-servicios" data-bs-slide-to="<?php echo $i; ?>" <?php echo ($i === 0) ? 'class="active"' : ''; ?> aria-label="Slide <?php echo $i + 1; ?>"></button>
                        <?php } ?>
                    </div>

                    <div class="carousel-inner">
                        <?php for ($i = 1; $i <= 3; $i++):
                            // ACF puede devolver array, string o null. Normalizamos a array.
                            $card = ev_get_field('card_' . $i);
                            $card = is_array($card) ? $card : [];

                            // Leer con fallback y castear a string para evitar null
                            $image = (string) ($card['image_' . $i] ?? '');
                            $title = (string) ($card['title_' . $i] ?? '');
                            $body  = (string) ($card['body_' . $i]  ?? '');
                            $link  = (string) ($card['link_' . $i]  ?? '');

                            // Escapar (ya no hay nulls)
                            $image = esc_url($image);
                            $title = esc_html($title);
                            $body  = esc_html($body);
                            $link  = esc_url($link);

                            // Si no hay imagen, puedes saltarte el slide (opcional)
                            if ($image === '') continue;

                            // Construir apertura/cierre condicional del <a>
                            $hasLink = ($link !== '');
                            $aOpen  = $hasLink ? '<a href="' . $link . '" target="_blank" rel="noopener">' : '';
                            $aClose = $hasLink ? '</a>' : '';
                        ?>
                            <div class="carousel-item <?php echo ($i === 1) ? 'active' : ''; ?>" data-bs-interval="8000" data-aos="zoom-in" data-aos-delay="<?php echo $i * 200; ?>">
                                <div class="card h-100 border-0 shadow-lg">
                                    <?php echo $aOpen; ?>
                                    <img src="<?php echo $image; ?>" alt="<?php echo $title !== '' ? $title : 'Slide ' . $i; ?>" class="d-block w-100 rounded">
                                    <?php echo $aClose; ?>
                                    <?php if ($title !== '' || $body !== ''): ?>
                                        <div class="carousel-caption d-none d-md-block">
                                            <?php if ($title !== ''): ?><h3 class="fs-4 fw-bold text-gold"><?php echo $title; ?></h3><?php endif; ?>
                                            <?php if ($body  !== ''): ?><p class="text-light"><?php echo $body; ?></p><?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>

                    <!-- Controles del carousel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-servicios" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-servicios" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>

            <!-- Llamado a la acción -->
            <div class="container d-flex justify-content-center mt-4" data-aos="fade-up" data-aos-delay="600">
                <?php
                $servicios_page = get_page_by_path('servicios');
                $servicios_url = $servicios_page ? get_permalink($servicios_page->ID) : home_url('/');
                ?>
                <a href="<?php echo esc_url($servicios_url); ?>" class="btn btn-em-gold btn-lg shadow-lg">
                    Accede a nuestros servicios
                </a>
            </div>
        </section>
    <?php
    }

    wp_reset_postdata();
    return ob_get_clean(); // 👈 SIEMPRE return

}
add_shortcode('ev-servicios', 'ev_servicios_shortcode');



function ev_intro_video_modal_shortcode()
{
    $link_video_intro = ev_get_field('link_video_intro');

    ob_start(); ?>
    <!-- Modal -->
    <div class="modal fade" id="IntroVideoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white" id="videoModalLabel">Escuela Mistica</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe src="<?php echo esc_url($link_video_intro); ?>" title="Introduccion Escuela Misitica" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ev-intro_video_modal', 'ev_intro_video_modal_shortcode');


function ev_free_resources_shortcode()
{
    $data = blog_get_page(array('recursos-gratuitos'));

    if ($data->have_posts()) {
        ob_start();

        while ($data->have_posts()) {
            $data->the_post();

            $free_resources = ev_get_field('free_resources_group', false, true, []);
            $free_resources = is_array($free_resources) ? $free_resources : [];
            $youtube_link = $free_resources['youtube_link'] ?? '';
            $podcast_link = $free_resources['podcast_link'] ?? '';
            $ebook_description = $free_resources['ebook_description'] ?? '';
            $podcast_description = $free_resources['podcast_description'] ?? '';
            $youtube_description = $free_resources['youtube_description'] ?? '';
            $calendly_link = $free_resources['calendly_link'] ?? '';
    ?>
            <section class="free-resources section-ev py-5" id="free-resources">
                <div class="container-fluid">
                    <div class="title text-center mb-4">
                        <h2 class="text-gold">Recursos Gratuitos</h2>
                        <p class="text-white">Explora lo que podemos ofrecerte.</p>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <!-- YouTube -->
                        <?php if ($youtube_link): ?>
                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                                <div class="resource-item text-center shadow-sm">
                                    <h5 class="text-primary mt-3">Canal de YouTube</h5>
                                    <p class="text-dark"><?php echo esc_html($youtube_description); ?></p>
                                    <div class="custom-rounded-btn bg-cyan">
                                        <a href="<?php echo esc_url($youtube_link); ?>" target="_blank" class="d-flex justify-content-center align-items-center w-100 h-100 text-decoration-none" aria-label="Canal de YouTube">
                                            <i class="bi bi-youtube"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Podcast -->
                        <?php if ($podcast_link): ?>
                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                                <div class="resource-item text-center shadow-sm">
                                    <h5 class="text-primary mt-3">Podcast</h5>
                                    <p class="text-dark"><?php echo esc_html($podcast_description); ?></p>
                                    <div class="custom-rounded-btn bg-cyan ">
                                        <a href="<?php echo esc_url($podcast_link); ?>" target="_blank" class="d-flex justify-content-center align-items-center w-100 h-100 text-decoration-none" aria-label="Canal de Spotify">
                                            <i class="bi bi-mic-fill"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Ebook + Calendly -->
                        <?php if ($ebook_description && $calendly_link): ?>
                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                                <div class="resource-item text-center shadow-sm">
                                    <h5 class="text-primary mt-3">Ebook Gratuito</h5>
                                    <p class="text-dark"><?php echo esc_html($ebook_description); ?></p>
                                    <div class="custom-rounded-btn bg-cyan">
                                        <a href="<?php echo esc_url($calendly_link); ?>" target="_blank" class="d-flex justify-content-center align-items-center w-100 h-100 text-decoration-none" aria-label="Agenda">
                                            <i class="bi bi-book-fill"></i>
                                        </a>
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
add_shortcode('ev-free_resources', 'ev_free_resources_shortcode');
