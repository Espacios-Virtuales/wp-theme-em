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

    <!-- Servicios -->
    <section class="services-section mb-5">
        <?php echo do_shortcode('[ev-services-list]'); ?>
    </section>

    <!-- Propuesta de Valor -->
    <section class="value-section mb-5">
        <?php echo do_shortcode('[ev-services-value]'); ?>
    </section>

    <!-- Llamado a la Acción -->
    <section class="cta-section bg-primary text-white py-5">
        <div class="container text-center">
            <h2 class="h3 mb-4">¿Listo para transformar tu vida?</h2>
            <p class="mb-4">Reserva una consulta gratuita y descubre cómo podemos acompañarte en tu viaje espiritual.</p>
            <a href="https://calendly.com/momistica" class="btn btn-secondary btn-lg text-white">Agenda tu Consulta</a>
        </div>
    </section>
</div>

<?php get_footer(); ?>
