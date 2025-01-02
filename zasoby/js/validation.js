document.addEventListener("DOMContentLoaded", function () {
    console.log("Skrypt JS został załadowany!"); // Sprawdzenie działania skryptu

    const form = document.getElementById("registrationForm");
    const nameInput = form.querySelector("input[name='name']");
    const emailInput = form.querySelector("input[name='email']");
    const passwordInput = form.querySelector("input[name='password']");
    
    const nameError = document.getElementById("name-error");
    const emailError = document.getElementById("email-error");
    const passwordError = document.getElementById("password-error");

    // Funkcja walidacji imienia
    nameInput.addEventListener("input", function () {
        console.log("Wpisane imię: " + nameInput.value);
        if (!/^[a-zA-Z]+$/.test(nameInput.value)) {
            nameError.textContent = "Imię może zawierać tylko litery.";
            nameInput.style.borderColor = "red";
        } else {
            nameError.textContent = "";
            nameInput.style.borderColor = "green";
        }
    });

    // Funkcja walidacji emaila
    emailInput.addEventListener("input", function () {
        console.log("Wpisany email: " + emailInput.value);
        if (!/^\S+@\S+\.\S+$/.test(emailInput.value)) {
            emailError.textContent = "Niepoprawny format adresu email.";
            emailInput.style.borderColor = "red";
        } else {
            emailError.textContent = "";
            emailInput.style.borderColor = "green";
        }
    });

    // Funkcja walidacji hasła
    passwordInput.addEventListener("input", function () {
        console.log("Wpisane hasło: " + passwordInput.value);
        const password = passwordInput.value;
        if (password.length < 8 || !/[A-Za-z]/.test(password) || !/[0-9]/.test(password)) {
            passwordError.textContent = "Hasło musi mieć minimum 8 znaków, zawierać litery i cyfry.";
            passwordInput.style.borderColor = "red";
        } else {
            passwordError.textContent = "";
            passwordInput.style.borderColor = "green";
        }
    });
});
