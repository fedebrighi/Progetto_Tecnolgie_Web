document.getElementById("applyCouponButton").addEventListener("click", function () {
    const couponCode = document.getElementById("couponCode").value.trim();

    if (couponCode === "") {
        alert("Inserisci un codice coupon.");
        return;
    }

    fetch("ajax/api-applyCoupon.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ couponCode: couponCode })
    })
        .then(response => response.json())
        .then(data => {
            const couponMessage = document.getElementById("couponMessage");

            if (data.success) {
                couponMessage.classList.remove("d-none", "alert-danger", "border-danger");
                couponMessage.classList.add("alert", "alert-success", "border", "border-success");
                couponMessage.textContent = `Coupon applicato con successo! Hai risparmiato ${data.discount_amount} EUR.`;

                const totalAmountElement = document.getElementById("totale");
                if (totalAmountElement) {
                    const currentTotal = parseFloat(totalAmountElement.innerText.replace('€', '').trim());
                    if (!isNaN(currentTotal)) {
                        let newTotal = currentTotal - parseFloat(data.discount_amount);
                        totalAmountElement.innerText = newTotal < 0 ? "0.00 €" : `${newTotal.toFixed(2)} €`;
                    }
                }
            } else {
                couponMessage.classList.remove("d-none", "alert-success", "border-success");
                couponMessage.classList.add("alert", "alert-danger", "border", "border-danger");
                couponMessage.textContent = `Errore: ${data.message}`;
            }


        })
        .catch(error => {
            alert("Errore durante l'applicazione del coupon.");
            console.error("Errore di rete:", error);
        });
});
