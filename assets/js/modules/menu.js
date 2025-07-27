export function handleMenuNavigation() {
    $(".menu-toggle").on("click", function () {
      $("#site-navigation").toggleClass("menu-open");
      const expanded = $(this).attr("aria-expanded") === "true" || false;
      $(this).attr("aria-expanded", !expanded);
    });
  
    $(document).on("click", function (e) {
      if (!$(e.target).closest("#site-navigation").length && $("#site-navigation").hasClass("menu-open")) {
        $("#site-navigation").removeClass("menu-open");
        $(".menu-toggle").attr("aria-expanded", false);
      }
    });
  }
  