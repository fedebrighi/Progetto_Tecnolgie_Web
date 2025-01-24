function toggleCardForm() {
    const cardForm = document.getElementById('creditCardForm');
    const pagamentoCarta = document.getElementById('pagamentoCarta');

    if (pagamentoCarta.checked) {
        cardForm.style.display = 'block';
        document.getElementById('cardNumber').setAttribute('required', 'true');
        document.getElementById('expiryDate').setAttribute('required', 'true');
        document.getElementById('cvv').setAttribute('required', 'true');
    } else {
        cardForm.style.display = 'none';
        document.getElementById('cardNumber').removeAttribute('required');
        document.getElementById('expiryDate').removeAttribute('required');
        document.getElementById('cvv').removeAttribute('required');
    }
}

function validateExpiryDate() {
    const expiryInput = document.getElementById('expiryDate');
    const errorElement = document.getElementById('expiryError');
    const value = expiryInput.value.trim();
    const today = new Date();
    const [month, year] = value.split('/').map(num => parseInt(num, 10));

    errorElement.textContent = '';

    if (!value.match(/^(0[1-9]|1[0-2])\/\d{4}$/)) {
        errorElement.textContent = 'Formato non valido (MM/YYYY).';
        return false;
    }

    const expiryDate = new Date(year, month - 1);
    if (expiryDate < today) {
        errorElement.textContent = 'La data di scadenza non può essere nel passato.';
        return false;
    }

    return true;
}

document.addEventListener("DOMContentLoaded", () => {
    toggleCardForm();

    const expiryInput = document.getElementById('expiryDate');
    if (expiryInput) {
        expiryInput.addEventListener('input', validateExpiryDate);
    }
});

document.querySelectorAll('input[name="pagamento"]').forEach(input => {
    input.addEventListener('change', toggleCardForm);
});
