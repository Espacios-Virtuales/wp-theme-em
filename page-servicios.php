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

</div>

<?php 
$catalogo_page = get_page_by_path('catalogo'); 
$catalogo_url = get_permalink($catalogo_page->ID); ?>

<!-- Llamado a la Acción -->
<section class="cta-section bg-primary text-white py-5">
    <div class="container text-center">
        <h2 class="h3 mb-4">¿Listo para empoderarte?</h2>
        <p class="mb-4">Recorre el catalogo y descubre cómo podemos acompañarte en este camino.</p>
        <a href="<?php echo esc_url($catalogo_url); ?>" class="btn btn-secondary btn-lg text-white">Catalogo</a>
    </div>
</section>
<?php get_footer(); ?>
