function confermaEliminazione(eliminaCallback) {
    if (confirm("Sicuro di voler eliminare questo prodotto?")) {
        eliminaCallback();
    }
}

function eliminaProdotto(codProdotto) {
    fetch('ajax/api-deleteProduct.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            codProdotto: codProdotto,
        }),
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