function toggleFavorite(codProdotto) {
    fetch('ajax/toggleFavorite.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ codProdotto: codProdotto })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const icon = document.getElementById('icon-favorite');
                const text = document.getElementById('favorite-text');

                if (data.added) {
                    icon.classList.remove('bi-heart');
                    icon.classList.add('bi-heart-fill');
                    text.textContent = 'Rimuovi dai preferiti';
                } else {
                    icon.classList.remove('bi-heart-fill');
                    icon.classList.add('bi-heart');
                    text.textContent = 'Aggiungi ai preferiti';
                }
            } else {
                alert('Errore durante l\'aggiornamento dei preferiti.');
            }
        })
        .catch(error => console.error('Errore:', error));
}
