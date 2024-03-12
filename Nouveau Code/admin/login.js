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
        return response.json();
    })
    .then(responseData => {
        if (responseData.success) {
            document.body.innerHTML = `	<div class='navbar_admin'>
            <h4>Interface de Gestion</h4>
            <div class='panel'>
                <!--Correction dans le src-->
                <img src='".$user->user_avatar."'>
                <p>Bienvenue <!--$user->pseudo--></p>
                <p>Grade : <i class='fa fa-user-secret' aria-hidden='true'></i> Administrateur</p>
                <!--Correction ici-->
                <a href='index.php?p=account'>
                    <div class='my_account'>
                        <p><i class='fa fa-user' aria-hidden='true'></i> Mon compte</p>
                    </div>
                </a>
            </div>
            <!--Début de la partie Admin/dev-->
            <h3>
                <p><i class='fa fa-bars' aria-hidden='true'></i> Gestion du Site</p>
                <div class='button'>
                    <i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i>
                </div>
            </h3> 
            <div class='show_1'>
                <!--Php à ajouter pour chaque onglet (V2/admin/index.php L.63 - 95)-->
                <a href='index.php?p=g_onglet'><span>Onglet</span></a>
                <a href='index.php?p=actualite'><span>Actualité</span></a>
            </div>
            <div class='more'>...</div>
            <h3>
                <p><i class='fa fa-user' aria-hidden='true'></i> Gestion des Comptes</p>
                <div class='button2'>
                    <i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i>
                </div>
            </h3> 
            <div class='show_2'>
                <a href='index.php?p=addaccount'><span> Ajouter un utilisateur</span></a>		
                <a href='index.php?p=listaccount'><span> Liste des utilisateurs</span></a>
            </div>
            <div class='more1'>...</div>
            <!--Fin de la partie Admin/dev-->
            <h3>
                <i class='fa fa-file-pdf-o' aria-hidden='true'></i> Gestion des Cours
                <div class='button3'>
                    <i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i>
                </div>
            </h3> 
            <div class='show_3'>
                <!--Php à ajouter pour chaque onglet (V2/admin/index.php L.100 - 1209)-->
                <a href='index.php?p=a_chapitre'><span> Ajouter un chapitre</span></a>
                <a href='index.php?p=a_cours'><span> Ajouter un cours</span></a>
                <a href='index.php?p=a_ressource'><span> Ajouter ressource</span></a>
            </div>
            <div class='more2'>...</div>
            <h3>
                <p><i class='fa fa-bars' aria-hidden='true'></i> Listing</p>
                <div class='button'>
                    <i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i>
                </div>
            </h3> 
            <a href='index.php?p=liste_chapitre'><span> Liste des chapitres</span></a>
            <a href='index.php?p=liste_cours'><span> Liste des cours</span></a>
            <a href='index.php?p=liste_ressources'><span> Liste des ressources</span></a>
            <a href='index.php?p=liste_onglets'><span> Liste des onglets</span></a>
            <a href='index.php?p=liste_actualite'><span> Liste des actualités</span></a>
            <div class='sign'>
                by &copy;jbourdon
            </div>
        </div> `;
        } else {
            console.log('Réponse de l\'API :', "Insert Ko");
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}
