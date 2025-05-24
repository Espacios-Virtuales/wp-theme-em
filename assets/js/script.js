jQuery(document).ready(function ($) {
  // Animación de texto
  function animateText(selector) {
    const $textWrapper = $(selector);
    if ($textWrapper.length) {
      $textWrapper.each(function () {
        const $this = $(this);
        $this.html($this.text().replace(/\S/g, "<span class='letter'>$&</span>"));
      });
  
      anime.timeline({ loop: false }) // Remueve el loop
        .add({
          targets: selector + " .letter",
          opacity: [0, 1],
          translateY: ["1.2em", 0],
          duration: 1200,
          delay: (el, i) => 50 * i,
          easing: "easeOutCubic"
        });
    }
  }  

  function animateHeroAboutUs() {
    anime.timeline()
      .add({
        targets: '.hero-title',
        translateY: [-20, 0],
        opacity: [0, 1],
        easing: 'easeOutExpo',
        duration: 1000,
      })
      .add({
        targets: '.hero-description',
        translateX: [-50, 0],
        opacity: [0, 1],
        easing: 'easeOutExpo',
        delay: 500,
        duration: 1000,
      }, '-=800') // Inicia antes de que termine la animación anterior
      .add({
        targets: '.hero-image',
        scale: [0.8, 1],
        opacity: [0, 1],
        easing: 'easeOutElastic',
        delay: 800,
        duration: 1500,
      }, '-=1000'); // Inicia mientras la anterior aún se ejecuta
  }


  function handleMenuNavigation() {
    $(".menu-toggle").on("click", function () {
      $("#site-navigation").toggleClass("menu-open");

      // Cambia el aria-expanded de acuerdo al estado del menú
      var expanded = $(this).attr("aria-expanded") === "true" || false;
      $(this).attr("aria-expanded", !expanded);
    });

    // Cierra el menú si se hace clic fuera de él
    $(document).on("click", function (e) {
      if (
        !$(e.target).closest("#site-navigation").length &&
        $("#site-navigation").hasClass("menu-open")
      ) {
        $("#site-navigation").removeClass("menu-open");
        $(".menu-toggle").attr("aria-expanded", false);
      }
    });
  }

  function handleHeroCarousel() {
    $(".carousel").carousel({
      interval: 5000, // Cambia cada 5 segundos
      ride: "carousel",
    });
  }

  /* function handleSubscriptionForm() {
        $('#registerForm').on('submit', function (event) {
            event.preventDefault();
            var isValid = true;

            // Limpiar mensajes de error anteriores
            $('.invalid-feedback').remove();
            $('.is-invalid').removeClass('is-invalid');

            // Validar nombre
            var username = $('#username').val().trim();
            if (username === '') {
                isValid = false;
                $('#username').addClass('is-invalid');
                $('#username').after('<div class="invalid-feedback">Por favor ingrese un nombre.</div>');
            }

            // Validar email
            var email = $('#email').val().trim();
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (email === '') {
                isValid = false;
                $('#email').addClass('is-invalid');
                $('#email').after('<div class="invalid-feedback">Por favor ingrese un email.</div>');
            } else if (!emailPattern.test(email)) {
                isValid = false;
                $('#email').addClass('is-invalid');
                $('#email').after('<div class="invalid-feedback">Por favor ingrese un email válido.</div>');
            }

            // Validar mensaje si existe en el formulario
            if ($('#msj').length > 0) {
                var message = $('#msj').val().trim();
                if (message === '') {
                    isValid = false;
                    $('#msj').addClass('is-invalid');
                    $('#msj').after('<div class="invalid-feedback">Por favor ingrese un mensaje.</div>');
                }
            }

            // Si el formulario es válido, enviar la solicitud AJAX
            if (isValid) {
                var formData = {
                    'action': 'handle_contact_form',
                    'contact_name': username,
                    'contact_email': email,
                    'contact_message': message
                };

                $.ajax({
                    url: ajax_object.ajax_url,  // Asegúrate de que esta URL esté correctamente localizada en PHP
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            alert('¡Formulario enviado correctamente!');
                            $('#registerForm').trigger('reset');  // Limpiar formulario
                        } else {
                            alert(response.data);  // Mostrar mensaje de error del servidor
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);  // Mostrar el error en la consola
                        alert('Error en la comunicación con el servidor.');
                    }
                });
            }
        });
    } */

  // Modal de introducción
  function handleIntroVideoModal() {
    const introVideoModal = new bootstrap.Modal(
      document.getElementById("IntroVideoModal")
    );
    if (introVideoModal) {
      setTimeout(() => {
        introVideoModal.show();
      }, 1000); // Retraso de 1 segundo
    } else {
      // Si no existe, no hacer nada para evitar errores
      console.warn("Modal IntroVideoModal no encontrado en la página.");
    }
  }

  function animateMissionVision() {
    anime.timeline()
      .add({
        targets: '.mission-card, .vision-card',
        translateY: [20, 0],
        opacity: [0, 1],
        easing: 'easeOutExpo',
        duration: 1000,
      })
      .add({
        targets: '.mission-image, .vision-image',
        scale: [0.8, 1],
        opacity: [0, 1],
        easing: 'easeOutElastic',
        delay: 500,
        duration: 1200,
      }, '-=800');
  }

  function initializeAOS() {
    if (typeof AOS !== 'undefined') {
      $(document).ready(function () {
        AOS.init({
          duration: 1000, // duración en milisegundos
          once: true      // animar solo una vez
        });
      });
    } else {
      console.warn("AOS no está cargado.");
    }
  }

  function initializeVideoModal() {
    const $videoFrame = $('#videoFrame');

    $('.open-video-modal').on('click', function () {
        const videoUrl = $(this).data('video');
        if (!videoUrl) return;

        // Asegura autoplay
        const autoplayUrl = videoUrl.includes('?') ? videoUrl + '&autoplay=1' : videoUrl + '?autoplay=1';

        $videoFrame.attr('src', autoplayUrl);
    });

    // Limpia el src cuando se cierra
    $('#videoModal').on('hidden.bs.modal', function () {
        $videoFrame.attr('src', '');
    });
}



  initializeAOS();
  handleMenuNavigation();
  handleHeroCarousel();
  animateText(".ml9");
  /* handleSubscriptionForm(); */

  if ($('#IntroVideoModal').length) {
    handleIntroVideoModal();
  }

  if ($('.hero-about').length) {
    animateHeroAboutUs();
  }

  if ($('.mission-vision-section').length) {
    animateMissionVision();
  }

  initializeVideoModal();


});
