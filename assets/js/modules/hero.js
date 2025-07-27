
export function handleHeroCarousel() {
    const $ = jQuery;

    $(".carousel").carousel({
        interval: 5000, // Cambia cada 5 segundos
        ride: "carousel",
    });
}
