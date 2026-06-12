<?php

// Contacto
function ev_contact_shortcode()
{
    $data = blog_get_page(['contacto']);
    ob_start();

    while ($data->have_posts()) {
        $data->the_post();
        ?>
        <section id="contact" class="bg-primary text-light py-5" data-aos="fade-up">
            <div class="container">
                <div class="title text-center mb-5">
                    <span class="contact-eyebrow" data-aos="fade-up">
                        Escuela Mística
                    </span>

                    <h1 class="h1_tsn text-gold" data-aos="fade-up" data-aos-delay="100">
                        Conversemos tu proceso
                    </h1>

                    <p class="contact-intro" data-aos="fade-up" data-aos-delay="150">
                        Escríbenos para recibir orientación sobre terapias, cursos, programas o experiencias.
                        Te acompañaremos a encontrar el camino más coherente para tu momento actual.
                    </p>
                </div>

                <div class="row align-items-stretch g-4">
                    <!-- Contexto corporativo -->
                    <div class="col-lg-5 order-lg-2" data-aos="fade-left" data-aos-delay="300">
                        <div class="contact-context h-100">
                            <div class="contact-context__icon">
                                <i class="bi bi-stars"></i>
                            </div>

                            <h2>Un primer puente de orientación</h2>

                            <p>
                                Este formulario abre un canal directo con Escuela Mística para ordenar tu consulta,
                                comprender tu necesidad y derivarte hacia la experiencia más adecuada.
                            </p>

                            <div class="contact-feature">
                                <i class="bi bi-compass"></i>
                                <div>
                                    <strong>Orientación consciente</strong>
                                    <span>Revisamos tu mensaje para sugerir el servicio o ruta más alineada.</span>
                                </div>
                            </div>

                            <div class="contact-feature">
                                <i class="bi bi-shield-check"></i>
                                <div>
                                    <strong>Marco seguro y ético</strong>
                                    <span>Cuidamos la claridad, la confidencialidad y el respeto por tu proceso.</span>
                                </div>
                            </div>

                            <div class="contact-feature">
                                <i class="bi bi-calendar-heart"></i>
                                <div>
                                    <strong>Derivación práctica</strong>
                                    <span>Podemos orientarte hacia terapias, programas, cursos o experiencias.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario -->
                    <div class="col-lg-7 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                        <div class="contact-form-shell p-4 rounded shadow-lg bg-dark-blue h-100">
                            <h2 class="text-center text-white mb-2">Contacto</h2>
                            <p class="text-center contact-form-subtitle">
                                Cuéntanos qué estás buscando y te responderemos con claridad.
                            </p>

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
                                    <label class="form-check-label text-white" for="subscribeContact">
                                        Deseo recibir novedades, recursos y actualizaciones de Escuela Mística
                                    </label>
                                </div>

                                <button type="submit" id="contactSubmit" class="btn btn-em-gold w-100">
                                    Enviar mensaje
                                </button>
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