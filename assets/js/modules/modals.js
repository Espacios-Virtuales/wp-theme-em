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
    // ----- ABRIR -----
    const opener = e.target.closest('.ev-open-modal');
    if (opener) {
      const targetId = opener.dataset.target;
      const modal = document.getElementById(targetId);
      if (!modal) return;

      const content = modal.querySelector('.ev-modal-content');

      // Calcula una posición "cercana" al botón/target
      const rect = opener.getBoundingClientRect();
      const baseTop = window.scrollY + rect.top + 16; // 16px debajo del botón
      const viewportH = window.innerHeight;
      const maxH = Math.min(0.9 * viewportH, 720); // coherente con tu max-height
      // evita que el contenido quede fuera del documento
      const docH = Math.max(
        document.body.scrollHeight,
        document.documentElement.scrollHeight
      );
      const clampedTop = Math.max(16, Math.min(baseTop, docH - maxH - 24));

      content.style.setProperty('--ev-modal-top', `${clampedTop}px`);

      modal.style.display = 'flex';
      modal.classList.add('show');
      modal.setAttribute('aria-hidden', 'false');

      // si el inicio del modal queda por debajo del viewport, acompaña con scroll suave
      const visibleTop = clampedTop - window.scrollY;
      if (visibleTop > viewportH - 120) {
        window.scrollTo({ top: clampedTop - 80, behavior: 'smooth' });
      }

      // foco accesible
      const title = content.querySelector('h2');
      if (title) { title.setAttribute('tabindex', '-1'); title.focus(); }

      e.preventDefault();
      return;
    }

    // ----- CERRAR (botón o overlay) -----
    const closeBtn = e.target.closest('.ev-close-modal');
    const overlay = e.target.classList?.contains('ev-modal') ? e.target : null;
    const modalToClose = closeBtn ? closeBtn.closest('.ev-modal') : overlay;
    if (modalToClose) {
      closeModal(modalToClose);
      e.preventDefault();
    }
  });

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
    const content = modal.querySelector('.ev-modal-content');
    if (content) content.style.removeProperty('--ev-modal-top');
  }
}
