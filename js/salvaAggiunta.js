function salvaAggiunta(codProdotto) {
    // Ottieni il valore della quantità da aggiungere
    const quantityInput = document.getElementById(`quantity-${codProdotto}`);
    const quantity = parseInt(quantityInput.value);

    // Controlla che la quantità sia valida
    if (isNaN(quantity) || quantity <= 0) {
        alert("Inserisci una quantità valida.");
        return;
    }

    // Invia la richiesta POST al server
    fetch('ajax/api-aggiungiBirra.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            codProdotto: codProdotto,
            quantita: quantity
        }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Birra aggiunta al magazzino con successo!");
                location.reload(); // Ricarica la pagina per aggiornare i dati
            } else {
                alert("Errore durante l'aggiunta al magazzino: " + data.error);
            }
        })
        .catch(error => {
            console.error("Errore nella richiesta:", error);
            alert("Si è verificato un errore. Riprova.");
        });
}
