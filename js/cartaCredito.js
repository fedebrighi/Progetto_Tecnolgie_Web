// Funzione per mostrare/nascondere il form dei dati della carta di credito
function toggleCardForm() {
    const cardForm = document.getElementById('creditCardForm');
    const pagamentoCarta = document.getElementById('pagamentoCarta');

    // Mostra il form solo se l'opzione "Carta di credito" è selezionata
    if (pagamentoCarta.checked) {
        cardForm.style.display = 'block';
    } else {
        cardForm.style.display = 'none';
    }
}

// Validazione del mese/anno della carta
function validateExpiryDate() {
    const expiryInput = document.getElementById('expiryDate');
    const errorElement = document.getElementById('expiryError');
    const value = expiryInput.value.trim();
    const today = new Date();
    const [month, year] = value.split('/').map(num => parseInt(num, 10));

    // Resetta eventuali errori
    errorElement.textContent = '';

    // Controlla il formato e la validità della data
    if (!value.match(/^(0[1-9]|1[0-2])\/\d{4}$/)) {
        errorElement.textContent = 'Formato non valido (MM/YYYY).';
        return false;
    }

    // Controlla che la data non sia nel passato
    const expiryDate = new Date(year, month - 1); // Il mese inizia da 0
    if (expiryDate < today) {
        errorElement.textContent = 'La data di scadenza non può essere nel passato.';
        return false;
    }

    return true;
}

// Esegui la funzione al caricamento della pagina per impostare lo stato iniziale
document.addEventListener("DOMContentLoaded", () => {
    toggleCardForm();

    // Aggiungi evento di validazione all'input della data di scadenza
    const expiryInput = document.getElementById('expiryDate');
    if (expiryInput) {
        expiryInput.addEventListener('input', validateExpiryDate);
    }
});

// Aggiungi il listener per rilevare cambiamenti nelle opzioni di pagamento
document.querySelectorAll('input[name="pagamento"]').forEach(input => {
    input.addEventListener('change', toggleCardForm);
});
