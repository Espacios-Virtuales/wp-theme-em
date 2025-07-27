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

  function initializeVideoModals() {
    if (!$('.open-video-modal').length) return;

    $('.open-video-modal').on('click', function () {
      const videoUrl = $(this).data('video');
      const targetModal = $(this).data('bs-target');

      if (!videoUrl || !targetModal) return;

      const iframe = $(targetModal).find('iframe');
      const autoplayUrl = videoUrl.includes('?') ? videoUrl + '&autoplay=1' : videoUrl + '?autoplay=1';

      iframe.attr('src', autoplayUrl);
    });

    $('.modal').on('hidden.bs.modal', function () {
      $(this).find('iframe').attr('src', '');
    });
  }


  function handleIntroVideoModal() {
    const modalElement = document.getElementById('IntroVideoModal');

    if (!modalElement) {
      console.warn('Modal #IntroVideoModal no encontrado.');
      return;
    }

    const introModal = new bootstrap.Modal(modalElement);

    // Mostrar el modal 1 segundo después de cargar
    setTimeout(() => {
      introModal.show();
    }, 1000);

    // (Opcional) cerrar al hacer clic fuera del modal o escape
  }


  function initializeObjetoModals() {
    const openers = document.querySelectorAll('.ev-open-modal');
    if (!openers.length) return;

    openers.forEach(button => {
      button.addEventListener('click', () => {
        const targetId = button.dataset.target;
        const modal = document.getElementById(targetId);
        if (modal) {
          modal.style.display = 'flex';
          document.body.classList.add('ev-modal-open');
        }
      });
    });

    document.querySelectorAll('.ev-close-modal').forEach(close => {
      close.addEventListener('click', () => {
        const modal = close.closest('.ev-modal');
        if (modal) {
          modal.style.display = 'none';
          document.body.classList.remove('ev-modal-open');
        }
      });
    });

    // Cerrar si se hace clic fuera del contenido
    document.querySelectorAll('.ev-modal').forEach(modal => {
      modal.addEventListener('click', e => {
        if (e.target === modal) {
          modal.style.display = 'none';
          document.body.classList.remove('ev-modal-open');
        }
      });
    });
  }


  if ($('.hero-about').length) {
    animateHeroAboutUs();
  }

  if ($('.mission-vision-section').length) {
    animateMissionVision();
  }


  initializeAOS();
  handleMenuNavigation();
  handleHeroCarousel();
  animateText(".ml9");
  handleIntroVideoModal();
  initializeVideoModals();
  initializeObjetoModals();

});
