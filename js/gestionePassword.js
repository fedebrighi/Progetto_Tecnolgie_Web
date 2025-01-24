document.addEventListener("DOMContentLoaded", function () {
    const togglePasswordIcons = document.querySelectorAll(".toggle-password");
    const generatePassword = document.querySelector(".generate-password");
    const passwordField = document.querySelector("#password");
    const passwordStrength = document.querySelector("#passwordStrength");
    const passwordError = document.querySelector("#passwordError");
    const submitButton = document.querySelector("#submitButton");

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

    if (passwordField) {
        passwordField.addEventListener("input", function () {
            const password = passwordField.value;
            evaluatePasswordStrength(password);
        });
    }

    if (submitButton && passwordField) {
        submitButton.addEventListener("click", function (event) {
            const password = passwordField.value;
            const strength = calcolaForzaPassword(password);

            if (strength < 4) {
                event.preventDefault();
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

    function evaluatePasswordStrength(password) {
        const strength = calcolaForzaPassword(password);

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

function calcolaForzaPassword(password) {
    let strength = 0;

    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^a-zA-Z0-9]/.test(password)) strength++;

    return strength;
}
