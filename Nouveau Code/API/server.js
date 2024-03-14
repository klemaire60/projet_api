const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const sha1 = require('sha1');
const jwt = require('jsonwebtoken');

const connection = require('./db');
const user = require('./user'); 

const app = express();
const port = 8080;

// Middleware pour permettre CORS
app.use(cors());

// Middleware pour parser les requêtes JSON
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

//Peut-être supprimer
/*
app.get('/', (req, res) => {
  console.log('ok');
  if(req.query.p === 'home') {
    let body = `
    ﻿
    <div class='navbar_admin'>
    <h4>Interface de Gestion</h4>
    <div class='panel'>
    <center>
    <img src='"${currentUser.user_avatar}"'>
    <p>Bienvenue ${currentUser.pseudo}</p>
    <i class='fa fa-user-secret' aria-hidden='true'>Grade : ${currentUser.user_level}</i>
    <a href='index.html?p=account'>
    <div class='my_account'>
    <i class='fa fa-user' aria-hidden='true'>Mon compte</i>
    </div>
    </a>
    </center>
    </div>
    ${currentUser.user_level === 'administrateur' || currentUser.user_level === 'developpeur' ? `
    <h3>
    <i class='fa fa-bars' aria-hidden='true'>Gestion du Site</i>
    <div class='button'>
    <i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i>
    </div>
    </h3> 
    <div class='show_1'>
    <a href='index.html?p=g_onglet'>
    <span>Onglet</span>
    </a>
    <a href='index.html?p=actualite'>
    <span>Actualité</span>
    </a>
    </div>
    <div class='more'>...</div>
    <h3>
    <i class='fa fa-user' aria-hidden='true'>Gestion des Comptes</i>
    <div class='button2'>
    <i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i>
    </div>
    </h3> 
    <div class='show_2'>
    <a href='index.html?p=addaccount'>
    <span>Ajouter un utilisateur</span>
    </a>		
    <a href='index.html?p=listaccount'>
    <span> Liste des utilisateurs</span>
    </a>
    </div>
    <div class='more1'>...</div>
    ` : ``}
    <h3>
    <i class='fa fa-file-pdf-o' aria-hidden='true'>Gestion des Cours</i>
    <div class='button3'>
    <i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i>
    </div>
    </h3> 
    <div class='show_3'>
    <a href='index.html?p=a_chapitre'>
    <span>Ajouter un chapitre</span>
    <a href='index.html?p=a_cours'>
    <span>Ajouter un cours</span>
    <a href='index.html?p=a_ressource'>
    <span> Ajouter ressource</span>
    </a>
    </div>
    <div class='more2'>...</div>
    <h3>
    <i class='fa fa-bars' aria-hidden='true'>Listing</i>
    <div class='button'>
    <i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i>
    </div>
    </h3> 
    <a href='index.html?p=liste_chapitre'>
    <span>Liste des chapitres</span>
    </a>
    <a href='index.html?p=liste_cours'>
    <span>Liste des cours</span>
    </a>
    <a href='index.html?p=liste_ressources'>
    <span> Liste des ressources</span>
    </a>
    <a href='index.html?p=liste_onglets'>
    <span> Liste des onglets</span>
    </a>
    <a href='index.html?p=liste_actualite'>
    <span> Liste des actualités</span>
    </a>
    <div class='sign'>
    by &copy;jbourdon
    </div>
    </div>
    <div id='home'>
    <div class='title'>
    <div class='button_deco'>
    <a href='index.html?p=deconnexion'>
    <i class='fa fa-power-off' aria-hidden='true'>Déconnexion</i>
    </a>
    </div>
    <h3>Accueil</h3>
    </div>
    <div class='stat'>
    <div class='box'>
    <img src='../assets/img/livre.png' width=70%;>
    <br>
    <span class='line'></span> 
    <h2> Nombre de cours : ${max_cours}</h2>
    </div>
    <div class='box'>
    <img src='../assets/img/file.png' width=30%;>
    <br>
    <span class='line'></span> 
    <h2> Nombre de ressource :${max_ressources}</h2>
    </div>								
    </div>
    <div class='home_news'>
    <h3>Information</h3>
    <p> Bienvenue sur l'interface de gestion, ici vous allez pouvoir administrer votre site facilement et rapidement a l'aide de formulaire simple et fonctionnel. Vous pouvez également gêrer vos différents cours en ajoutant de nouveau 
    ou en supprimant.</p>
    <center>
    <img src='../assets/img/capture_site.png' class='site'>
    </center>
    </div>
    </div>
    `
    res.send(body);
  } 
})
*/

// Route pour la gestion de la connexion
app.post('/login', (req, res) => {
  const { login, password } = req.body;
  
  if (!login || !password) {
    return res.status(400).json({ message: 'Login et mot de passe requis' });
  }
  
  const sql = 'SELECT password FROM account WHERE pseudo = ?';
  
  connection.query(sql, [login], (err, results) => {
    if (err) {
      console.error('Erreur lors de l\'exécution de la requête :', err);
      return res.status(500).json({ message: 'Erreur lors de la requête' });
    }
    if (results.length === 0) {
      let body = `
      <div class='login'>
      <h3>
      <i class='fa fa-user' aria-hidden='true'>Identification</i>
      </h3>
      <div class='panel'>
      <img src='../assets/img/login.png'>
      Erreur : Compte innexistant
      <br>
      <div class='form'>
      Il semblerait que votre identifiant soit incorrecte. Vérifiez que vous avez correctement saisi ou si le problème persiste assurez vous d'être bien autorisé à accèder à ce site.
      </div>
      <input type='button' class='submit' value='Retour' onClick='history.back()'>
      </div>
      </div>
      `
      return res.json({body : body});
    }
    
    const dbPassword = results[0].password;
    const hashedPassword = sha1(password);
    
    if (dbPassword === hashedPassword) {
      let max_cours;
      let max_ressources;
      let currentUser = new user.user_info()
      currentUser.select_user(login, (err, userData) => {
        if (err) {
          console.error('Erreur lors de la récupération des informations utilisateur :', err);
          return res.status(500).json({ message: 'Erreur lors de la récupération des informations utilisateur' });
        }
        
        connection.query("SELECT MAX(id_cour) AS max_cours FROM cour", (err, results) => {
          if (err) {
            console.error("Erreur lors de la récupération de max_cours :", err);
            return res.status(500).json({ message: 'Erreur lors de la récupération de max_cours' });
          }
          
          const maxCoursResult = results[0];
          const max_cours = maxCoursResult ? maxCoursResult.max_cours || 0 : 0;
          
          connection.query("SELECT MAX(id) AS max_ressources FROM ressource", (err, results) => {
            if (err) {
              console.error("Erreur lors de la récupération de max_ressources :", err);
              return res.status(500).json({ message: 'Erreur lors de la récupération de max_ressources' });
            }
            
            const maxRessourcesResult = results[0];
            const max_ressources = maxRessourcesResult ? maxRessourcesResult.max_ressources || 0 : 0;
            
            let body = `
            ﻿
            <div class='navbar_admin'>
            <h4>Interface de Gestion</h4>
            <div class='panel'>
            <center>
            <img src='"${currentUser.user_avatar}"'>
            <p>Bienvenue ${currentUser.pseudo}</p>
            <i class='fa fa-user-secret' aria-hidden='true'>Grade : ${currentUser.user_level}</i>
            <a href='index.html?p=account'>
            <div class='my_account'>
            <i class='fa fa-user' aria-hidden='true'>Mon compte</i>
            </div>
            </a>
            </center>
            </div>
            ${currentUser.user_level === 'administrateur' || currentUser.user_level === 'developpeur' ? `
            <h3>
            <i class='fa fa-bars' aria-hidden='true'>Gestion du Site</i>
            <div class='button'>
            <i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i>
            </div>
            </h3> 
            <div class='show_1'>
            <a href='index.html?p=g_onglet'>
            <span>Onglet</span>
            </a>
            <a href='index.html?p=actualite'>
            <span>Actualité</span>
            </a>
            </div>
            <div class='more'>...</div>
            <h3>
            <i class='fa fa-user' aria-hidden='true'>Gestion des Comptes</i>
            <div class='button2'>
            <i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i>
            </div>
            </h3> 
            <div class='show_2'>
            <a href='./inscription.html'>
            <span>Ajouter un utilisateur</span>
            </a>		
            <a href='index.html?p=listaccount'>
            <span> Liste des utilisateurs</span>
            </a>
            </div>
            <div class='more1'>...</div>
            ` : ``}
            <h3>
            <i class='fa fa-file-pdf-o' aria-hidden='true'>Gestion des Cours</i>
            <div class='button3'>
            <i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i>
            </div>
            </h3> 
            <div class='show_3'>
            <a href='index.html?p=a_chapitre'>
            <span>Ajouter un chapitre</span>
            <a href='index.html?p=a_cours'>
            <span>Ajouter un cours</span>
            <a href='index.html?p=a_ressource'>
            <span> Ajouter ressource</span>
            </a>
            </div>
            <div class='more2'>...</div>
            <h3>
            <i class='fa fa-bars' aria-hidden='true'>Listing</i>
            <div class='button'>
            <i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i>
            </div>
            </h3> 
            <a href='index.html?p=liste_chapitre'>
            <span>Liste des chapitres</span>
            </a>
            <a href='index.html?p=liste_cours'>
            <span>Liste des cours</span>
            </a>
            <a href='index.html?p=liste_ressources'>
            <span> Liste des ressources</span>
            </a>
            <a href='index.html?p=liste_onglets'>
            <span> Liste des onglets</span>
            </a>
            <a href='index.html?p=liste_actualite'>
            <span> Liste des actualités</span>
            </a>
            <div class='sign'>
            by &copy;jbourdon
            </div>
            </div>
            <div id='home'>
            <div class='title'>
            <div class='button_deco'>
            <a href='index.html?p=deconnexion'><i class='fa fa-power-off' aria-hidden='true'>Déconnexion</i></a>
            </div>
            <h3>Accueil</h3>
            </div>
            <div class='stat'>
            <div class='box'>
            <img src='../assets/img/livre.png' width=70%;>
            <br>
            <span class='line'></span> 
            <h2> Nombre de cours : ${max_cours}</h2>
            </div>
            <div class='box'>
            <img src='../assets/img/file.png' width=30%;>
            <br>
            <span class='line'></span> 
            <h2> Nombre de ressource :${max_ressources}</h2>
            </div>								
            </div>
            <div class='home_news'>
            <h3>Information</h3>
            <p> Bienvenue sur l'interface de gestion, ici vous allez pouvoir administrer votre site facilement et rapidement a l'aide de formulaire simple et fonctionnel. Vous pouvez également gêrer vos différents cours en ajoutant de nouveau 
            ou en supprimant.</p>
            <center>
            <img src='../assets/img/capture_site.png' class='site'>
            </center>
            </div>
            </div>
            `
            const token = jwt.sign({ login }, 'secret_key', { expiresIn: '2h' }); // Générer un token avec une clé secrète et une expiration de 1 heure
            
            return res.json({
              body : body,
              token : token,
              name : currentUser.pseudo,
              grade : currentUser.user_level,
              avatar : currentUser.user_avatar
            });
          });
        });
      });
    } else {
      let body = `
      <div class='login'>
      <h3><i class='fa fa-user' aria-hidden='true'></i> Identification </h3>
      <div class='panel'>
      <center>
      <img src='../assets/img/login.png'>
      Erreur : Mot de passe Invalide <br>
      </center>
      <div class='form'>
      Votre Mot de Passe semble invalide, verifiez vos informations personnelles, si le problème persiste contactez un Administrateur.
      </div>
      <input type='button' class='submit' value='Retour' onClick='history.back()'>
      </div>
      </div>
      `
      return res.json({body : body});
    }
  });
});

//Début inscription

app.post('/register' , (req, res) => {
  const {pseudo, password, mail, user_level, nom, prenom, user_avatar } = req.body;

    if (!pseudo || !password || !mail || !nom || !prenom || !user_avatar) {
    return res.status(400).json({ message: 'Veuillez renseignez tout les champs' });
  }

  password = sha1(password);

  const sql = 'INSERT INTO user (pseudo, password, mail, user_level, nom, prenom, user_avatar) VALUES (?, ?, ?, ?, ?, ?, ?)';
  connection.query(sql, [pseudo, password, mail, user_level, nom, prenom, user_avatar], (err, res) => {
    if (err) {
      console.error('Erreur lors de l\'enregistrement de l\'utilisateur : ' + err.stack);
      return res.status(400).json('Erreur lors de l\'enregistrement de l\'utilisateur.');
      
    }
    console.log('Utilisateur enregistré.');
    res.send('Utilisateur enregistré.');
  });
});

//Fin inscription

// Démarrage du serveur
app.listen(port, () => {
  console.log(`Le serveur est en écoute sur le port ${port}`);
});