document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.querySelector("#submitButton");
    const usernameField = document.querySelector("#username");
    const emailField = document.querySelector("#email");
    const dataNascitaField = document.querySelector("#dataNascita");
    const dataNascitaError = document.querySelector("#dataNascitaError");
    const usernameError = document.querySelector("#usernameError");
    const emailError = document.querySelector("#emailError"); 
    const capField = document.querySelector("#cap");
    const capError = document.querySelector("#capError");
    const telefonoField = document.querySelector("#telefono");
    const telefonoError = document.querySelector("#telefonoError");

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

                    if (dataNascitaField) {
                        const dataNascita = new Date(dataNascitaField.value);
                        const oggi = new Date();
                        const maggioreEta = new Date(
                            oggi.getFullYear() - 18,
                            oggi.getMonth(),
                            oggi.getDate()
                        );

                        if (dataNascita > maggioreEta) {
                            isValid = false;
                            if (dataNascitaError) {
                                dataNascitaError.classList.remove("d-none");
                            }
                        } else {
                            if (dataNascitaError) {
                                dataNascitaError.classList.add("d-none");
                            }
                        }
                    }

                    if (capField && !/^\d{5}$/.test(capField.value)) {
                        isValid = false;
                        if (capError) {
                            capError.classList.remove("d-none");
                        } 
                    }else {
                        if (capError) {
                            capError.classList.add("d-none");
                        } 
                    }

                    if (telefonoField && !/^\d{10}$/.test(telefonoField.value)) {
                        isValid = false;
                        if (telefonoError) {
                            telefonoError.classList.remove("d-none");
                        } 
                    }else {
                        if (telefonoError) {
                            telefonoError.classList.add("d-none");
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
