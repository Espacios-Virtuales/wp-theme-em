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
  document.addEventListener('click', (e) => {
    // ABRIR
    const opener = e.target.closest('.ev-open-modal');
    if (opener) {
      const targetId = opener.dataset.target;
      const modal = document.getElementById(targetId);
      if (!modal) return;

      // Mostrar modal (centrado fijo)
      modal.style.display = 'flex';
      modal.classList.add('show');
      modal.setAttribute('aria-hidden', 'false');

      // Llevar la vista hacia la tarjeta que abrió el modal
      // (el modal queda centrado y visible durante el scroll)
      opener.scrollIntoView({ block: 'center', behavior: 'smooth' });

      // Foco accesible
      const title = modal.querySelector('.ev-modal-content h2');
      if (title) { title.setAttribute('tabindex', '-1'); title.focus(); }

      e.preventDefault();
      return;
    }

    // CERRAR (link × o clic en overlay)
    const closeBtn = e.target.closest('.ev-close-modal');
    const overlay = e.target.classList?.contains('ev-modal') ? e.target : null;
    const modalToClose = closeBtn ? closeBtn.closest('.ev-modal') : overlay;
    if (modalToClose) {
      modalToClose.classList.remove('show');
      modalToClose.setAttribute('aria-hidden', 'true');
      modalToClose.style.display = 'none';
      e.preventDefault();
    }
  });

  // ESC para cerrar
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      const openModal = document.querySelector('.ev-modal.show');
      if (openModal) {
        openModal.classList.remove('show');
        openModal.setAttribute('aria-hidden', 'true');
        openModal.style.display = 'none';
      }
    }
  });
  
}

export function initializeCalendarModals() {
  const modals = document.querySelectorAll('.modal.fade');

  modals.forEach((modalEl) => {
    const modal = new bootstrap.Modal(modalEl, {
      backdrop: 'static', // o true, según tu diseño
      keyboard: true,
    });

    // Opcional: podrías vincular apertura si quieres hacer alguna acción especial
    modalEl.addEventListener('show.bs.modal', () => {
      console.log('Modal abierto:', modalEl.id);
    });

    // Cerrar si es necesario algo extra
    modalEl.addEventListener('hidden.bs.modal', () => {
      console.log('Modal cerrado:', modalEl.id);
    });
  });
}
