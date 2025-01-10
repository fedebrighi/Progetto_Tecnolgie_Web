// Configura e crea il grafico
const ctx = document.getElementById('graficoVendite').getContext('2d');
const graficoVendite = new Chart(ctx, {
    type: 'bar', // Tipo di grafico (bar, line, pie, ecc.)
    data: {
        labels: ['Prodotto 1', 'Prodotto 2'], // Etichette asse X
        datasets: [{
            label: 'Quantità Venduta',
            data: [200, 150], // Dati asse Y
            backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
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