<?php
$safe_message = nl2br(esc_html($community_message));
?>
<html>
<body style="margin:0; padding:0; background-color:#f6f2fb; font-family:Arial, Helvetica, sans-serif;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="width:100%; background-color:#f6f2fb; border-collapse:collapse;">
    <tr>
        <td align="center" style="padding:24px 12px;">
            <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="width:100%; max-width:600px; background-color:#ffffff; border-collapse:collapse; border-radius:12px; overflow:hidden;">
                <tr>
                    <td style="background-color:#4b0082; padding:28px 24px; text-align:center;">
                        <h1 style="margin:0; color:#ffd700; font-size:26px; line-height:1.25;">Escuela Mística</h1>
                        <p style="margin:10px 0 0; color:#ffffff; font-size:16px;">Tu acceso a <?php echo esc_html($community_label); ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:28px 24px; color:#2f2640; font-size:16px; line-height:1.65;">
                        <p style="margin:0 0 16px;">Hola <?php echo esc_html($nombre); ?>,</p>
                        <p style="margin:0 0 20px;"><?php echo $safe_message; ?></p>
                        <table role="presentation" cellspacing="0" cellpadding="0" style="margin:28px auto;">
                            <tr>
                                <td style="background-color:#ffd700; border-radius:999px; text-align:center;">
                                    <a href="<?php echo esc_url($community_link); ?>" style="display:inline-block; padding:14px 26px; color:#2a1647; font-weight:bold; text-decoration:none;">
                                        Ingresar a la comunidad
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <p style="margin:0;">Con cariño,<br>Equipo Escuela Mística</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
