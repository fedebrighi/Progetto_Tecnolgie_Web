const basePrice = totaleBase;

function updateTotal() {
    let total = basePrice; 
    const spedizioneRapida = document.getElementById('rapida').checked; 
    if (spedizioneRapida) {
        total += 5;
    }
    document.getElementById('totale').textContent = total.toFixed(2) + ' €';
}

updateTotal();
