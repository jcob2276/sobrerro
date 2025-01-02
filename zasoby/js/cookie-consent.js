document.addEventListener("DOMContentLoaded", function () {
    const banner = document.getElementById("cookie-consent");
    const acceptBtn = document.getElementById("accept-cookies");

    // Sprawdź, czy ciasteczka zostały zaakceptowane
    if (!localStorage.getItem("cookiesAccepted")) {
        banner.style.display = "block";
    }

    // Obsługa kliknięcia przycisku
    acceptBtn.addEventListener("click", function () {
        localStorage.setItem("cookiesAccepted", "true");
        banner.style.display = "none";
    });
});
