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

    if (!dati.nome || !dati.cognome || !dati.email || !dati.pw || !dati.indirizzo || !dati.citta || !dati.cap || !dati.telefono || !dati.dataNascita) {
        alert("Compila tutti i campi obbligatori!");
        return;
    }

    const oggi = new Date();
    const dataNascita = new Date(dati.dataNascita);
    const maggioreEta = new Date(oggi.getFullYear() - 18, oggi.getMonth(), oggi.getDate()); // Calcolo della data per i maggiorenni


    if (dataNascita > maggioreEta) {
        alert("Devi essere maggiorenne!");
        return;
    }

    const strength = calcolaForzaPassword(dati.pw);
    if (strength < 4) {
        alert("La password è troppo debole!");
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
