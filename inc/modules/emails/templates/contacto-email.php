<?php
$subscription_message = ($subscribe === 'yes') ? '
    <p style="color:#4b0082;">Gracias por suscribirte. Pronto recibirás contenido exclusivo.</p>
' : '';
?>
<html>
<body style="font-family: Arial, sans-serif; background-color: #f8f8f8; padding: 0; margin: 0;">
<table style="width: 100%; max-width: 600px; margin: auto; background-color: #fff; border-collapse: collapse;">
    <tr>
        <td style="background-color: #4b0082; padding: 20px; text-align: center;">
            <img src="https://escuelamistica.cl/em/wp-content/uploads/logo.png" alt="Escuela Mística" style="width: 150px;" />
            <h2 style="color: #FFD700;">Gracias por contactarnos ✨</h2>
        </td>
    </tr>
    <tr>
        <td style="padding: 20px;">
            <p style="color: #333;">Hemos recibido tu mensaje.</p>
            <?= $subscription_message ?>
            <p>Con cariño, el equipo de Escuela Mística.</p>
        </td>
    </tr>
    <tr>
        <td style="text-align: center; background-color: #4b0082; padding: 20px;">
            <a href="https://escuelamistica.cl" style="color: #FFD700; font-weight: bold;">Visita nuestro sitio</a>
        </td>
    </tr>
</table>
</body>
</html>
