function salvaModifiche() {
    const dati = {
        nome: document.getElementById("modificaNome").value.trim(),
        cognome: document.getElementById("modificaCognome").value.trim(),
        pw: document.getElementById("password").value.trim(),
        indirizzo: document.getElementById("modificaIndirizzo").value.trim(),
        citta: document.getElementById("modificaCitta").value.trim(),
        cap: document.getElementById("cap").value.trim(),
        telefono: document.getElementById("telefono").value.trim(),
        dataNascita: document.getElementById("dataNascita").value.trim(),
    };

    if (!dati.nome || !dati.cognome || !dati.pw || !dati.indirizzo || !dati.citta || !dati.cap || !dati.telefono || !dati.dataNascita) {
        alert("Compila tutti i campi obbligatori!");
        return;
    }

    const oggi = new Date();
    const dataNascita = new Date(dati.dataNascita);
    const maggioreEta = new Date(oggi.getFullYear() - 18, oggi.getMonth(), oggi.getDate());
    const dataNascitaError = document.querySelector("#dataNascitaError");
    const telefonoError = document.querySelector("#telefonoError");
    const capError = document.querySelector("#capError"); 
    isValid = true;

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

    if (!/^\d{5}$/.test(cap.value)) {
        isValid = false;
        if (capError) {
            capError.classList.remove("d-none");
        } 
    }else {
        if (capError) {
            capError.classList.add("d-none");
        } 
    }

    if (!/^\d{10}$/.test(telefono.value)) {
        isValid = false;
        if (telefonoError) {
            telefonoError.classList.remove("d-none");
        } 
    }else {
        if (telefonoError) {
            telefonoError.classList.add("d-none");
        } 
    }

    const strength = calcolaForzaPassword(dati.pw);
    if (strength < 4) {
        alert("La password è troppo debole!");
        return;
    }else if(!isValid){
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
