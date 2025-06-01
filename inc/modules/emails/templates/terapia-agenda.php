<?php ?>
<html>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9;">
<table style="max-width: 600px; margin: auto; background: #fff; padding: 20px;">
    <tr>
        <td style="text-align: center;">
            <h2 style="color: #4b0082;">¡Tu terapia «<?= esc_html($titulo) ?>» está lista para agendar!</h2>
            <p style="color: #333; font-size: 16px;">Gracias por confiar en Escuela Mística. Ya puedes elegir la hora que mejor te acomode:</p>
            <p style="margin: 20px 0;">
                <a href="<?= esc_url($link) ?>" style="padding: 14px 28px; background: #FFD700; color: #4b0082; text-decoration: none; font-weight: bold; border-radius: 6px;">
                    Agendar sesión ahora
                </a>
            </p>
            <p style="color: #666; font-size: 14px;">Recuerda revisar tu correo para más detalles ✨</p>
        </td>
    </tr>
</table>
</body>
</html>
