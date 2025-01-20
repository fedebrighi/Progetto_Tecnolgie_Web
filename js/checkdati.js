document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.querySelector("#submitButton");
    const dataNascitaField = document.querySelector("#dataNascita");
    const dataNascitaError = document.querySelector("#dataNascitaError");
    const capField = document.querySelector("#cap");
    const telefonoField = document.querySelector("#telefono");

    // Validazione in tempo reale per CAP e Telefono
    capField.addEventListener("input", function () {
        capField.value = capField.value.replace(/[^0-9]/g, "").slice(0, 5);
    });

    telefonoField.addEventListener("input", function () {
        telefonoField.value = telefonoField.value.replace(/[^0-9]/g, "").slice(0, 10);
    });

    // Validazione al clic del pulsante di submit
    submitButton.addEventListener("click", function (event) {
        let isValid = true; // Variabile per tracciare la validità del form

        // Validazione Data di Nascita
        const dataNascita = new Date(dataNascitaField.value); // Valore della data inserita
        const oggi = new Date(); // Data attuale
        const maggioreEta = new Date(oggi.getFullYear() - 18, oggi.getMonth(), oggi.getDate()); // Calcolo della data per i maggiorenni

        if (dataNascita > maggioreEta) {
            isValid = false; // Il form non è valido
            dataNascitaError.classList.remove("d-none"); // Mostra il messaggio di errore
        } else {
            dataNascitaError.classList.add("d-none"); // Nascondi il messaggio di errore
        }

        // Validazione CAP
        if (!/^\d{5}$/.test(capField.value)) {
            alert("Il CAP deve contenere esattamente 5 cifre.");
            isValid = false;
        }

        // Validazione Telefono
        if (!/^\d{10}$/.test(telefonoField.value)) {
            alert("Il numero di telefono deve contenere esattamente 10 cifre.");
            isValid = false;
        }

        // Blocca l'invio del form se i dati non sono validi
        if (!isValid) {
            event.preventDefault();
        }
    });
});
