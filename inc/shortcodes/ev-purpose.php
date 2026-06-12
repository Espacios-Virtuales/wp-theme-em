<?php


// Propósito con slide y animaciones
function ev_about_purpose_shortcode()
{
    $purpose_group = ev_get_field('purpose_group', false, true, []);
    $purpose_group = is_array($purpose_group) ? $purpose_group : [];
    ob_start();
?>
    <section class="purpose-section py-5">
        <div class="container">
            <h2 class="text-center text-gold mb-4">Nuestro Propósito</h2>
            <p class="text-center text-white mb-5"><?php echo esc_html($purpose_group['purpose_intro'] ?? ''); ?></p>

            <div id="purpose-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $index = 0; ?>
                    <?php foreach (($purpose_group['purpose_items'] ?? []) as $item): ?>
                        <?php if (!is_array($item)) continue; ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="card shadow-lg purpose-card">
                                <div class="card-header text-center">
                                    <i class="bi bi-stars text-gold"></i>
                                    <h5 class="mb-0 text-white"><?php echo esc_html($item['item_title'] ?? ''); ?></h5>
                                </div>
                                <div class="card-body">
                                    <p><?php echo esc_html($item['item_description'] ?? ''); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php $index++; ?>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#purpose-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#purpose-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>
<?php
    return ob_get_clean();
}
add_shortcode('ev-about-purpose', 'ev_about_purpose_shortcode');
