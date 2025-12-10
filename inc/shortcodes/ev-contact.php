<?php

// Contacto
function ev_contact_shortcode()
{
    $data = blog_get_page(array('contacto'));
    ob_start(); // Inicia la captura de salida

    while ($data->have_posts()) {
        $data->the_post();
        ?>
        <section id="contact" class="bg-primary text-light py-5" data-aos="fade-up">
            <div class="container-fluid">
                <div class="title text-center mb-5">
                    <h1 class="h1_tsn text-gold" data-aos="fade-up" data-aos-delay="100">¡Únete a este viaje!</h1>
                </div>

                <div class="row align-items-center">
                    <!-- Imagen destacada -->
                    <div class="col-md-5 order-md-2 mb-4 mb-md-0" data-aos="fade-left" data-aos-delay="300">
                        <div class="image-container text-center">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="card-img-top w-75 mx-auto d-block shadow-lg rounded" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Formulario -->
                    <div class="col-md-7 order-md-1" data-aos="fade-right" data-aos-delay="200">
                        <div class="p-4 rounded shadow-lg bg-dark-blue">
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
                                    <input class="form-check-input" type="checkbox" id="subscribeContact" name="subscribe" value="yes" checked>
                                    <label class="form-check-label text-dark" for="subscribeContact">
                                        Deseo recibir actualizaciones y promociones
                                    </label>
                                </div>

                                <button type="submit"  id="contactSubmit" class="btn btn-em-gold w-100">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }

    $output = ob_get_clean();
    return $output;
}

add_shortcode('ev-contacto', 'ev_contact_shortcode');
