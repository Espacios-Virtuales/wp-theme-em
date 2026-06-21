(function () {
  function setMessage(form, message, type) {
    var messageEl = form.querySelector(".ev-community-onboarding__message");

    if (!messageEl) {
      return;
    }

    messageEl.textContent = message || "";
    messageEl.classList.remove("is-success", "is-error");

    if (type) {
      messageEl.classList.add(type === "success" ? "is-success" : "is-error");
    }
  }

  function setLoading(form, isLoading) {
    var button = form.querySelector('button[type="submit"]');

    if (!button) {
      return;
    }

    if (!button.dataset.originalText) {
      button.dataset.originalText = button.textContent;
    }

    button.disabled = isLoading;
    button.textContent = isLoading ? "Enviando..." : button.dataset.originalText;
  }

  function getAjaxUrl() {
    if (window.ajax_object && window.ajax_object.ajax_url) {
      return window.ajax_object.ajax_url;
    }

    return "/wp-admin/admin-ajax.php";
  }

  function handleSubmit(event) {
    event.preventDefault();

    var form = event.currentTarget;
    var formData = new FormData(form);

    setMessage(form, "", "");
    setLoading(form, true);
    formData.set("action", "handle_community_onboarding");

    fetch(getAjaxUrl(), {
      method: "POST",
      credentials: "same-origin",
      body: formData,
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (response) {
        if (response && response.success) {
          setMessage(form, response.data, "success");
          form.reset();
          return;
        }

        setMessage(
          form,
          response && response.data ? response.data : "No fue posible enviar el formulario.",
          "error"
        );
      })
      .catch(function () {
        setMessage(form, "No fue posible enviar el formulario.", "error");
      })
      .finally(function () {
        setLoading(form, false);
      });
  }

  function initCommunityOnboardingForms() {
    var forms = document.querySelectorAll(".ev-community-onboarding-form");

    forms.forEach(function (form) {
      if (form.dataset.communityOnboardingReady === "true") {
        return;
      }

      form.dataset.communityOnboardingReady = "true";
      form.addEventListener("submit", handleSubmit);
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initCommunityOnboardingForms);
  } else {
    initCommunityOnboardingForms();
  }
})();
