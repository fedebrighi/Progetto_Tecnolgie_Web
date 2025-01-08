document.addEventListener("DOMContentLoaded", function () {
    // Per il cliente
    const togglePasswordCliente = document.querySelector(".toggle-password");
    const passwordFieldCliente = document.querySelector("#passwordCliente");

    if (togglePasswordCliente && passwordFieldCliente) {
        togglePasswordCliente.addEventListener("click", function () {
            const type = passwordFieldCliente.getAttribute("type") === "password" ? "text" : "password";
            passwordFieldCliente.setAttribute("type", type);
            this.classList.toggle("bi-eye");
            this.classList.toggle("bi-eye-slash");
        });
    }

    // Per il venditore
    const togglePasswordVenditore = document.querySelector(".toggle-password-venditore");
    const passwordFieldVenditore = document.querySelector("#passwordVenditore");

    if (togglePasswordVenditore && passwordFieldVenditore) {
        togglePasswordVenditore.addEventListener("click", function () {
            const type = passwordFieldVenditore.getAttribute("type") === "password" ? "text" : "password";
            passwordFieldVenditore.setAttribute("type", type);
            this.classList.toggle("bi-eye");
            this.classList.toggle("bi-eye-slash");
        });
    }
});