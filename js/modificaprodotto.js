function salvaModifiche() {
    // Logica per salvare le modifiche
    const nome = document.getElementById('modificaNomeProdotto').value;
    const prezzo = document.getElementById('modificaPrezzoProdotto').value;
    const quantita = document.getElementById('modificaQuantitaProdotto').value;

    // Trova la riga corrispondente nella tabella
    const row = document.querySelector(`tr[data-id="${modificaProdotto.currentId}"]`);
    if (row) {
        row.querySelector('.nome').textContent = nome;
        row.querySelector('.prezzo').textContent = `€${parseFloat(prezzo).toFixed(2)}`;
        row.querySelector('.quantita').textContent = quantita;
    }

    alert(`Modifiche salvate:\nNome: ${nome}\nPrezzo: €${prezzo}\nQuantità: ${quantita}`);

    // Chiude il modale
    const modal = bootstrap.Modal.getInstance(document.getElementById('modificaProdottoModal'));
    modal.hide();
}

// Modifica la funzione modificaProdotto per salvare l'ID del prodotto
function modificaProdotto(id) {
    modificaProdotto.currentId = id; // Salva l'ID corrente per riferimenti futuri

    // Precompila i campi del prodotto selezionato
    document.getElementById('modificaNomeProdotto').value = `Prodotto ${id}`;
    document.getElementById('modificaPrezzoProdotto').value = (10.99 * id).toFixed(2);
    document.getElementById('modificaQuantitaProdotto').value = 50 + id;

    // Mostra il modale
    const modal = new bootstrap.Modal(document.getElementById('modificaProdottoModal'));
    modal.show();
}
