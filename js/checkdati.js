document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.querySelector("#submitButton");
    const usernameField = document.querySelector("#username");
    const emailField = document.querySelector("#email"); // Campo email
    const dataNascitaField = document.querySelector("#dataNascita");
    const dataNascitaError = document.querySelector("#dataNascitaError");
    const usernameError = document.querySelector("#usernameError");
    const emailError = document.querySelector("#emailError"); // Div per errore email
    const capField = document.querySelector("#cap");
    const telefonoField = document.querySelector("#telefono");

    if (capField) {
        capField.addEventListener("input", function () {
            capField.value = capField.value.replace(/[^0-9]/g, "").slice(0, 5);
        });
    }

    if (telefonoField) {
        telefonoField.addEventListener("input", function () {
            telefonoField.value = telefonoField.value.replace(/[^0-9]/g, "").slice(0, 10);
        });
    }

    if (submitButton) {
        submitButton.addEventListener("click", function (event) {
            event.preventDefault();

            const username = usernameField.value;
            const email = emailField.value; // Recupera il valore dell'email
            let isValid = true;

            fetch('ajax/api-checkUsername.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username: username }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        if (usernameError) {
                            usernameError.classList.remove("d-none");
                        }
                        isValid = false;
                    } else {
                        if (usernameError) {
                            usernameError.classList.add("d-none");
                        }
                    }

                    return fetch('ajax/api-checkEmail.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ email: email }),
                    });
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        if (emailError) {
                            emailError.classList.remove("d-none");
                        }
                        isValid = false;
                    } else {
                        if (emailError) {
                            emailError.classList.add("d-none");
                        }
                    }

                    if (isValid) {
                        console.log("Invio il form");
                        document.querySelector("form").submit();
                    }
                })
                .catch(error => {
                    console.error("Errore durante il fetch:", error);
                });
        });
    }
});
