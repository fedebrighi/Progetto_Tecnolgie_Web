document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.querySelector("#submitButton");
    const usernameField = document.querySelector("#username");
    const dataNascitaField = document.querySelector("#dataNascita");
    const dataNascitaError = document.querySelector("#dataNascitaError");
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
            let isValid = true;

            // Verifica username
            const username = usernameField.value;
            fetch('ajax/api-checkUsername.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username: username })
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    alert("Lo username è già in uso.");
                    isValid = false;  // Imposta isValid su false se lo username esiste
                }

                // Verifica la data di nascita (minimo 18 anni)
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

                // Verifica il CAP
                if (capField && !/^\d{5}$/.test(capField.value)) {
                    alert("Il CAP deve contenere esattamente 5 cifre.");
                    isValid = false;
                }

                // Verifica il telefono
                if (telefonoField && !/^\d{10}$/.test(telefonoField.value)) {
                    alert("Il numero di telefono deve contenere esattamente 10 cifre.");
                    isValid = false;
                }

                // Se tutto è valido, invia il modulo, altrimenti bloccalo
                if (!isValid) {
                    event.preventDefault();  // Blocca l'invio del form
                }
            })
            .catch(error => {
                console.error('Errore di rete:', error);
            });
        });
    }
});
