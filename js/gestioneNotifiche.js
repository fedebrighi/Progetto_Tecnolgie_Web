function segnaComeLetta(idNotifica) {
    fetch('ajax/api-updateNotifications.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: idNotifica,}),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Errore nella risposta del server');
            }
            location.reload();
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Notifica segnata come letta con successo!');
            } else {
                alert('Errore durante la marcatura della notifica come letta.');
            }
        })
        .catch(error => {
            console.error('Errore:', error);
            alert('Si è verificato un errore. Riprova più tardi.');
        });
}

function checkNewNotifications() {
    fetch('ajax/api-checkNotifications.php')
        .then(response => response.json())
        .then(data => {
            const badge = document.querySelector('.nav-item .badge');
            const unreadCount = data.count;

            if (unreadCount > 0) {
                if (!badge) {
                    const bellIcon = document.querySelector('.bi-bell');
                    const badgeHTML = `<span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">${unreadCount}</span>`;
                    bellIcon.insertAdjacentHTML('afterend', badgeHTML);
                } else {
                    badge.textContent = unreadCount;
                    badge.style.display = 'inline';
                }
            } else if (badge) {
                badge.style.display = 'none';
            }
        })
        .catch(error => console.error('Errore durante il controllo delle notifiche:', error));
}

setInterval(checkNewNotifications, 2000);
checkNewNotifications();