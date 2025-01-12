// Funzione per aggiornare il totale del carrello
function aggiornaTotaleCarrello() {
    let totale = 0;

    // Seleziona tutti gli elementi con classe carrello-item
    const prodotti = document.querySelectorAll('.carrello-item');

    prodotti.forEach(prodotto => {
        const prezzo = parseFloat(prodotto.querySelector('.prezzo').textContent.replace('€', '').trim());
        const quantita = parseInt(prodotto.querySelector('.quantita').value, 10);
        const codProdotto = prodotto.dataset.id; // Ottieni il codice prodotto dall'attributo data-id

        // Aggiungi il prezzo totale del prodotto al totale del carrello
        totale += prezzo * quantita;

        // Aggiorna il database per questo prodotto
        aggiornaQuantitaCartAPI(codProdotto, quantita);
    });

    // Aggiorna il totale nella pagina
    const totaleElement = document.querySelector('#totale-carrello');
    if (totaleElement) {
        totaleElement.textContent = totale.toFixed(2) + ' €';
    }
}

// Funzione per aggiornare la quantità nel database tramite API
function aggiornaQuantitaCartAPI(codProdotto, quantita) {
    fetch("ajax/api-updateProductFromCart.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ codProdotto, quantita }),
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            console.error('Errore nell\'aggiornamento del database:', data.error);
            alert('Errore durante l\'aggiornamento del carrello. Riprova.');
        }
    })
    .catch(error => {
        console.error('Errore durante la comunicazione con il server:', error);
        alert('Errore durante la comunicazione con il server. Controlla la tua connessione.');
    });

}


// Aggiungi event listener per ogni input di quantità
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.quantita').forEach(input => {
        input.addEventListener('input', aggiornaTotaleCarrello);
    });

    // Calcola il totale iniziale
    aggiornaTotaleCarrello();
});
