<?php ?>
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
        Inscripción confirmada ✨
      </h2>
    </td>
  </tr>

  <!-- Cuerpo -->
  <tr>
    <td style="padding: 24px; text-align: center;">
      <h2 style="color:#4b0082; margin: 0 0 12px;">
        ¡Te has inscrito en «<?= esc_html($titulo) ?>»!
      </h2>

      <p style="color:#333; font-size:16px; margin: 0 0 10px;">
        <strong>Instructor:</strong><br>
        <?= esc_html($instructor) ?>
      </p>

      <p style="color:#333; font-size:16px; margin: 20px 0;">
        Te enviaremos los horarios y el acceso muy pronto.
      </p>

      <p style="color:#666; font-size:14px; margin-top: 24px;">
        Revisa tu correo en los próximos días ✨<br>
        Si tienes dudas, puedes responder este mensaje.
      </p>

      <p style="color:#333; font-size:15px; margin-top: 20px;">
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
