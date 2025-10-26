<?php

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


// About Section con imágenes, Lightbox y Modal adaptado + AOS
function ev_about_shortcode()
{
    $data = blog_get_page(array('sobre-nosotros'));
    while ($data->have_posts()) {
        $data->the_post(); ?>

        <section id="about" class="about section-ev py-5 mb-5" data-aos="fade-up">
            <div class="container-fluid shadow-custom rounded p-4 text-center">
                <?php $intro = get_field('introductions'); ?>
                <h2 class="display-6" data-aos="fade-up" data-aos-delay="100">
                    <?php echo esc_html($intro["intro_1"]); ?>
                </h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="200">
                    <?php echo esc_html($intro["intro_2"]); ?>
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
                        <button type="submit" class="btn btn-gold w-100">Enviar</button> <!-- Botón con color amarillo oro -->
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

    while ($data->have_posts()) {
        $data->the_post();
        $intro = get_field('introductions');
    ?>
        <section class="servicios section-ev py-5 bg-dark-blue text-light " id="servicios-programas" data-aos="fade-up">
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
                            <div class="carousel-item <?php echo ($i === 1) ? 'active' : ''; ?>" data-bs-interval="8000" data-aos="zoom-in" data-aos-delay="<?php echo $i * 200; ?>">
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
            <div class="container d-flex justify-content-center mt-4" data-aos="fade-up" data-aos-delay="600">
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

function ev_page_testimonials_shortcode()
{
    // Obtener los testimonios
    $data = blog_get_custom_post_type('testimonial', 9);

    if ($data->have_posts()) {
    ?>
        <section class="testimonials section-ev py-5" id="testimonios" data-aos="fade-up">
            <div class="container">
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

add_shortcode('ev-testimonios', 'ev_page_testimonials_shortcode');


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
            <section class="free-resources section-ev py-5" id="free-resources">
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
