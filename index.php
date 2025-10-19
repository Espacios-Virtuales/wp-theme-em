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

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero text-center py-5 mb-4 bg-light">
        <div class="container">
            <h1 class="display-4 entry-title ml3"><?php esc_html_e('Explora el blog de Escuela Mistica', 'tiendavirtual'); ?></h1>
            <p class="lead"><?php esc_html_e('Mantente conectado con lo último en crecimiento personal y espiritualidad.', 'tiendavirtual'); ?></p>
        </div>
    </section>

     <!-- Blog Posts Section -->
     <section class="blog-posts">
        <div class="container-fluid p-4">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-4">
                    <?php get_sidebar(); ?>
                </div>

                <!-- Main Content -->
                <?php
                $intro = get_field('introductions') ?: [];
                ?>

                <div class="col-md-8">
                    <div class="row">
                        <?php if (!empty($intro['intro_1'])) : ?>
                            <div class="col-12 mb-4">
                                <div class="text-center px-3">
                                    <p class="lead text-muted">
                                        <?php echo wp_kses_post($intro['intro_1']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>

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
            </div>
        </div>
    </section>
</main><!-- #main -->

<?php get_footer(); ?>