function toggleFavorite(codProdotto) {
    fetch("ajax/api-toggle_favorite.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ codProdotto: codProdotto }),
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.success) {
            const icon = document.getElementById("icon-favorite-" + codProdotto);
            const text = document.getElementById("favorite-text-" + codProdotto);

            if (data.action === "added") {
                icon.classList.remove("bi-heart");
                icon.classList.add("bi-heart-fill");
                text.textContent = "Rimuovi il prodotto dai tuoi preferiti";
                alert("Prodotto aggiunto ai preferiti!");
            } else {
                icon.classList.remove("bi-heart-fill");
                icon.classList.add("bi-heart");
                text.textContent = "Aggiungi il prodotto ai tuoi Preferiti";
                alert("Prodotto rimosso dai preferiti.");

                location.reload();
            }
        } else {
            alert(data.message || "Errore nella gestione dei preferiti.");
        }
    })
    .catch((error) => {
        console.error("Errore di rete:", error);
        alert("Errore nella comunicazione con il server.");
    });
}
