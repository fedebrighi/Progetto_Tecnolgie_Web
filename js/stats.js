// Funzione per creare un grafico dinamico
function creaGraficoVendite(idCanvas, prodotti) {
    const canvas = document.getElementById(idCanvas);

    const ctx = canvas.getContext('2d');
    const labels = prodotti.map(prodotto => prodotto.nome);
    const data = prodotti.map(prodotto => prodotto.quantita);

    // Genera colori accesi e brillanti
    const generateBrightColor = () => {
        const r = Math.floor(Math.random() * 156) + 100; // Valore rosso tra 100 e 255
        const g = Math.floor(Math.random() * 156) + 100; // Valore verde tra 100 e 255
        const b = Math.floor(Math.random() * 156) + 100; // Valore blu tra 100 e 255
        return { r, g, b };
    };

    const backgroundColors = prodotti.map(() => {
        const { r, g, b } = generateBrightColor();
        return `rgba(${r}, ${g}, ${b}, 0.6)`; // Colori brillanti con opacità moderata
    });

    const borderColors = prodotti.map(() => {
        const { r, g, b } = generateBrightColor();
        return `rgba(${r}, ${g}, ${b}, 1)`; // Colori brillanti completamente opachi
    });

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
                    beginAtZero: true,
                    ticks: {
                        color: 'white' // Colore delle scritte sull'asse Y
                    },
                    grid: {
                        color: 'white', // Colore della griglia orizzontale
                        z: 1 // La griglia rimane sotto il grafico
                    }
                },
                x: {
                    ticks: {
                        color: 'white' // Colore delle scritte sull'asse X
                    },
                    grid: {
                        color: 'white', // Colore della griglia verticale
                        z: 1 // La griglia rimane sotto il grafico
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white' // Colore della legenda
                    }
                }
            },
            elements: {
                bar: {
                    backgroundColor: function(context) {
                        const index = context.dataIndex;
                        const color = backgroundColors[index];
                        return color; // Mantiene visibili le barre sopra le righe
                    },
                    borderSkipped: false // Evita bordi mancanti
                }
            }
        }
    });
}
