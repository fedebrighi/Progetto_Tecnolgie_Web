const basePrice = totaleBase;
function updateTotal() {
    let total = 0;
    total += basePrice;
    const spedizioneRapida = document.getElementById('rapida').checked;
    if (spedizioneRapida) {
        total += 5;
    }
    document.getElementById('totale').textContent = totale.toFixed(2) + ' €';
}

updateTotal();
