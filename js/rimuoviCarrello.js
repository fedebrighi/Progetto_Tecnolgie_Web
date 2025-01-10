document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".remove-from-cart").forEach(button => {
        button.addEventListener("click", function () {
            const productId = this.dataset.id;

            fetch("carrello.php?action=remove", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ productId: productId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Rimuove il prodotto dalla pagina
                        this.closest(".col-12").remove();

                        // Aggiorna il totale
                        const totalElement = document.querySelector(".text-warning");
                        if (totalElement) {
                            totalElement.textContent = `${data.total} €`;
                        }
                    } else {
                        alert("Errore nella rimozione del prodotto.");
                    }
                })
                .catch(error => console.error("Errore:", error));
        });
    });
});
