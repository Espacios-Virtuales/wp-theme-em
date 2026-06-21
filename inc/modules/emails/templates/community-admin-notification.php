<html>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:Arial, Helvetica, sans-serif;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="width:100%; background-color:#f4f4f4; border-collapse:collapse;">
    <tr>
        <td align="center" style="padding:24px 12px;">
            <table role="presentation" width="620" cellspacing="0" cellpadding="0" style="width:100%; max-width:620px; background-color:#ffffff; border-collapse:collapse;">
                <tr>
                    <td style="background-color:#4b0082; padding:22px 24px;">
                        <h1 style="margin:0; color:#ffd700; font-size:22px;">Nueva solicitud de comunidad</h1>
                    </td>
                </tr>
                <tr>
                    <td style="padding:24px; color:#333333; font-size:15px; line-height:1.6;">
                        <p style="margin:0 0 14px;"><strong>Nombre:</strong> <?php echo esc_html($data['name'] ?? ''); ?></p>
                        <p style="margin:0 0 14px;"><strong>Correo:</strong> <?php echo esc_html($data['email'] ?? ''); ?></p>
                        <p style="margin:0 0 14px;"><strong>WhatsApp:</strong> <?php echo esc_html($data['whatsapp'] ?? ''); ?></p>
                        <p style="margin:0 0 14px;"><strong>Comunidad elegida:</strong> <?php echo esc_html($community_label); ?></p>
                        <p style="margin:0 0 14px;"><strong>Intención:</strong><br><?php echo nl2br(esc_html($data['intention'] ?? '')); ?></p>
                        <p style="margin:0 0 14px;"><strong>Origen:</strong> <?php echo esc_html($data['origin'] ?? ''); ?></p>
                        <p style="margin:0;"><strong>Fecha:</strong> <?php echo esc_html($data['date'] ?? ''); ?></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
