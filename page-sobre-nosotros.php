<?php
/*
Template Name: Sobre Nosotros
*/

get_header();
?>

<main id="sobre-nosotros" class="bg-light text-dark">

    <?php echo do_shortcode('[ev-about-hero]'); ?>


    <!-- Shortcode: Propósito -->
    <section class="purpose-section py-5">
        <div class="container">
            <h2 class="text-center text-primary mb-4">Nuestro Propósito</h2>
            <?php echo do_shortcode('[ev-about-purpose]'); ?>
        </div>
    </section>

    <!-- Shortcode: Misión y Visión -->
    <section class="mission-vision-section py-5 bg-secondary text-light">
        <div class="container">
            <h2 class="text-center text-gold mb-4">Misión y Visión</h2>
            <?php echo do_shortcode('[ev-about-mission-vision]'); ?>
        </div>
    </section>

    <!-- Shortcode: Valores -->
    <section class="values-section py-5">
        <div class="container">
            <h2 class="text-center text-primary mb-4">Nuestros Valores</h2>
            <?php echo do_shortcode('[ev-about-values]'); ?>
        </div>
    </section>

    <!-- Shortcode: Identidad -->
    <section class="identity-section py-5 bg-dark text-light">
        <div class="container">
            <h2 class="text-center text-gold mb-4">Nuestra Identidad</h2>
            <?php echo do_shortcode('[ev-about-identity]'); ?>
        </div>
    </section>
</main>

<?php
get_footer();
?>