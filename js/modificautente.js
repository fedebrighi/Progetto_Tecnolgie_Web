function salvaModifiche() {
    const dati = {
        nome: document.getElementById("modificaNome").value.trim(),
        cognome: document.getElementById("modificaCognome").value.trim(),
        email: document.getElementById("modificaEmail").value.trim(),
        pw: document.getElementById("password").value.trim(),
        indirizzo: document.getElementById("modificaIndirizzo").value.trim(),
        citta: document.getElementById("modificaCitta").value.trim(),
        cap: document.getElementById("modificaCAP").value.trim(),
        telefono: document.getElementById("modificaTelefono").value.trim(),
        dataNascita: document.getElementById("dataNascita").value.trim(),
    };

    // Controlla se i campi obbligatori sono vuoti
    if (!dati.nome || !dati.cognome || !dati.email || !dati.pw || !dati.indirizzo || !dati.citta || !dati.cap || !dati.telefono || !dati.dataNascita) {
        alert("Compila tutti i campi obbligatori!");
        return;
    }

    fetch("ajax/api-updateUser.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(dati),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Modifiche salvate con successo!");
                location.reload();
            } else {
                console.error("Errore:", data);
                alert("Errore nel salvataggio: " + data.error);
            }
        })
        .catch(error => {
            console.error("Errore durante la richiesta:", error);
            alert("Errore durante la comunicazione con il server.");
        });
}
