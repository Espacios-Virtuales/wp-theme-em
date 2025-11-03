export function initializeVideoModals() {
  const $ = jQuery;

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
  
export function handleIntroVideoModal() {
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

    // (Opcional) cerrar al hacer clic fuera del modal o escape}
}

export function initializeObjetoModals() {
  // Delegación por si el grid se re-renderiza
  document.addEventListener('click', (e) => {
    // ----- ABRIR -----
    const opener = e.target.closest('.ev-open-modal');
    if (opener) {
      const targetId = opener.dataset.target;
      const modal = document.getElementById(targetId);
      if (!modal) return;

      const content = modal.querySelector('.ev-modal-content');
      const headerOffset = 24; // ajusta si tienes header sticky (ej. 64)
      const top = Math.max(16, window.scrollY + headerOffset);

      // setea la altura de aparición
      content.style.setProperty('--ev-modal-top', `${top}px`);

      modal.style.display = 'flex';
      modal.classList.add('show');
      modal.setAttribute('aria-hidden', 'false');

      // bloquea scroll del body
      document.body.classList.add('ev-modal-open');

      // foco accesible
      const title = content.querySelector('h2');
      if (title) {
        title.setAttribute('tabindex', '-1');
        title.focus();
      }

      e.preventDefault();
      return;
    }

    // ----- CERRAR por botón o click en overlay -----
    const closeBtn = e.target.closest('.ev-close-modal');
    const overlay = e.target.classList?.contains('ev-modal') ? e.target : null;
    const modalToClose = closeBtn ? closeBtn.closest('.ev-modal') : overlay;

    if (modalToClose) {
      closeModal(modalToClose);
      e.preventDefault();
      return;
    }
  });

  // Escape para cerrar
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      const openModal = document.querySelector('.ev-modal.show');
      if (openModal) closeModal(openModal);
    }
  });

  function closeModal(modal) {
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
    modal.style.display = 'none';
    document.body.classList.remove('ev-modal-open');

    const content = modal.querySelector('.ev-modal-content');
    if (content) content.style.removeProperty('--ev-modal-top');
  }
}
