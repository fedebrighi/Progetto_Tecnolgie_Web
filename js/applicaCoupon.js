document.getElementById("applyCouponButton").addEventListener("click", function () {
    const couponCode = document.getElementById("couponCode").value.trim();

    if (couponCode === "") {
        alert("Inserisci un codice coupon.");
        return;
    }

    fetch("ajax/api-applyCoupon.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({couponCode: couponCode})
    })
    .then(response => response.json())
    .then(data => {
        const couponMessage = document.getElementById("couponMessage");

        if (data.success) {
            couponMessage.classList.remove("d-none");
            couponMessage.classList.add("alert-success");
            couponMessage.textContent = `Coupon applicato con successo! Hai risparmiato ${data.discount_amount} EUR.`;

            const totalAmountElement = document.getElementById("totale");
            if (totalAmountElement) {
                const totalAmountText = totalAmountElement.innerText.trim();

                const currentTotal = parseFloat(totalAmountText.replace('€', '').trim());

                if (!isNaN(currentTotal)) {
                    let newTotal = currentTotal - parseFloat(data.discount_amount);
                    if (newTotal < 0) {
                        newTotal = 0;
                    }

                    totalAmountElement.innerText = newTotal.toFixed(2) + " €";
                } else {
                    console.error("Totale corrente non valido:", totalAmountText);
                }
            } else {
                console.error("Elemento con id 'totalAmount' non trovato.");
            }
        } else {
            couponMessage.classList.remove("d-none");
            couponMessage.classList.add("alert-danger");
            couponMessage.textContent = `Errore: ${data.message}`;
        }
    })
    .catch(error => {
        alert("Errore durante l'applicazione del coupon.");
        console.error("Errore di rete:", error);
    });
});
