import { animateText, animateMissionVision } from './modules/animations.js';
import { handleMenuNavigation } from './modules/menu.js';
import { handleHeroCarousel } from './modules/hero.js';

import { initializeAOS } from './modules/aos.js';
import { handleIntroVideoModal, initializeVideoModals, initializeObjetoModals, initializeCalendarModals } from './modules/modals.js';

jQuery(document).ready(function ($) {

  if ($('.hero-about').length) {
    animateText(".ml9");
  }

  if ($('.mission-vision-section').length) {
    animateMissionVision();
  }

  handleMenuNavigation();
  handleHeroCarousel();
  initializeAOS();
  handleIntroVideoModal();
  initializeVideoModals();
  initializeObjetoModals();
  initializeCalendarModals();
});
