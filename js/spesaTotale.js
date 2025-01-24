function aggiornaTotaleCarrello() {
    let totale = 0;
    const prodotti = document.querySelectorAll('.carrello-item');

    prodotti.forEach(prodotto => {
        const prezzo = parseFloat(prodotto.querySelector('.prezzo').textContent.replace('€', '').trim());
        const quantitaInput = prodotto.querySelector('.quantita');
        let quantita = parseInt(quantitaInput.value, 10);

        // Gestione valore vuoto o non valido
        if (isNaN(quantita) || quantita < 0) {
            quantita = 0; // Imposta un valore predefinito
            quantitaInput.value = 0; // Corregge il valore nel campo input
        }

        totale += prezzo * quantita; // Calcolo totale
    });

    const totaleElement = document.querySelector('#totale-carrello');
    if (totaleElement) {
        totaleElement.textContent = totale.toFixed(2) + ' €';
    }
}

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
        } else {
            console.log(`Aggiornamento riuscito per prodotto ${codProdotto}.`);
        }
    })
    .catch(error => {
        console.error('Errore durante la comunicazione con il server:', error);
        alert('Errore durante la comunicazione con il server. Controlla la tua connessione.');
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const inputsQuantita = document.querySelectorAll('.quantita');

    inputsQuantita.forEach(input => {
        // Aggiorna il totale in tempo reale
        input.addEventListener('input', aggiornaTotaleCarrello);

        // Aggiorna il database quando l'utente termina l'input
        input.addEventListener('blur', () => {
            const prodotto = input.closest('.carrello-item');
            const codProdotto = prodotto.dataset.id;
            const quantita = parseInt(input.value, 10) || 0;
            aggiornaQuantitaCartAPI(codProdotto, quantita);
        });
    });

    aggiornaTotaleCarrello(); // Calcola il totale all'inizio
});
