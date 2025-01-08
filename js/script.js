document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.querySelector(".toggle-password");
    const generatePassword = document.querySelector(".generate-password");
    const passwordField = document.querySelector("#password");
    const passwordStrength = document.querySelector("#passwordStrength");
    const passwordError = document.querySelector("#passwordError");
    const submitButton = document.querySelector("#submitButton");

    // Mostra/nascondi password
    togglePassword.addEventListener("click", function () {
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
        this.classList.toggle("bi-eye");
        this.classList.toggle("bi-eye-slash");
    });

    // Genera una password casuale
    generatePassword.addEventListener("click", function () {
        const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+[]";
        let randomPassword = "";
        for (let i = 0; i < 12; i++) {
            randomPassword += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        passwordField.value = randomPassword;
        evaluatePasswordStrength(randomPassword);
    });

    // Valutare la forza della password
    passwordField.addEventListener("input", function () {
        const password = passwordField.value;
        evaluatePasswordStrength(password);
    });

    function evaluatePasswordStrength(password) {
        let strength = 0;

        if (password.length >= 8) strength++; // Lunghezza minima
        if (/[a-z]/.test(password)) strength++; // Lettere minuscole
        if (/[A-Z]/.test(password)) strength++; // Lettere maiuscole
        if (/[0-9]/.test(password)) strength++; // Numeri
        if (/[^a-zA-Z0-9]/.test(password)) strength++; // Caratteri speciali

        // Aggiorna l'indicatore di forza
        if (strength <= 2) {
            passwordStrength.textContent = "Molto debole";
            passwordStrength.className = "form-text mt-2 strength-very-weak";
        } else if (strength === 3) {
            passwordStrength.textContent = "Debole";
            passwordStrength.className = "form-text mt-2 strength-weak";
        } else if (strength === 4) {
            passwordStrength.textContent = "Forte";
            passwordStrength.className = "form-text mt-2 strength-strong";
        } else if (strength === 5) {
            passwordStrength.textContent = "Molto forte";
            passwordStrength.className = "form-text mt-2 strength-very-strong";
        } else {
            passwordStrength.textContent = "";
        }
    }

    // Controllo prima dell'invio del form
    submitButton.addEventListener("click", function (event) {
        const password = passwordField.value;
        let strength = 0;

        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;

        if (strength < 4) {
            event.preventDefault(); // Blocca l'invio del form
            passwordError.classList.remove("d-none");
        } else {
            passwordError.classList.add("d-none");
        }
    });
});
