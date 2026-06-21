jQuery(document).ready(function ($) {
  function handleContactForm() {
    $("#registerForm").on("submit", function (event) {
      event.preventDefault();

      var $form = $(this);
      var $submitBtn = $form.find('button[type="submit"]'); // o $("#contactSubmit");
      var originalText = $submitBtn.text();

      // Desactivar botón al iniciar validación/envío
      $submitBtn.prop("disabled", true).text("Enviando...");

      var isValid = true;

      // Limpiar mensajes de error anteriores
      $form.find(".invalid-feedback").remove();
      $form.find(".is-invalid").removeClass("is-invalid");

      // Validar nombre
      var username = $("#username").val().trim();
      if (username === "") {
        isValid = false;
        $("#username").addClass("is-invalid");
        $("#username").after(
          '<div class="invalid-feedback">Por favor ingrese un nombre.</div>'
        );
      }

      // Validar email
      var email = $("#email").val().trim();
      var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
      if (email === "") {
        isValid = false;
        $("#email").addClass("is-invalid");
        $("#email").after(
          '<div class="invalid-feedback">Por favor ingrese un email.</div>'
        );
      } else if (!emailPattern.test(email)) {
        isValid = false;
        $("#email").addClass("is-invalid");
        $("#email").after(
          '<div class="invalid-feedback">Por favor ingrese un email válido.</div>'
        );
      }

      // Validar mensaje
      var message = $("#msj").val().trim();
      if (message.length > 0 && message.length < 10) {
        isValid = false;
        $("#msj").addClass("is-invalid");
        $("#msj").after(
          '<div class="invalid-feedback">El mensaje debe tener al menos 10 caracteres si lo llenas.</div>'
        );
      }

      var subscribe = $("#subscribeContact").is(":checked") ? "yes" : "no";

      // Si no es válido, reactivar botón y salir
      if (!isValid) {
        $submitBtn.prop("disabled", false).text(originalText);
        return;
      }

      // Si el formulario es válido, enviar la solicitud AJAX
      var formData = {
        action: "handle_contact_form",
        contact_name: username,
        contact_email: email,
        contact_message: message,
        contact_subscribe: subscribe,
      };

      $.ajax({
        url: ajax_object.ajax_url,
        type: "POST",
        data: formData,
        success: function (response) {
          if (response.success) {
            alert("¡Formulario enviado correctamente!");
            $form.trigger("reset");
          } else {
            alert(response.data || "Ocurrió un error al procesar tu solicitud.");
          }

          // Reactivar botón después de la respuesta
          $submitBtn.prop("disabled", false).text(originalText);
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
          alert("Error en la comunicación con el servidor.");

          // Reactivar botón también en caso de error
          $submitBtn.prop("disabled", false).text(originalText);
        },
      });
    });
  }

  function handleSubscriptionForm() {
    $("#modalContactForm").on("submit", function (event) {
      event.preventDefault();

      var $form = $(this);
      var $submitBtn = $form.find('button[type="submit"]'); // o $("#modalSubmitBtn");
      var originalText = $submitBtn.text();

      // Desactivar botón apenas se dispara el submit
      $submitBtn.prop("disabled", true).text("Enviando...");

      var isValid = true;

      // Limpiar estados previos
      $form.find(".is-invalid").removeClass("is-invalid");

      // Obtener el estado del checkbox (por si quieres usarlo en debug)
      const subscribeChecked = $("#subscribeCheck").prop("checked");
      console.log("Checkbox suscripción está marcado:", subscribeChecked);

      // Validar nombre
      var name = $("#modalName").val().trim();
      if (name.length < 3) {
        isValid = false;
        $("#modalName").addClass("is-invalid");
      }

      // Validar correo electrónico
      var email = $("#modalEmail").val().trim();
      var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
      if (!emailPattern.test(email)) {
        isValid = false;
        $("#modalEmail").addClass("is-invalid");
      }

      // Estado del checkbox
      var subscribe = $("#subscribeCheck").is(":checked") ? "yes" : "no";

      // Si hay errores de validación, reactivar botón y salir
      if (!isValid) {
        $submitBtn.prop("disabled", false).text(originalText);
        return;
      }

      // Enviar datos si el formulario es válido
      var formData = {
        action: "handle_contact_form",
        contact_name: name,
        contact_email: email,
        contact_subscribe: subscribe,
      };

      $.ajax({
        url: ajax_object.ajax_url,
        type: "POST",
        data: formData,
        success: function (response) {
          if (response.success) {
            alert("¡Formulario enviado correctamente!");
            $form.trigger("reset");

            // Opcional: cerrar el modal tras éxito (Bootstrap 5)
            var modalEl = document.getElementById("subscribeModal");
            if (modalEl && typeof bootstrap !== "undefined") {
              var modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
              modalInstance.hide();
            }
          } else {
            alert("Error: " + (response.data || "No se pudo procesar el formulario."));
          }

          // Reactivar botón después de respuesta
          $submitBtn.prop("disabled", false).text(originalText);
        },
        error: function (xhr) {
          console.error(xhr.responseText);
          alert("Error al enviar el formulario.");
          // Reactivar botón también en error
          $submitBtn.prop("disabled", false).text(originalText);
        },
      });
    });
  }

  handleContactForm();
  handleSubscriptionForm();
});
