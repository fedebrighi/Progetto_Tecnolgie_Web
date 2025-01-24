window.addEventListener('DOMContentLoaded', function() {
    // Verifica se l'utente è già stato verificato
    if (localStorage.getItem('ageVerified')) {
        return; // Se l'utente è già stato verificato, non mostrare il banner
    }

    var banner = document.querySelector('.age-verification-slider');
    var yesButton = document.querySelector('.yes-btn');
    var noButton = document.querySelector('.no-btn');

    // Mostra il banner con un'animazione
    setTimeout(function() {
        banner.classList.add('show'); // Aggiungi l'animazione
    }, 1000);  // Delay di 1 secondo per vedere l'effetto di discesa

    yesButton.addEventListener('click', function() {
        banner.style.display = 'none';  // Nascondi il banner
        localStorage.setItem('ageVerified', 'true');  // Salva lo stato dell'utente
    });

    noButton.addEventListener('click', function() {
        window.location.href = 'https://www.google.com'; // Reindirizza dove vuoi, esci dal sito
    });
});

localStorage.removeItem('ageVerified');
