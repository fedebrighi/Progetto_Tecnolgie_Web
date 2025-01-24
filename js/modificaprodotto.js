function salvaModificheProdotto() {
    const modaleAperto = document.querySelector('.modal.show');
    const idProdotto = modaleAperto.id.split('-')[1];

    const nome = modaleAperto.querySelector('#modificaNome').value;
    const alc = modaleAperto.querySelector('#modificaAlc').value;
    const prezzo = modaleAperto.querySelector('#modificaPrezzo').value;
    const descrizione = modaleAperto.querySelector('#descrizioneProdotto').value;
    const listaIngredienti = modaleAperto.querySelector('#modificaListaIngredienti').value;
    const glutenFree = modaleAperto.querySelector('#glutenFree').checked ? 1 : 0;

    const dati = {
        idProdotto: idProdotto,
        nome: nome,
        alc: alc,
        prezzo: prezzo,
        descrizione: descrizione,
        listaIngredienti: listaIngredienti,
        glutenFree: glutenFree
    };

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
                location.reload();
            } else {
                alert('Errore nel salvataggio: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Errore durante la richiesta:', error);
            alert('Si è verificato un errore durante il salvataggio.');
        });
}
