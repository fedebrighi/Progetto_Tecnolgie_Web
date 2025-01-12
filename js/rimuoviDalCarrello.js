function removeFromCart(codCarrello, codProdotto) {
    fetch('ajax/api-removeFromCart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ codCarrello, codProdotto }),
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
                    alert('Prodotto rimosso dal carrello!');
                    location.reload();
                } else {
                    alert('Errore durante la rimozione dal carrello: ' + (data.error || 'Errore sconosciuto.'));
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