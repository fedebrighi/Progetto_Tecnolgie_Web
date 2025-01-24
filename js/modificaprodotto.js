function salvaModificheProdotto() {
    // Trova l'ID del prodotto dal modale aperto
    const modaleAperto = document.querySelector('.modal.show');
    const codProdotto = modaleAperto.id.split('-')[1];

    // Recupera i dati dal form corrispondente, usando gli ID dinamici
    const nome = modaleAperto.querySelector(`#modificaNome-${codProdotto}`).value;
    const alc = modaleAperto.querySelector(`#modificaAlc-${codProdotto}`).value;
    const prezzo = modaleAperto.querySelector(`#modificaPrezzo-${codProdotto}`).value;
    const descrizione = modaleAperto.querySelector(`#descrizioneProdotto-${codProdotto}`).value;
    const listaIngredienti = modaleAperto.querySelector(`#modificaListaIngredienti-${codProdotto}`).value;
    const glutenFree = modaleAperto.querySelector(`#glutenFree-${codProdotto}`).checked ? 1 : 0;

    // Creazione del payload
    const dati = {
        codProdotto: codProdotto,
        nome: nome,
        alc: alc,
        prezzo: prezzo,
        descrizione: descrizione,
        listaIngredienti: listaIngredienti,
        glutenFree: glutenFree,
    };

    // Invia i dati al server tramite fetch
    fetch('ajax/api-updateProduct.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(dati),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Modifiche salvate con successo!');
                location.reload(); // Ricarica la pagina per riflettere le modifiche
            } else {
                alert('Errore nel salvataggio: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Errore durante la richiesta:', error);
            alert('Si è verificato un errore durante il salvataggio.');
        });
}
