console.log('Totale base:', totaleBase);
// Usa il valore passato dal backend tramite PHP
const basePrice = totaleBase;
// Funzione per aggiornare il totale
function updateTotal() {
    let total = basePrice; // Imposta il totale iniziale al valore calcolato dal backend
    const spedizioneRapida = document.getElementById('rapida').checked; // Controlla se è selezionata la spedizione rapida

    if (spedizioneRapida) {
        total += 5; // Aggiungi €5 per la spedizione rapida
    }

    // Aggiorna il testo del totale nella pagina
    document.getElementById('totale').textContent = `Totale: €${total}`;
}

// Inizializza il totale al caricamento della pagina
updateTotal();
