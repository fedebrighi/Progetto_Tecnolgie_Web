// Funzione per aggiungere una recensione
function aggiungiRecensione(codProdotto) {
    document.querySelector(`input[name="valutazione"][data-codprodotto="${codProdotto}"]:checked`)?.value;
    const testo = document.getElementById(`testo-${codProdotto}`).value;

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
                setTimeout(() => confermaDiv.innerHTML = "", 5000); // Rimuove il messaggio dopo 5 secondi

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

// Funzione per modificare una recensione
function modificaRecensione(codRecensione) {
    const valutazione = document.querySelector(`#valutazione-modifica-${codRecensione}`).value;
    const testo = document.querySelector(`#testo-modifica-${codRecensione}`).value;

    inviaRecensione({ codRecensione, valutazione, testo }, "modifica");
}

// Funzione generale per inviare una recensione al server
function inviaRecensione(dati, tipo) {
    fetch("ajax/api-review.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(dati),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert(`Recensione ${tipo} con successo!`);
                location.reload();
            } else {
                alert(`Errore durante la ${tipo} della recensione.`);
            }
        })
        .catch((error) => {
            console.error(`Errore nella ${tipo} della recensione:`, error);
            alert("Si è verificato un errore. Riprova più tardi.");
        });
}

// Funzione per selezionare la valutazione
function selectRating(value) {
    const stars = document.querySelectorAll(".star-icon");

    // Aggiorna lo stile delle stelle
    stars.forEach((star) => {
        const starValue = parseInt(star.getAttribute("data-value"));
        if (starValue <= value) {
            star.classList.remove("text-secondary");
            star.classList.add("text-warning"); // Colore giallo
        } else {
            star.classList.remove("text-warning");
            star.classList.add("text-secondary"); // Colore grigio
        }
    });

    // Imposta il valore della valutazione nell'input radio
    const input = document.querySelector(`input[name="valutazione"][value="${value}"]`);
    if (input) {
        input.checked = true;
    }
}

// Inizializza il sistema di valutazione e interazioni
document.addEventListener("DOMContentLoaded", () => {
    const stars = document.querySelectorAll(".star-icon");

    // Aggiunge eventi di interazione alle stelle
    stars.forEach((star) => {
        star.addEventListener("mouseenter", () => {
            const value = parseInt(star.getAttribute("data-value"));
            selectRating(value); // Cambia il colore durante il passaggio del mouse
        });

        star.addEventListener("mouseleave", () => {
            const selectedValue = parseInt(
                document.querySelector('input[name="valutazione"]:checked')?.value || 0
            );
            selectRating(selectedValue); // Torna al valore selezionato
        });

        star.addEventListener("click", () => {
            const value = parseInt(star.getAttribute("data-value"));
            selectRating(value); // Cambia il colore al clic
        });
    });
});

document.getElementById('recensioneForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Previeni l'invio predefinito del form

    const codProdotto = document.getElementById('prodotto').value;
    const valutazione = document.querySelector('input[name="valutazione"]:checked').value;
    const testo = document.getElementById('testo').value;

    fetch('ajax/api-review.php', {
        method: 'POST', // Metodo corretto
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ codProdotto, valutazione, testo }), // Invio JSON
    })
        .then(response => response.json())
        .then(data => {
            const confermaRecensione = document.getElementById('conferma-recensione');
            if (data.success) {
                confermaRecensione.innerHTML = '<p class="text-success">Grazie per la tua recensione!</p>';
                setTimeout(() => {
                    document.getElementById('recensioneForm').reset(); // Resetta il form
                    location.reload(); // Ricarica la pagina
                }, 5000); // Timeout di 5 secondi
            } else {
                confermaRecensione.innerHTML = `<p class="text-danger">Errore: ${data.error}</p>`;
            }
        })
        .catch(error => {
            document.getElementById('conferma-recensione').innerHTML = '<p class="text-danger">Errore di rete. Riprova più tardi.</p>';
        });
});

// Funzione per gestire il cambio di stato delle stelle
function selectRating(value) {
    const stars = document.querySelectorAll('.star-icon');

    stars.forEach(star => {
        const starValue = parseInt(star.getAttribute('data-value'), 10);

        if (starValue <= value) {
            // Cambia le stelle selezionate in piene
            star.classList.remove('bi-star', 'text-secondary');
            star.classList.add('bi-star-fill', 'text-warning');
        } else {
            // Cambia le stelle non selezionate in vuote
            star.classList.remove('bi-star-fill', 'text-warning');
            star.classList.add('bi-star', 'text-secondary');
        }
    });

    // Imposta il valore della valutazione nell'input radio
    const input = document.querySelector(`input[name="valutazione"][value="${value}"]`);
    if (input) {
        input.checked = true;
    }
}

// Inizializza il sistema di valutazione
document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star-icon');

    stars.forEach(star => {
        // Quando il mouse passa sopra una stella
        star.addEventListener('mouseenter', () => {
            const value = parseInt(star.getAttribute('data-value'), 10);
            selectRating(value);
        });

        // Quando il mouse esce, torna al valore selezionato
        star.addEventListener('mouseleave', () => {
            const selectedValue = parseInt(
                document.querySelector('input[name="valutazione"]:checked')?.value || 0,
                10
            );
            selectRating(selectedValue);
        });

        // Quando si clicca su una stella
        star.addEventListener('click', () => {
            const value = parseInt(star.getAttribute('data-value'), 10);
            selectRating(value);
        });
    });
});
