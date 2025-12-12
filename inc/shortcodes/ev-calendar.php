<?php
/*
    SHORTCODE: [ev-calendar]
    Calendario + Modal tipo "ev-objetos" para CPT experiencia
*/

function ev_calendar_events_shortcode()
{

    /* 1) Obtener experiencias */
    $calendar = new Calendar(date('Y-m-d'));
    $data = blog_get_custom_post_type('experiencia');
    $posts = $data->posts;

    foreach ($posts as $post) {
        $on   = get_field('on', $post);
        $date = get_field('date', $post);

        if ($on && $date) {
            $calendar->add_event($post->post_title, $date, 1, $post->ID);
        }
    }

    ob_start();
?>
    <!-- Calendario -->
    <section class="container-bg pt-5 pb-5" id="eventos-calendar" data-aos="fade-up">
        <?= $calendar ?>
    </section>

    <?php
    /* 2) Render de botones + modales */
    foreach ($posts as $post):

        $on   = get_field('on', $post);
        $date = get_field('date', $post);

        if (!$on || !$date) continue;

        $modal_id     = 'modal_' . $post->ID;
        $titulo       = get_the_title($post);
        $imagen       = get_the_post_thumbnail($post->ID, 'large');
        $descripcion  = get_field('descripcion', $post->ID);
        $producto_id  = get_post_meta($post->ID, 'linked_product_id', true);
    ?>
        <!-- MODAL PERSONALIZADO -->
        <div id="<?= esc_attr($modal_id) ?>" class="ev-modal" aria-hidden="true">

            <div class="ev-modal-content" role="dialog" aria-modal="true" aria-labelledby="<?= esc_attr($modal_id) ?>-title">

                <a href="#" class="ev-close-modal" aria-label="Cerrar">×</a>

                <h2 id="<?= esc_attr($modal_id) ?>-title"><?= esc_html($titulo); ?></h2>

                <?php if ($imagen): ?>
                    <div class="mb-4"><?= $imagen ?></div>
                <?php endif; ?>

                <?php if ($descripcion): ?>
                    <div class="ev-modal-section mb-4">
                        <strong>Descripción:</strong>
                        <p><?= wp_kses_post($descripcion); ?></p>
                    </div>
                <?php endif; ?>

                <div class="ev-modal-section">
                    <strong>Fecha:</strong>
                    <p><?= esc_html($date); ?></p>
                </div>

                <div class="ev-modal-section text-center">
                    <?php if ($producto_id): ?>
                        <a href="<?= esc_url(get_permalink($producto_id)); ?>" class="ev-cta-button">
                            Comprar entradas
                        </a>
                    <?php else: ?>
                        <span class="ev-cta-unavailable">Próximamente disponible</span>
                    <?php endif; ?>
                </div>

            </div>
        </div>

    <?php endforeach; ?>

    <!-- JS: SISTEMA DE MODALES PERSONALIZADOS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ABRIR */
            document.querySelectorAll('.ev-open-modal').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = btn.getAttribute('data-modal-experiencia');
                    const modal = document.getElementById(targetId);
                    if (modal) {
                        modal.style.display = 'flex';
                        modal.classList.add('show');
                        modal.setAttribute('aria-hidden', 'false');
                    }
                });
            });

            /* CERRAR */
            document.querySelectorAll('.ev-close-modal').forEach(closeBtn => {
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const modal = closeBtn.closest('.ev-modal');
                    modal.classList.remove('show');
                    modal.setAttribute('aria-hidden', 'true');
                    modal.style.display = 'none';
                });
            });

            /* ESC para cerrar */
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const modal = document.querySelector('.ev-modal.show');
                    if (modal) {
                        modal.classList.remove('show');
                        modal.setAttribute('aria-hidden', 'true');
                        modal.style.display = 'none';
                    }
                }
            });
        });
    </script>

<?php
    return ob_get_clean();
}

add_shortcode('ev-calendar', 'ev_calendar_events_shortcode');
?>