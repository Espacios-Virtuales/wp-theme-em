export function initializeVideoModals() {
    
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
