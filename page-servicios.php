<?php
/*
Template Name: Servicios
*/

get_header(); ?>

<!-- Hero Section -->
<section class="hero-section bg-primary mb-5">
    <?php echo do_shortcode('[ev-services-hero]'); ?>
</section>


<div class="page-servicios p-5">



    <!-- Main Content -->

    <section class="services-list mb-5">
        <?php echo do_shortcode('[ev-services-list]'); ?>
    </section>


    <!-- Propuesta de Valor -->
    <section class="value-section mb-5">
        <?php echo do_shortcode('[ev-services-value]'); ?>
    </section>

    <!-- contenido -->
    <section class="container-fluid p-5">
        <?php
        while (have_posts()) : the_post();
            the_content(); // Aquí irán los shortcodes [ev-*]
        endwhile;   
        ?>
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
