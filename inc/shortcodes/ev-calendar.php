<?php


/*
    Función para crear el shortcode de calendario con eventos de ACF y modales
*/ 
function ev_calendar_events_shortcode() {
    $calendar = new Calendar(date('Y-m-d'));

    $data = blog_get_custom_post_type(array('evento'));        
    $posts = $data->posts;

    foreach ($posts as $post) {
        $on = get_field('on', $post); 
        $date = get_field('date', $post);
        
        if ($on && $date) {
            $calendar->add_event($post->post_title, $date, 1, $post->ID);
        }
    }

    ob_start();
    ?>
    <section class="container-bg pt-5 pb-5" id="eventos-calendar" data-aos="fade-up">
        <?= $calendar ?>
    </section>

    <?php
    foreach ($posts as $post) {
        $on = get_field('on', $post);
        $date = get_field('date', $post);

        if ($on && $date) {
            $modal_id = 'modal_' . $post->ID;
            ?>
            <div class="modal fade" id="<?= $modal_id ?>" tabindex="-1" aria-labelledby="<?= $modal_id ?>Label" aria-hidden="true">
                <div class="modal-dialog" data-aos="zoom-in">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="<?= $modal_id ?>Label"><?= esc_html($post->post_title); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?= apply_filters('the_content', $post->post_content); ?>
                            <p><strong>Fecha:</strong> <?= get_field('date', $post); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a href="#" class="btn btn-primary">Comprar entradas</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    return ob_get_clean();
}
add_shortcode('ev-calendar', 'ev_calendar_events_shortcode');
