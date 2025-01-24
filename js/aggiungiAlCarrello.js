function addToCart(codCarrello, codProdotto, quantita) {
    fetch('ajax/api-addToCart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ codCarrello, codProdotto, quantita }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Errore HTTP: ${response.status}`);
        }
        return response.text();
    })
    .then(responseText => {
        try {
            const data = JSON.parse(responseText);
            if (data.success) {
                alert('Prodotto aggiunto al carrello!');
            } else {
                alert('Errore durante l\'aggiunta al carrello: ' + (data.error || 'Errore sconosciuto.'));
            }
        } catch (e) {
            console.error('Risposta non valida:', responseText);
            alert('Errore: Risposta del server non valida.');
        }
    })
    .catch(error => {
        console.error('Errore:', error);
        alert('Errore durante la comunicazione con il server.');
    });

}