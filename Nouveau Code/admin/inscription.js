document.addEventListener("DOMContentLoaded", function() {

    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();

        const pseudo = document.querySelector('input[name="pseudo"]').value;
        const password = document.querySelector('input[name="password"]').value;
        const confirmPassword = document.querySelector('input[name="verif_password"]').value;
        const mail = document.querySelector('input[name="mail"]').value;
        const level = document.querySelector('select[name="level"]').value;
        const nom = document.querySelector('input[name="nom"]').value;
        const prenom = document.querySelector('input[name="prenom"]').value;

        if (password !== confirmPassword) {
            alert("Les mots de passe ne correspondent pas !");
            return;
        }

        const formData = new FormData();
        formData.append('pseudo', pseudo);
        formData.append('password', password);
        formData.append('mail', mail);
        formData.append('level', level);
        formData.append('nom', nom);
        formData.append('prenom', prenom);

        const url = `http://${window.location.hostname}:8080/register`;

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(message => {
            alert(message); 
        })
        .catch(error => {
            console.error('Erreur lors de l\'envoi de la requête:', error);
        });
    });
});