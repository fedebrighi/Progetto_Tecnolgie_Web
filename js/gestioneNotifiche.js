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
