<?php
// Mensaje opcional de suscripción (por consistencia con el template base)
$subscription_message = ($subscribe === 'yes') ? '
    <p style="color:#4b0082;">Gracias por suscribirte. Pronto recibirás contenido exclusivo.</p>
' : '';
?>
<html>
<body style="font-family: Arial, sans-serif; background-color: #f8f8f8; padding: 0; margin: 0;">
<table style="width: 100%; max-width: 600px; margin: auto; background-color: #fff; border-collapse: collapse;">
    
    <!-- Header -->
    <tr>
        <td style="background-color: #4b0082; padding: 20px; text-align: center;">
            <img src="https://escuelamistica.cl/em/wp-content/uploads/logo.png"
                 alt="Escuela Mística"
                 style="width: 150px; margin-bottom: 10px;" />
            <h2 style="color: #FFD700; margin: 0;">
                Tu terapia está lista para agendar ✨
            </h2>
        </td>
    </tr>

    <!-- Cuerpo -->
    <tr>
        <td style="padding: 24px; text-align: center;">
            <p style="color: #333; font-size: 16px; margin-bottom: 16px;">
                La terapia <strong>«<?= esc_html($titulo) ?>»</strong> ya se encuentra disponible.
            </p>

            <p style="color: #333; font-size: 16px;">
                Puedes elegir el día y la hora que mejor se acomode a tu ritmo:
            </p>

            <p style="margin: 24px 0;">
                <a href="<?= esc_url($link) ?>"
                   style="display: inline-block;
                          padding: 14px 28px;
                          background-color: #FFD700;
                          color: #4b0082;
                          text-decoration: none;
                          font-weight: bold;
                          border-radius: 6px;">
                    Agendar sesión ahora
                </a>
            </p>

            <?= $subscription_message ?>

            <p style="color: #666; font-size: 14px; margin-top: 24px;">
                Si tienes alguna duda, responde este correo.<br>
                Estamos aquí para acompañarte 🌙
            </p>

            <p style="color: #333; font-size: 15px; margin-top: 20px;">
                Con cariño,<br>
                <strong>Equipo Escuela Mística</strong>
            </p>
        </td>
    </tr>

    <!-- Footer -->
    <tr>
        <td style="text-align: center; background-color: #4b0082; padding: 20px;">
            <a href="https://escuelamistica.cl"
               style="color: #FFD700; font-weight: bold; text-decoration: none;">
                Visita nuestro sitio
            </a>
        </td>
    </tr>

</table>
</body>
</html>
