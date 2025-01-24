document.addEventListener("DOMContentLoaded", () => {
    const confermaStatoButtons = document.querySelectorAll(".conferma-stato-button");

    confermaStatoButtons.forEach(button => {
        button.addEventListener("click", () => {
            const ordineId = button.getAttribute("data-ordine-id");
            const selectedStato = document.querySelector(`input[name="stato-${ordineId}"]:checked`);
            const tipoSpedizione = button.getAttribute("data-tipo-spedizione");
            if (selectedStato) {
                const stato = selectedStato.value;


                const oggi = new Date();
                const anno = oggi.getFullYear();
                const mese = String(oggi.getMonth() + 1).padStart(2, '0');
                const giorno = String(oggi.getDate()).padStart(2, '0');
                const data = `${anno}-${mese}-${giorno}`;
                let dataPrevista;

                if (stato === "Spedito") {

                    if (tipoSpedizione === "standard") {

                        const dataPrevistaObj = new Date(oggi);
                        dataPrevistaObj.setDate(dataPrevistaObj.getDate() + 8);

                        const annoPrevisto = dataPrevistaObj.getFullYear();
                        const mesePrevisto = String(dataPrevistaObj.getMonth() + 1).padStart(2, '0');
                        const giornoPrevisto = String(dataPrevistaObj.getDate()).padStart(2, '0');
                        dataPrevista = `${annoPrevisto}-${mesePrevisto}-${giornoPrevisto}`;

                        console.log("Data prevista:", dataPrevista); // Debug: Verifica la data prevista
                    }
                    else {
                        const dataPrevistaObj = new Date(oggi);
                        dataPrevistaObj.setDate(dataPrevistaObj.getDate() + 4);
                        const annoPrevisto = dataPrevistaObj.getFullYear();
                        const mesePrevisto = String(dataPrevistaObj.getMonth() + 1).padStart(2, '0');
                        const giornoPrevisto = String(dataPrevistaObj.getDate()).padStart(2, '0');
                        dataPrevista = `${annoPrevisto}-${mesePrevisto}-${giornoPrevisto}`;

                        console.log("Data prevista:", dataPrevista); // Debug: Verifica la data prevista
                    }
                } else {
                    dataPrevista = data;
                }

                // Effettua la richiesta POST per aggiornare lo stato
                fetch("ajax/api-updateOrderStatus.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        codiceOrdine: ordineId,
                        nuovoStato: stato,
                        data: data,
                        dataPrevista: dataPrevista,
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Stato aggiornato con successo!");
                            location.reload();
                        } else {
                            alert("Errore durante l'aggiornamento dello stato.");
                        }
                    })
                    .catch(error => {
                        console.error("Errore:", error);
                    });
            } else {
                alert("Seleziona uno stato.");
            }
        });
    });
});
