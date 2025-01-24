document.addEventListener("DOMContentLoaded", () => {
    const errorModalElement = document.getElementById('errorModal');
    if (errorModalElement) {
        const errorModal = new bootstrap.Modal(errorModalElement);
        errorModal.show();
    }
});
