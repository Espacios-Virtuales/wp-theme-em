export function animateText(selector) {
    const $ = jQuery;
    const $textWrapper = $(selector);


    if ($textWrapper.length) {
      $textWrapper.each(function () {
        const $this = $(this);
        $this.html($this.text().replace(/\S/g, "<span class='letter'>$&</span>"));
      });
  
      anime.timeline({ loop: false })
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
  
  export function animateMissionVision() {
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
  