// Funzione per calcolare la quantità totale
function aggiornaQuantitaTotale() {
    let totaleQuantita = 0;

    // Seleziona tutti gli input con l'attributo data-quantity
    document.querySelectorAll('input[data-quantity]').forEach(input => {
        totaleQuantita += parseInt(input.value) || 0; // Somma i valori (usa 0 se il valore è vuoto)
    });

    // Aggiorna la quantità totale nel riepilogo
    document.querySelector('#quantita-totale').textContent = totaleQuantita;
}

// Assegna un listener di eventi per aggiornare la quantità totale
document.querySelectorAll('input[data-quantity]').forEach(input => {
    input.addEventListener('change', aggiornaQuantitaTotale);
});

// Esegui la funzione all'inizio per impostare il valore corretto
aggiornaQuantitaTotale();
