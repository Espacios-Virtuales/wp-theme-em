<?php

/**
 * Shortcodes
 */


function hero_slider_shortcode()
{
    ob_start();
?>
    <div id="hero" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicadores de la presentación -->
        <div class="carousel-indicators">
            <?php for ($i = 0; $i < 3; $i++) : ?>
                <button type="button" data-bs-target="#hero" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $i + 1; ?>"></button>
            <?php endfor; ?>
        </div>

        <!-- Hero dinámico con fondo oscuro y descripciones interactivas -->
        <div class="carousel-inner"> <!-- Eliminamos height h-100 para evitar problemas -->
            <?php
            $page_id = get_option('page_on_front');
            if ($page_id) {
                for ($i = 1; $i <= 3; $i++) {
                    $card = get_field("hero_$i", $page_id); // Extraemos los grupos hero_1, hero_2, etc.
                    if (!empty($card) && isset($card["image_$i"], $card["title_$i"], $card["body_$i"])) {
                        $image = $card["image_$i"];
                        $title = $card["title_$i"];
                        $body = $card["body_$i"];
                        $active_class = ($i === 1) ? 'active' : '';

                        if ($image) {
                            $image_url = wp_get_attachment_image_src($image, 'full')[0];
            ?>
                            <div class="carousel-item <?php echo esc_attr($active_class); ?>">
                                <div class="position-relative w-100 h-100">
                                    <img src="<?php echo esc_url($image_url); ?>" class="d-block w-100 h-100" style="object-fit: cover;" alt="Slide <?php echo esc_attr($i); ?>">
                                    <div class="carousel-caption d-flex flex-column justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);">
                                        <div class="container text-center">
                                            <!-- Título en animación -->
                                            <h5 class="text-white"><?php echo esc_html($title); ?></h5>
                                            <!-- Descripción interactiva que invita a la introspección -->
                                            <p class="lead text-white"><?php echo esc_html($body); ?></p>
                                            <!-- Botón hacia Spotify con efecto visual -->
                                            <button type="button" class="btn btn-em-gold btn-lg shadow-lg" data-bs-toggle="modal" data-bs-target="#subscribeModal">
                                                Suscribete <i class="bi bi-person-hearts me-2 text-white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
            <?php
                        }
                    }
                }
            }
            ?>
        </div>

        <!-- Controles de navegación del carousel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#hero" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hero" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Modal de suscripción -->
    <?php ev_subscribe_modal(); ?>

    <?php
    return ob_get_clean();
}
add_shortcode('ev-hero', 'hero_slider_shortcode');


// About Section con imágenes, Lightbox y Modal adaptado
function ev_about_shortcode()
{
    $data = blog_get_page(array('sobre-nosotros'));
    while ($data->have_posts()) {
        $data->the_post(); ?>

        <section id="about" class="mb-5 py-5">
            <div class="container shadow-custom rounded p-4 text-center">
                <?php $intro = get_field('introductions'); ?>
                <h2 class="display-6">
                    <?php echo esc_html($intro["intro_1"]); ?>
                </h2>
                <p class="lead">
                    <?php echo esc_html($intro["intro_2"]); ?>
                </p>

                <!-- Botón de suscripción -->
                <a href="https://calendly.com/momistica/asesoria-alquimiza" target="_blank" class="btn btn-em-gold btn-lg shadow-lg">
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
                    <h5 class="modal-title text-dark" id="subscribeModalLabel">Suscríbete a Nuevas Aventuras</h5> <!-- Texto en negro -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de contacto -->
                    <form id="modalContactForm" class="needs-validation mt-4" novalidate>
                        <div class="mb-3">
                            <label for="modalName" class="form-label text-dark">Nombre:</label> <!-- Texto en negro -->
                            <input type="text" class="form-control text-dark" id="modalName" name="contact_name" required minlength="3" placeholder="Ingresa tu nombre">
                            <div class="invalid-feedback">Ingrese un nombre con al menos 3 caracteres</div>
                        </div>
                        <div class="mb-3">
                            <label for="modalEmail" class="form-label text-dark">Correo Electrónico:</label> <!-- Texto en negro -->
                            <input type="email" class="form-control text-dark" id="modalEmail" name="contact_email" required placeholder="email@ejemplo.cl">
                            <div class="invalid-feedback">Ingrese un correo electrónico válido</div>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" id="subscribeCheck" name="contact_subscribe" value="yes" checked="checked">
                            <label class="form-check-label text-dark" for="subscribeCheck">
                                Deseo recibir actualizaciones y promociones
                            </label>
                        </div>
                        <button type="submit" class="btn btn-gold w-100">Enviar</button> <!-- Botón con color amarillo oro -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}

add_action('ev_modal_subscribe', 'blog_subscribe_modal');

// Servicios & Programas adaptado para Escuela Mística
function ev_servicios_shortcode()
{
    $data = blog_get_page(array('servicios'));

    while ($data->have_posts()) {
        $data->the_post();
        $intro = get_field('introductions');

    ?>
        <section class="bg-dark-blue text-light" id="servicios-programas"> <!-- Fondo azul oscuro y texto claro -->
            <div class="container">

                <!-- Carousel de Servicios -->
                <div id="carousel-servicios" class="carousel slide overflow-hidden rounded" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php for ($i = 0; $i < 3; $i++) { ?>
                            <button type="button" data-bs-target="#carousel-servicios" data-bs-slide-to="<?php echo $i; ?>" <?php echo ($i === 0) ? 'class="active"' : ''; ?> aria-label="Slide <?php echo $i + 1; ?>"></button>
                        <?php } ?>
                    </div>

                    <div class="carousel-inner">
                        <?php for ($i = 1; $i <= 3; $i++) {
                            $card = get_field('card_' . $i);
                            $image = $card['image_' . $i];
                            $title = $card['title_' . $i];
                            $body = $card['body_' . $i];
                            $link = $card['link_' . $i];
                        ?>
                            <div class="carousel-item <?php echo ($i === 1) ? 'active' : ''; ?>" data-bs-interval="8000">
                                <div class="card h-100 border-0 shadow-lg">
                                    <a href="<?php echo esc_url($link); ?>" target="_blank">
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" class="d-block w-100 rounded">
                                    </a>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h3 class="fs-4 fw-bold text-gold"><?php echo esc_html($title); ?></h3>
                                        <p class="text-light"><?php echo esc_html($body); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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
            <div class="container d-flex justify-content-center">
                <?php
                $servicios_page = get_page_by_path('servicios');
                $servicios_url = get_permalink($servicios_page->ID);
                ?>
                <a href="<?php echo esc_url($servicios_url); ?>" class="btn btn-em-gold btn-lg shadow-lg">
                    Accede a nuestros servicios
                </a>
            </div>
        </section>
        <?php
    }

    wp_reset_postdata();
}
add_shortcode('ev-servicios', 'ev_servicios_shortcode');

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
                                    <p class="fs-4 text-muted"><?php echo esc_html($description_group['maureen_thought']); ?></p>
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
                                        <div class="custom-rounded-btn bg-cyan">
                                            <a href="<?php echo esc_url($item_1['link_whatsapp']); ?>" target="_blank" class="d-flex justify-content-center align-items-center w-100 h-100 text-decoration-none" aria-label="Tribu Mistica WhatsApp">
                                                <i class="bi bi-whatsapp"></i>
                                            </a>
                                        </div>
                                        <div class="custom-rounded-btn bg-cyan">
                                            <a href="<?php echo esc_url($item_1['link_telegram']); ?>" target="_blank" class="d-flex justify-content-center align-items-center w-100 h-100 text-decoration-none" aria-label="Tribu Mistica Telegram">
                                                <i class="bi bi-telegram"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($item_2): ?>
                            <div class="col" data-aos="fade-up" data-aos-delay="400">
                                <div class="text-center">
                                    <h5 class="text-gold"><?php echo esc_html($item_2['title_2']); ?></h5>
                                    <p class="text-muted"><?php echo esc_html($item_2['description_2']); ?></p>
                                    <div class="custom-rounded-btn bg-cyan">
                                        <a href="<?php echo esc_url($item_2['link_whatsapp_2']); ?>" target="_blank" class="d-flex justify-content-center align-items-center w-100 h-100 text-decoration-none" aria-label="Momistica WhatsApp">
                                            <i class="bi bi-whatsapp"></i>
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
add_shortcode('ev-community_member', 'community_membership_gallery_shortcode');


// Función para crear el shortcode de calendario con eventos de ACF y modales
function blog_calendar_events_shortcode()
{
    $calendar = new Calendar(date('Y-m-d'));

    $data = blog_get_custom_post_type(array('evento'));
    $posts = $data->posts;

    foreach ($posts as $post) {
        $on = get_field('on', $post);
        $date = get_field('date', $post);

        if ($on && $date) {
            $calendar->add_event($post->post_title, $date, 1, $post->ID);
        }
    }

    ob_start();
    ?>
    <section class="container-bg pt-5 pb-5" id="eventos-calendar">
        <?= $calendar ?>
    </section>

    <?php
    foreach ($posts as $post) {
        $on = get_field('on', $post);
        $date = get_field('date', $post);

        if ($on && $date) {
            $modal_id = 'modal_' . $post->ID;
    ?>
            <div class="modal fade" id="<?= $modal_id ?>" tabindex="-1" aria-labelledby="<?= $modal_id ?>Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="<?= $modal_id ?>Label"><?= esc_html($post->post_title); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?= apply_filters('the_content', $post->post_content); ?>
                            <p><strong>Fecha:</strong> <?= get_field('date', $post); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a href="#" class="btn btn-primary">Comprar entradas</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    return ob_get_clean();
}
add_shortcode('ev-calendar_eventos', 'blog_calendar_events_shortcode');
function blog_page_testimonials_shortcode()
{
    // Obtener los testimonios
    $data = blog_get_custom_post_type('testimonial', 9);

    if ($data->have_posts()) {
        ?>
        <section class="testimonials-section py-5" id="testimonios">
            <div class="container">
                <div class="title text-center mb-4">
                    <h2 class="text-gold">Testimonios</h2>
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

                        echo '<div class="carousel-item active"><div class="row">';

                        while ($data->have_posts()) {
                            $data->the_post();
                            $testimonial_link = get_post_meta(get_the_ID(), '_testimonial_link', true);

                        ?>
                            <div class="col-md-4 mb-4">
                                <div class="video-container">
                                    <?php if (!empty($testimonial_link)): ?>
                                        <iframe width="100%" height="200" src="<?php echo esc_attr($testimonial_link); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <?php else: ?>
                                        <p class="text-muted">No hay video disponible.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php

                            $counter++;

                            if ($counter % 3 === 0 && $data->current_post + 1 < $data->post_count) {
                                echo '</div></div>';
                                echo '<div class="carousel-item"><div class="row">';
                            }
                        }

                        echo '</div></div>';
                        ?>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonials-carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonials-carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
    <?php
        wp_reset_postdata();
    } else {
    ?>
        <section class="testimonials-section py-5" id="testimonios">
            <div class="container text-center">
                <p class="text-muted">No hay testimonios disponibles.</p>
            </div>
        </section>
    <?php
    }
}

add_shortcode('ev-testimonios', 'blog_page_testimonials_shortcode');


function ev_intro_video_modal_shortcode()
{
    $link_video_intro = get_field('link_video_intro');

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

            $free_resources = get_field('free_resources_group');
            $youtube_link = $free_resources['youtube_link'];
            $podcast_link = $free_resources['podcast_link'];
            $ebook_description = $free_resources['ebook_description'];
            $podcast_description = $free_resources['podcast_description'];
            $youtube_description = $free_resources['youtube_description'];
            $calendly_link = $free_resources['calendly_link'];
    ?>
            <section class="free-resources py-5" id="free-resources">
                <div class="container">
                    <div class="title text-center mb-4">
                        <h2 class="text-gold">Recursos Gratuitos</h2>
                        <p class="text-muted">Explora lo que podemos ofrecerte.</p>
                    </div>
                    <div class="row g-4 justify-content-center">
                        <!-- YouTube -->
                        <?php if ($youtube_link): ?>
                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                                <div class="resource-item text-center shadow-sm">
                                    <h5 class="text-gold mt-3">Canal de YouTube</h5>
                                    <p class="text-muted"><?php echo esc_html($youtube_description); ?></p>
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
                                    <h5 class="text-gold mt-3">Podcast</h5>
                                    <p class="text-muted"><?php echo esc_html($podcast_description); ?></p>
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
                                    <h5 class="text-gold mt-3">Ebook Gratuito</h5>
                                    <p class="text-muted"><?php echo esc_html($ebook_description); ?></p>
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



// Contacto
function ev_contact_shortcode()
{
    $data = blog_get_page(array('contacto'));
    ob_start(); // Inicia la captura de salida

    while ($data->have_posts()) {
        $data->the_post();
        ?>
        <section id="contact" class="bg-primary text-light py-5">
            <div class="container"> <!-- Cambiado a container para ajustar el tamaño -->
                <div class="title text-center mb-5">
                    <h1 class="h1_tsn text-gold">¡Únete a este viaje!</h1>
                </div>

                <div class="row align-items-center">
                    <div class="col-md-5 order-md-2 mb-4 mb-md-0"> <!-- Imagen a la derecha en pantallas grandes -->
                        <div class="image-container">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="card-img-top w-50 mx-auto d-block shadow-lg" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-7 order-md-1">
                        <div class="p-4 rounded shadow-lg">
                            <h2 class="text-center text-white mb-4">Contacto</h2>
                            <form id="registerForm" class="needs-validation mt-4" action="#" method="post" novalidate>
                                <div class="mb-3">
                                    <label for="username" class="form-label text-white">Nombre:</label>
                                    <input type="text" class="form-control" id="username" name="username" required minlength="3" placeholder="Ingresa tu nombre" aria-label="Nombre">
                                    <div class="invalid-feedback">Por favor ingrese un nombre con al menos 3 caracteres</div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label text-white">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required placeholder="Ingresa tu email" aria-label="Email">
                                    <div class="invalid-feedback">Por favor ingresa un email válido</div>
                                </div>
                                <div class="mb-3">
                                    <label for="msj" class="form-label text-white">Mensaje:</label>
                                    <textarea class="form-control" id="msj" name="message" required rows="4" placeholder="Escribe tu mensaje" aria-label="Mensaje"></textarea>
                                    <div class="invalid-feedback">Por favor ingresa un mensaje válido</div>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="subscribeContact" name="subscribe" value="yes" checked="checked">
                                    <label class="form-check-label text-dark" for="subscribeContact">
                                        Deseo recibir actualizaciones y promociones
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }

    $output = ob_get_clean(); // Captura y limpia la salida
    return $output; // Devuelve el contenido capturado
}

add_shortcode('ev-contacto', 'ev_contact_shortcode');

/* About Us Landing Page */

// Hero

function ev_about_hero_shortcode()
{
    ?>
    <!-- Hero - Sobre Nosotros -->
    <section class="hero-about position-relative">
        <div class="container">
            <div class="row align-items-center">
                <!-- Texto de Introducción -->
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="text-gold hero-title text-gold">Sobre Nosotros</h1>
                    <p class="lead hero-description text-muted">
                        Conoce nuestra historia, misión, valores y el propósito que nos inspira cada día.
                    </p>
                </div>

                <!-- Imagen -->
                <div class="col-lg-6 text-center">
                    <?php if (has_post_thumbnail()) { ?>
                        <div class="hero-image-container">
                            <?php the_post_thumbnail('full', array('class' => 'hero-image')); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Ola decorativa -->
        <div class="hero-wave"></div>
    </section>
<?php

}

add_shortcode('ev-about-hero', 'ev_about_hero_shortcode');


// Propósito con slide y animaciones
function ev_about_purpose_shortcode()
{
    $purpose_group = get_field('purpose_group');
    ob_start();
?>
    <section class="purpose-section py-5">
        <div class="container">
            <h2 class="text-center text-gold mb-4">Nuestro Propósito</h2>
            <p class="text-center text-muted mb-5"><?php echo esc_html($purpose_group['purpose_intro']); ?></p>

            <div id="purpose-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $index = 0; ?>
                    <?php foreach ($purpose_group['purpose_items'] as $item): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="card shadow-lg purpose-card">
                                <div class="card-header text-center">
                                    <i class="bi bi-stars text-gold"></i>
                                    <h5 class="mb-0 text-white"><?php echo esc_html($item['item_title']); ?></h5>
                                </div>
                                <div class="card-body">
                                    <p><?php echo esc_html($item['item_description']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php $index++; ?>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#purpose-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#purpose-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>
<?php
    return ob_get_clean();
}
add_shortcode('ev-about-purpose', 'ev_about_purpose_shortcode');

// Misión y Visión con animaciones y slide responsivo
function ev_about_mission_vision_shortcode()
{
    $mission_vision_group = get_field('mission_vision_group');
    ob_start();
?>
    <section class="mission-vision-section py-5">
        <div class="container">
            <h2 class="text-center text-gold mb-4">Visión & Misión</h2>

            <div id="missionVisionCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Visión -->
                    <div class="carousel-item active">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="card shadow-lg vision-card">
                                    <div class="card-body">
                                        <h5 class="text-primary">Visión</h5>
                                        <p><?php echo esc_html($mission_vision_group['vision_text']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="<?php echo esc_url($mission_vision_group['vision_image']['url']); ?>" class="img-fluid rounded vision-image my-2" alt="Visión">
                            </div>
                        </div>
                    </div>
                    <!-- Misión -->
                    <div class="carousel-item">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="card shadow-lg mission-card">
                                    <div class="card-body">
                                        <h5 class="text-primary">Misión</h5>
                                        <p><?php echo esc_html($mission_vision_group['mission_text']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <img src="<?php echo esc_url($mission_vision_group['mission_image']['url']); ?>" class="img-fluid rounded mission-image my-2" alt="Misión">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Controles -->
                <button class="carousel-control-prev" type="button" data-bs-target="#missionVisionCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#missionVisionCarousel" data-bs-slide="next">
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
    $values_group = get_field('values_items');
    ob_start();
?>
    <section class="values-section py-5">
        <div class="container">
            <h2 class="text-center text-primary mb-4">Nuestros Valores</h2>
            <div class="row">
                <?php
                $delay = 0;
                foreach ($values_group as $value): ?>
                    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">
                        <div class="card shadow-lg h-100">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h5 class="text-primary text-center mb-3"><?php echo esc_html($value['value_title']); ?></h5>
                                <p class="text-center text-muted"><?php echo esc_html($value['value_text']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                    $delay += 100;
                endforeach; ?>
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
    $identity_group = get_field('identity_group');
    ob_start();
?>
    <section class="identity-section py-5">
        <div class="container">
            <h2 class="text-center text-gold mb-4">Nuestra Identidad</h2>
            <p class="text-center text-muted mb-5"><?php echo esc_html($identity_group['identity_intro']); ?></p>

            <?php if (!empty($identity_group['identity_items'])) : ?>
                <?php $first_item = array_shift($identity_group['identity_items']); // Extraer el primer ítem 
                ?>

                <!-- Hero de Identidad -->
                <div class="identity-hero text-center text-light py-5">
                    <div class="hero-content">
                        <h2 class="hero-title"><?php echo esc_html($first_item['archetype_title']); ?></h2>
                        <p class="hero-description"><?php echo esc_html($first_item['archetype_description']); ?></p>
                    </div>
                </div>

                <!-- Slider de Identidad -->
                <div id="identityCarousel" class="carousel slide mt-5" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php $index = 0; ?>
                        <?php foreach ($identity_group['identity_items'] as $item) : ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="card identity-card mx-auto">
                                    <div class="card-body text-center">
                                        <h5 class="text-primary"><?php echo esc_html($item['archetype_title']); ?></h5>
                                        <p><?php echo esc_html($item['archetype_description']); ?></p>
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


// Landing Servicios 

function ev_services_hero_shortcode()
{
    ob_start();
?>
    <section class="services-hero py-5 text-center text-light">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3 text-gold ml9">
                <span class="text-wrapper">
                    <span class="letters">Descubre Nuestros Servicios</span>
                </span>
            </h1>
            <p class="lead mb-4">Sanación, aprendizaje y transformación espiritual en un solo lugar.</p>
            <div class="row justify-content-center">
                <div class="col-4 col-md-2">
                    <i class="bi bi-heart-fill text-warning display-4"></i>
                    <p class="mt-2">Terapias</p>
                </div>
                <div class="col-4 col-md-2">
                    <i class="bi bi-mortarboard-fill text-warning display-4"></i>
                    <p class="mt-2">Cursos</p>
                </div>
                <div class="col-4 col-md-2">
                    <i class="bi bi-arrow-repeat text-warning display-4"></i>
                    <p class="mt-2">Programas</p>
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
    $values = get_field('values_group'); // Group: value_group
    ob_start();
?>
    <div class="value-section py-5">
        <h2 class="text-center text-primary mb-4">Nuestra Propuesta de Valor</h2>
        <p class="text-center text-muted mb-5"><?php echo esc_html($values['values_descriptions']); ?></p>
        <div class="row">
            <?php foreach ($values['values_items'] as $item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body text-center">
                            <i class="<?php echo esc_attr($item['value_icon']); ?> text-primary display-4 mb-3"></i>
                            <h5 class="text-primary"><?php echo esc_html($item['value_title']); ?></h5>
                            <p class="text-muted"><?php echo esc_html($item['value_text']); ?></p>
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
    $services_group = get_field('services_group');
    ob_start();
?>
    <div class="services-list py-5">
        <h2 class="text-center text-primary mb-4">Nuestros Servicios</h2>
        <div class="row">
            <?php $index = 0; ?>
            <?php foreach ($services_group['services'] as $service): ?>
                <div class="<?php echo $index === 0 ? 'col-12 mb-4' : 'col-md-4 mb-4'; ?>">
                    <div class="card service-card shadow-lg border-0 h-100 <?php echo $index === 0 ? 'text-center mx-auto' : ''; ?>">
                        <div class="card-body text-center">
                            <i class="<?php echo esc_attr($service['item_icon']); ?> text-primary display-4 mb-3"></i>
                            <h5 class="text-primary"><?php echo esc_html($service['item_title']); ?></h5>
                            <p class="text-muted"><?php echo esc_html($service['item_description']); ?></p>
                            <button
                                type="button"
                                class="btn btn-outline-primary mt-3 open-video-modal"
                                data-bs-toggle="modal"
                                data-bs-target="#videoModal"
                                data-video="<?php echo esc_url($service['item_link']); ?>">
                                Saber Más
                            </button>
                        </div>
                    </div>
                </div>
                <?php $index++; ?>
            <?php endforeach; ?>
        </div>

        <!-- Modal global -->
        <<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="videoModalLabel">Video del Servicio</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="ratio ratio-16x9">
                            <iframe id="videoFrame" src="" title="Video de servicio" allowfullscreen allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    </div>
<?php
    return ob_get_clean();
}
add_shortcode('ev-services-list', 'ev_services_list_shortcode');
