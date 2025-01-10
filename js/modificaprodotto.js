function modificaProdotto(id) {
    // Logica per precompilare i campi del prodotto selezionato (esempio placeholder)
    document.getElementById('modificaNomeProdotto').value = 'Prodotto ' + id;
    document.getElementById('modificaPrezzoProdotto').value = 10.99 * id; // Esempio dinamico
    document.getElementById('modificaQuantitaProdotto').value = 50 + id; // Esempio dinamico

    // Mostra il modale
    const modal = new bootstrap.Modal(document.getElementById('modificaProdottoModal'));
    modal.show();
}

function salvaModifiche() {
    // Logica per salvare le modifiche (da implementare con backend o local storage)
    const nome = document.getElementById('modificaNomeProdotto').value;
    const prezzo = document.getElementById('modificaPrezzoProdotto').value;
    const quantita = document.getElementById('modificaQuantitaProdotto').value;

    alert(`Modifiche salvate:\nNome: ${nome}\nPrezzo: €${prezzo}\nQuantità: ${quantita}`);

    // Chiude il modale
    const modal = bootstrap.Modal.getInstance(document.getElementById('modificaProdottoModal'));
    modal.hide();
}
