document.addEventListener("DOMContentLoaded", function () {
    const togglePasswordIcons = document.querySelectorAll(".toggle-password");
    const generatePassword = document.querySelector(".generate-password");
    const passwordField = document.querySelector("#password");
    const passwordStrength = document.querySelector("#passwordStrength");
    const passwordError = document.querySelector("#passwordError");
    const submitButton = document.querySelector("#submitButton");

    // Mostra/nascondi password
    if (togglePasswordIcons.length > 0) {
        togglePasswordIcons.forEach(icon => {
            icon.addEventListener("click", function () {
                const passwordField = this.closest(".input-group").querySelector("input[type='password'], input[type='text']");
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);
                this.classList.toggle("bi-eye");
                this.classList.toggle("bi-eye-slash");
            });
        });
    }

    // Genera una password casuale
    if (generatePassword && passwordField) {
        generatePassword.addEventListener("click", function () {
            const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+[]";
            let randomPassword = "";
            for (let i = 0; i < 12; i++) {
                randomPassword += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            passwordField.value = randomPassword;
            evaluatePasswordStrength(randomPassword);
        });
    }

    // Valutare la forza della password
    if (passwordField) {
        passwordField.addEventListener("input", function () {
            const password = passwordField.value;
            evaluatePasswordStrength(password);
        });
    }

    // Controllo prima dell'invio del form
    if (submitButton && passwordField) {
        submitButton.addEventListener("click", function (event) {
            const password = passwordField.value;
            const strength = calcolaForzaPassword(password);

            if (strength < 4) {
                event.preventDefault(); // Blocca l'invio del form
                if (passwordError) {
                    passwordError.classList.remove("d-none");
                }
            } else {
                if (passwordError) {
                    passwordError.classList.add("d-none");
                }
            }
        });
    }

    // Funzione per aggiornare l'indicatore di forza della password
    function evaluatePasswordStrength(password) {
        const strength = calcolaForzaPassword(password);

        // Aggiorna l'indicatore di forza
        if (passwordStrength) {
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
    }
});

// Funzione per calcolare la forza della password
function calcolaForzaPassword(password) {
    let strength = 0;

    if (password.length >= 8) strength++; // Lunghezza minima
    if (/[a-z]/.test(password)) strength++; // Lettere minuscole
    if (/[A-Z]/.test(password)) strength++; // Lettere maiuscole
    if (/[0-9]/.test(password)) strength++; // Numeri
    if (/[^a-zA-Z0-9]/.test(password)) strength++; // Caratteri speciali

    return strength;
}
