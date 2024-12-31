<?php
/*
Template Name: Servicios
*/

get_header(); ?>

<div class="page-servicios">

    <!-- Hero Section -->
    <section class="hero-section mb-5">
        <?php echo do_shortcode('[ev-services-hero]'); ?>
    </section>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Introducción con the_content() -->
                <div class="intro-section text-center">
                    <?php if (has_post_thumbnail()): ?>
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="img-fluid shadow-lg rounded mb-4">
                    <?php endif; ?>
                    <div class="page-content text-center text-gray">
                        <?php while (have_posts()): the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Propuesta de Valor -->
    <section class="value-section mb-5">
        <?php echo do_shortcode('[ev-services-value]'); ?>
    </section>

    <!-- Servicios -->
    <section class="services-section mb-5">
        <?php echo do_shortcode('[ev-services-list]'); ?>
    </section>

    <!-- Llamado a la Acción -->
    <section class="cta-section bg-primary text-white py-5">
        <div class="container text-center">
            <h2 class="h3 mb-4">¿Listo para transformar tu vida?</h2>
            <p class="mb-4">Reserva una consulta gratuita y descubre cómo podemos acompañarte en tu viaje espiritual.</p>
            <a href="https://calendly.com/escuelamistica" class="btn btn-secondary btn-lg text-white">Agenda tu Consulta</a>
        </div>
    </section>
</div>

<?php get_footer(); ?>
