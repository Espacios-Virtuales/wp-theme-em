document.addEventListener("DOMContentLoaded", () => {
    if (window.AOS) AOS.init({ once: true, duration: 650 });
  
    const modal = document.getElementById("evVideoModal");
    const frame = document.getElementById("evVideoFrame");
  
    function ytToEmbed(url) {
      // soporta youtu.be/ID o youtube.com/watch?v=ID
      const id = (url.match(/youtu\.be\/([A-Za-z0-9_-]+)/) || url.match(/[?&]v=([^&]+)/) || [])[1];
      return id ? `https://www.youtube.com/embed/${id}?autoplay=1&rel=0` : url;
    }
  
    function openModal(videoUrl) {
      frame.src = ytToEmbed(videoUrl);
      modal.classList.add("is-open");
      modal.setAttribute("aria-hidden", "false");
      document.documentElement.classList.add("ev-modal-open");
    }
  
    function closeModal() {
      modal.classList.remove("is-open");
      modal.setAttribute("aria-hidden", "true");
      frame.src = "";
      document.documentElement.classList.remove("ev-modal-open");
    }
  
    document.querySelectorAll("[data-ev-video]").forEach(btn => {
      btn.addEventListener("click", () => openModal(btn.dataset.evVideo));
    });
  
    modal.addEventListener("click", (e) => {
      if (e.target.matches("[data-ev-close]")) closeModal();
    });
  
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && modal.classList.contains("is-open")) closeModal();
    });
  });