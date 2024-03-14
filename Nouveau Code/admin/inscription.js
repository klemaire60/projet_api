const { response } = require("express");

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
            return document.body.innerHTML = `
            <div class='message'>
            <h3>Erreur</h3>
            <div class='info'>
            <p>Les deux mots-de-passe saisient sont différent, veuillez vérifier vos informations</p>
            <input type='button' class='return' value='Retour' onClick='history.back()'>
            </div>
            </div>
            `;
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
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors de la requête HTTP');
            }
            return response.json();
        })
        .then(responseData => {
            document.body.innerHTML = responseData.body;
        })
        .catch(error => {
            console.error('Erreur lors de l\'envoi de la requête:', error);
        });
    });
});