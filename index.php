<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blog-theme
 */
get_header();
?>
<section>
    <?php
    // ID de la página asignada como "Posts page"
    $blog_page_id = get_option('page_for_posts');

    // Toma los campos ACF de esa página (si existe). Fallback a 'option' si lo usas.
    $intro = $blog_page_id ? get_field('introductions', $blog_page_id) : null;
    if (!$intro) { $intro = get_field('introductions', 'option'); } // opcional
    ?>
    <!-- Hero Section -->
    <?php if (!empty($intro)) : ?>
    <div class="container-fluid bg-primary text-center p-5">
    <h1 class="display-4 text-gold" data-aos="fade-down" data-aos-delay="100">
        <?php echo esc_html($intro['intro_1'] ?? ''); ?>
    </h1>
    <p class="lead text-white" data-aos="fade-up" data-aos-delay="200">
        <?php echo esc_html($intro['intro_2'] ?? ''); ?>
    </p>
    </div>
    <?php endif; ?>
</section>
<main id="primary bg-primary" class="site-main">
    <!-- Blog Posts Section -->
    <section class="blog-posts">
        <div class="container-fluid p-4">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <?php if (have_posts()) :
                            while (have_posts()) : the_post(); ?>
                                <div class="col-md-6 mb-4">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class('card border-0 overflow-hidden shadow-sm'); ?>>
                                        <figure class="position-relative m-0" style="aspect-ratio: 16 / 9;">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('large', ['class' => 'w-100 h-100 object-fit-cover']); ?>
                                            <?php endif; ?>
                                            <figcaption class="position-absolute bottom-0 start-0 w-100 p-4 text-white bg-gradient-to-top">
                                                <h2 class="h5 fw-bold m-0"><?php the_title(); ?></h2>
                                            </figcaption>
                                        </figure>
                                        <div class="card-body">
                                            <p class="card-text">
                                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                            </p>
                                            <a href="<?php the_permalink(); ?>" class="btn btn-outline-dark rounded-pill mt-3 px-4 py-2">
                                                <?php esc_html_e('Leer más', 'tiendavirtual'); ?>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                        <?php endwhile;
                        else :
                            echo '<p>' . esc_html__('No se encontraron publicaciones', 'tiendavirtual') . '</p>';
                        endif; ?>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-md-4">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </section>
</main><!-- #main -->

<?php get_footer(); ?>