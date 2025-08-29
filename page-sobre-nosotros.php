<?php
/*
Template Name: Sobre Nosotros
*/

get_header();
?>

<main id="sobre-nosotros" class="bg-light text-dark">

    <!-- Shortcode: Hero -->
    <?php echo do_shortcode('[ev-about-hero]'); ?>

    <!-- Shortcode: Propósito -->
    <?php echo do_shortcode('[ev-about-purpose]'); ?>

    <!-- Shortcode: Misión y Visión -->
    <?php echo do_shortcode('[ev-about-mission-vision]'); ?>

    <!-- Shortcode: Valores -->
    <?php echo do_shortcode('[ev-about-values]'); ?>
   

    <!-- Shortcode: Identidad -->
    <?php echo do_shortcode('[ev-about-identity]'); ?>

    <?php 
    while (have_posts()) : the_post();
        the_content(); // Aquí irán los shortcodes [ev-*]
    endwhile;
    ?>

    <!-- Llamado a la Acción -->
    <?php
    $servicios_page = get_page_by_path('servicios'); 
    $servicios_url = get_permalink($servicios_page->ID);
    
    ?>
    
    <section class="cta-section bg-primary text-white py-5">
        <div class="container text-center">
            <p class="mb-4">Sigue explorando descubre la magia nuestros servicios en Escuela Mistica</p>
            <a href="<?php echo esc_url($servicios_url); ?>" class="btn btn-secondary btn-lg text-white">Servicios</a>
        </div>
    </section>
</main>

<?php
get_footer();
?>