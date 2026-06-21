<?php

function ev_community_onboarding_shortcode($atts = [])
{
    $atts = shortcode_atts([
        'origen' => '',
        'comunidad' => '',
        'titulo' => 'Únete a la comunidad de Escuela Mística',
        'subtitulo' => 'Déjanos tus datos y recibe la orientación o acceso que corresponde a tu intención.',
    ], $atts, 'ev-community_onboarding');

    $allowed_communities = ['alquimia', 'portal', 'orientacion'];
    $selected_community = sanitize_key($atts['comunidad']);
    $has_fixed_community = in_array($selected_community, $allowed_communities, true);
    $origin = sanitize_text_field($atts['origen']);
    $form_id = 'ev-community-onboarding-' . wp_unique_id();

    $communities = [
        'alquimia' => 'Alquimia de Chakras',
        'portal' => 'Portal Místico',
        'orientacion' => 'Quiero orientación de Maureen',
    ];

    ob_start();
    ?>
    <section class="ev-community-onboarding" data-community-origin="<?php echo esc_attr($origin); ?>">
        <div class="ev-community-onboarding__inner">
            <div class="ev-community-onboarding__header">
                <span class="ev-community-onboarding__eyebrow">Escuela Mística</span>
                <h2><?php echo esc_html($atts['titulo']); ?></h2>
                <p><?php echo esc_html($atts['subtitulo']); ?></p>
            </div>

            <form id="<?php echo esc_attr($form_id); ?>" class="ev-community-onboarding-form" method="post" action="#" novalidate>
                <input type="hidden" name="action" value="handle_community_onboarding">
                <input type="hidden" name="community_nonce" value="<?php echo esc_attr(wp_create_nonce('ev_community_onboarding')); ?>">
                <input type="hidden" name="community_origin" value="<?php echo esc_attr($origin); ?>">
                <input type="text" name="community_website" value="" class="ev-community-onboarding__hp" tabindex="-1" autocomplete="off" aria-hidden="true">

                <div class="ev-community-onboarding__grid">
                    <div class="ev-community-onboarding__field">
                        <label for="<?php echo esc_attr($form_id); ?>-name">Nombre</label>
                        <input id="<?php echo esc_attr($form_id); ?>-name" type="text" name="community_name" autocomplete="name" required>
                    </div>

                    <div class="ev-community-onboarding__field">
                        <label for="<?php echo esc_attr($form_id); ?>-email">Correo</label>
                        <input id="<?php echo esc_attr($form_id); ?>-email" type="email" name="community_email" autocomplete="email" required>
                    </div>

                    <div class="ev-community-onboarding__field">
                        <label for="<?php echo esc_attr($form_id); ?>-whatsapp">WhatsApp</label>
                        <input id="<?php echo esc_attr($form_id); ?>-whatsapp" type="tel" name="community_whatsapp" autocomplete="tel" required>
                    </div>

                    <div class="ev-community-onboarding__field <?php echo $has_fixed_community ? 'ev-community-onboarding__field--hidden' : ''; ?>">
                        <label for="<?php echo esc_attr($form_id); ?>-interest">Comunidad</label>
                        <select id="<?php echo esc_attr($form_id); ?>-interest" name="community_interest" required>
                            <option value="">Selecciona una opción</option>
                            <?php foreach ($communities as $key => $label) : ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php selected($selected_community, $key); ?>>
                                    <?php echo esc_html($label); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="ev-community-onboarding__field">
                    <label for="<?php echo esc_attr($form_id); ?>-intention">Cuéntanos brevemente tu intención</label>
                    <textarea id="<?php echo esc_attr($form_id); ?>-intention" name="community_intention" rows="4"></textarea>
                </div>

                <label class="ev-community-onboarding__consent">
                    <input type="checkbox" name="community_consent" value="yes" required>
                    <span>Acepto recibir la información de Escuela Mística por correo y WhatsApp.</span>
                </label>

                <div class="ev-community-onboarding__message" role="status" aria-live="polite"></div>

                <button class="ev-community-onboarding__submit" type="submit">
                    Enviar solicitud
                </button>
            </form>
        </div>
    </section>
    <?php

    return ob_get_clean();
}

add_shortcode('ev-community_onboarding', 'ev_community_onboarding_shortcode');
