document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.querySelector("#submitButton");
    const dataNascitaField = document.querySelector("#dataNascita");
    const dataNascitaError = document.querySelector("#dataNascitaError");

    submitButton.addEventListener("click", function (event) {
        const dataNascita = new Date(dataNascitaField.value); // Valore della data inserita
        const oggi = new Date(); // Data attuale
        const maggioreEta = new Date(oggi.getFullYear() - 18, oggi.getMonth(), oggi.getDate()); // Calcolo della data per i maggiorenni

        // Controlla se l'utente è nato dopo il 2007
        if (dataNascita > maggioreEta) {
            event.preventDefault(); // Blocca l'invio del form
            dataNascitaError.classList.remove("d-none"); // Mostra il messaggio di errore
        } else {
            dataNascitaError.classList.add("d-none"); // Nascondi il messaggio di errore
        }
    });
});
