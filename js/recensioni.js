function aggiungiRecensione(codProdotto) {
    const valutazione = document.querySelector(`input[name="valutazione"][data-codprodotto="${codProdotto}"]:checked`)?.value;
    const testo = document.getElementById(`testo-${codProdotto}`)?.value;

    if (!valutazione || !testo) {
        console.error("Valutazione o testo mancanti per il prodotto:", codProdotto);
        return;
    }

    fetch('ajax/api-review.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ codProdotto, valutazione, testo })
    })
        .then(response => response.json())
        .then(data => {
            const confermaDiv = document.getElementById("conferma-recensione");
            if (data.success) {
                confermaDiv.innerHTML = `
                    <div class="alert alert-success" role="alert">
                        Recensione aggiunta con successo! Grazie per il tuo feedback.
                    </div>`;
                setTimeout(() => confermaDiv.innerHTML = "", 5000);

            } else {
                confermaDiv.innerHTML = `
                    <div class="alert alert-danger" role="alert">
                        Si è verificato un errore durante l'invio della recensione. Riprova.
                    </div>`;
            }
        })
        .catch(() => {
            const confermaDiv = document.getElementById("conferma-recensione");
            confermaDiv.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    Si è verificato un errore imprevisto. Riprova.
                </div>`;
        });
}

function selectRating(value) {
    const stars = document.querySelectorAll('.star-icon');

    stars.forEach(star => {
        const starValue = parseInt(star.getAttribute('data-value'), 10);

        if (starValue <= value) {
            star.classList.remove('bi-star', 'text-secondary');
            star.classList.add('bi-star-fill', 'text-warning');
        } else {
            star.classList.remove('bi-star-fill', 'text-warning');
            star.classList.add('bi-star', 'text-secondary');
        }
    });

    const input = document.querySelector(`input[name="valutazione"][value="${value}"]`);
    if (input) {
        input.checked = true;
    }
}

function initRecensioni() {
    const recensioneForm = document.getElementById('recensioneForm');

    if (!recensioneForm) {
        console.warn("Il form recensioneForm non è presente nel DOM.");
        return;
    }

    const stars = document.querySelectorAll('.star-icon');

    stars.forEach(star => {
        star.addEventListener('mouseenter', () => {
            const value = parseInt(star.getAttribute('data-value'), 10);
            selectRating(value);
        });

        star.addEventListener('mouseleave', () => {
            const selectedValue = parseInt(
                document.querySelector('input[name="valutazione"]:checked')?.value || 0,
                10
            );
            selectRating(selectedValue);
        });

        star.addEventListener('click', () => {
            const value = parseInt(star.getAttribute('data-value'), 10);
            selectRating(value);
        });
    });

    recensioneForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const codProdotto = document.getElementById('prodotto')?.value;
        const valutazione = document.querySelector('input[name="valutazione"]:checked')?.value;
        const testo = document.getElementById('testo')?.value;

        if (!codProdotto || !valutazione) {
            alert("Seleziona un prodotto e una valutazione.");
            return;
        }

        fetch('ajax/api-review.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ codProdotto, valutazione, testo }),
        })
            .then(response => response.json())
            .then(data => {
                const confermaRecensione = document.getElementById('conferma-recensione');
                if (data.success) {
                    confermaRecensione.innerHTML = '<p class="text-success">Grazie per la tua recensione!</p>';
                    setTimeout(() => {
                        recensioneForm.reset();
                        location.reload();
                    }, 5000);
                } else {
                    confermaRecensione.innerHTML = `<p class="text-danger">Errore: ${data.error}</p>`;
                }
            })
            .catch(() => {
                const confermaRecensione = document.getElementById('conferma-recensione');
                confermaRecensione.innerHTML = '<p class="text-danger">Errore di rete. Riprova più tardi.</p>';
            });
    });
}

document.addEventListener('DOMContentLoaded', initRecensioni);
