export function initializeAOS() {
    if (typeof AOS !== 'undefined') {
      AOS.init({
        duration: 1000,
        once: true
      });
    } else {
      console.warn("AOS no está cargado.");
    }
  }