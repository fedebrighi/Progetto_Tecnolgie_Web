// Funzione per creare un grafico dinamico
function creaGraficoVendite(idCanvas, prodotti) {
    const ctx = document.getElementById(idCanvas).getContext('2d');
    const labels = prodotti.map(prodotto => prodotto.nome);
    const data = prodotti.map(prodotto => prodotto.quantita);
    const backgroundColors = prodotti.map(() => `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.2)`);
    const borderColors = prodotti.map(() => `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Quantità Venduta',
                data: data,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
