
function aggiornaQuantitaTotale() {
    let totaleQuantita = 0;

    document.querySelectorAll('input[data-quantity]').forEach(input => {
        totaleQuantita += parseInt(input.value) || 0;
    });
    const quantitaTotaleElem = document.querySelector('#quantita-totale');
    if (quantitaTotaleElem) {
        quantitaTotaleElem.textContent = totaleQuantita;
    } else {
        console.error("Elemento #quantita-totale non trovato nel DOM.");
    }
    document.querySelectorAll('input[data-quantity]').forEach(input => {
        input.addEventListener('change', aggiornaQuantitaTotale);
    });
    aggiornaQuantitaTotale();
}
