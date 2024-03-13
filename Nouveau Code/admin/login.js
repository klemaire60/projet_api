var button = document.getElementById('submit');
button.addEventListener('click', function() {
    let login = document.getElementById('login');
    let password = document.getElementById('password');
    appelApi(login.value, password.value);
});

$(document).ready(function() {
    $('#loginForm').submit(function(event) {
        event.preventDefault(); // Empêche la soumission normale du formulaire
        
        let login = $('#login').val();
        let password = $('#password').val();
        appelApi(login, password);
    });
});

function appelApi(login, password) {
    const data = { login: login, password: password };

    const url = `http://${window.location.hostname}:8080/login`;
    
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur lors de la requête HTTP');
        }
        return response.text();
    })
    .then(responseData => {
        document.body.innerHTML = responseData;
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}
