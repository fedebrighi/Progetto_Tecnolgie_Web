document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.querySelector("#submitButton");
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
                alert("Il CAP deve contenere esattamente 5 cifre.");
                isValid = false;
            }

            if (telefonoField && !/^\d{10}$/.test(telefonoField.value)) {
                alert("Il numero di telefono deve contenere esattamente 10 cifre.");
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    }
});
