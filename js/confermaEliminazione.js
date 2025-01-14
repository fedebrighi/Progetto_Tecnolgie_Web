function confermaEliminazione(eliminaCallback) {
    if (confirm("Sicuro di voler eliminare questo prodotto?")) {
        eliminaCallback();
    }
}

function eliminaProdotto(codProdotto) {
    fetch('eliminaprodotto.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `codProdotto=${encodeURIComponent(codProdotto)}`
    })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "success") {
                alert("Prodotto eliminato con successo!");
                location.reload(); // Ricarica la pagina
            } else {
                alert("Errore durante l'eliminazione del prodotto!");
            }
        })
        .catch(error => {
            console.error("Errore:", error);
        });
}