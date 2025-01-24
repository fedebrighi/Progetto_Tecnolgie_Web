function creaGraficoVendite(idCanvas, prodotti) {
    const canvas = document.getElementById(idCanvas);

    const ctx = canvas.getContext('2d');
    const labels = prodotti.map(prodotto => prodotto.nome);
    const data = prodotti.map(prodotto => prodotto.quantita);

    const generateBrightColor = () => {
        const r = Math.floor(Math.random() * 156) + 100;
        const g = Math.floor(Math.random() * 156) + 100;
        const b = Math.floor(Math.random() * 156) + 100;
        return { r, g, b };
    };

    const backgroundColors = prodotti.map(() => {
        const { r, g, b } = generateBrightColor();
        return `rgba(${r}, ${g}, ${b}, 0.6)`;
    });

    const borderColors = prodotti.map(() => {
        const { r, g, b } = generateBrightColor();
        return `rgba(${r}, ${g}, ${b}, 1)`;
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
                        color: 'white'
                    },
                    grid: {
                        color: 'white',
                        z: 1
                    }
                },
                x: {
                    ticks: {
                        color: 'white'
                    },
                    grid: {
                        color: 'white',
                        z: 1
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white'
                    }
                }
            },
            elements: {
                bar: {
                    backgroundColor: function(context) {
                        const index = context.dataIndex;
                        const color = backgroundColors[index];
                        return color;
                    },
                    borderSkipped: false
                }
            }
        }
    });
}
