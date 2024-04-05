// Modules nécessaires
const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const sha1 = require('sha1');
const jwt = require('jsonwebtoken');
const validator = require('validator');
const multer = require('multer');
const path = require('path');

const connection = require('./db');
const user = require('./user');

const app = express();
const port = 8080;

// Middleware pour permettre CORS
app.use(cors());

// Middleware pour parser les requêtes JSON
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Set storage engine
const storage = multer.diskStorage({
  destination: './assets/img_user/',
  filename: function(req, file, cb) {
      cb(null, file.fieldname + '-' + Date.now() + path.extname(file.originalname));
  }
});

// Initialize upload
const upload = multer({
  storage: storage,
  limits: { fileSize: 1000000 }, // limite de 1 MB
  fileFilter: function(req, file, cb) {
      checkFileType(file, cb);
  }
}).single('avatar');

// Check file type
function checkFileType(file, cb) {
  // Allowed ext
  const filetypes = /jpeg|jpg|png|gif/;
  // Check ext
  const extname = filetypes.test(path.extname(file.originalname).toLowerCase());
  // Check mime
  const mimetype = filetypes.test(file.mimetype);

  if (mimetype && extname) {
      return cb(null, true);
  } else {
      cb('Error: Images only!');
  }
}

// Route pour la gestion de la connexion
app.post('/login', (req, res) => {
  const { login, password } = req.body;

  // Si l'un des deux champs est vide
  if (!login || !password) {
    return res.status(400).json({ message: 'Login et mot de passe requis' });
  }

  // Vérification de l'identifiant
  const sql = 'SELECT password FROM account WHERE pseudo = ?';

  // Tentative de sélection du compte dans la BDD
  connection.query(sql, [login], (err, results) => {
    if (err) {
      console.error('Erreur lors de l\'exécution de la requête :', err);
      return res.status(500).json({ message: 'Erreur lors de la requête' });
    }
    // Renvoi du JSON pour indiquer que l'identifiant est incorrect
    if (results.length === 0) {
      let body = `
      <div class='login'>
        <h3>
          <i class='fa fa-user' aria-hidden='true'>Identification</i>
        </h3>
        <div class='panel'>
          <img src='../assets/img/login.png'>
            Erreur : Compte inexistant
          <br>
          <div class='form'>
            Il semblerait que votre identifiant soit incorrect. Vérifiez que vous avez correctement saisi ou si le problème persiste, assurez-vous d'être bien autorisé à accèder à ce site.
          </div>
          <input type='button' class='submit' value='Retour' onClick='history.back()'>
        </div>
      </div>
      `
      return res.json({ body: body });
    }

    const dbPassword = results[0].password;
    const hashedPassword = sha1(password);

    if (dbPassword === hashedPassword) {
      let max_cours;
      let max_ressources;
      let currentUser = new user.user_info()

      // Tentative de récupération informations user, max_cours, et max_ressources
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

            // Confirmation: body interface utilisateur
            
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
                  <i class='fa fa-bars' aria-hidden='true'>Gestion du site</i>
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
                  <i class='fa fa-user' aria-hidden='true'>Gestion des comptes</i>
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
                <i class='fa fa-file-pdf-o' aria-hidden='true'>Gestion des cours</i>
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
                <p> Bienvenue sur l'interface de gestion, ici vous allez pouvoir administrer votre site facilement et rapidement à l'aide de formulaires simples et fonctionnels. Vous pouvez également gérer vos différents cours en ajoutant de nouveaux 
                ou en supprimant.</p>
                <center>
                <img src='../assets/img/capture_site.png' class='site'>
                </center>
              </div>
            </div>
            `
            const userId = userData.id_account;
            // Générer un token avec une clé secrète, qui expire dans 2 heures
            const token = jwt.sign({ login }, 'secret_key', { expiresIn: '2h' });
            res.cookie('token', token, { httpOnly: true });

           // Vérifier si l'utilisateur a déjà un token dans la base de données
            const selectTokenQuery = 'SELECT * FROM tokens WHERE id_account = ?';
            connection.query(selectTokenQuery, [userId], (err, results) => {
                if (err) {
                    console.error('Erreur lors de la récupération du token de l\'utilisateur :', err);
                    return res.status(500).json({ message: 'Erreur lors de la récupération du token de l\'utilisateur' });
                }

                if (results.length <= 0) {
                    // Si l'utilisateur n'a pas encore de token, insertion
                    const insertTokenQuery = 'INSERT INTO tokens (id_token, id_account) VALUES (?, ?)';
                    connection.query(insertTokenQuery, [token, userId], (err, result) => {
                        if (err) {
                            console.error('Erreur lors de l\'insertion du token dans la base de données :', err);
                            return res.status(500).json({ message: 'Erreur lors de l\'insertion du token dans la base de données' });
                        }     
                    });
                }
                return res.json({
                  body: body,
                  token: token,
                  name: currentUser.pseudo,
                  grade: currentUser.user_level,
                  avatar: currentUser.user_avatar
              });
            });
          });
        });
      });
    } else {
      // Mot de passe invalide
      let body = `
      <div class='login'>
        <h3><i class='fa fa-user' aria-hidden='true'></i> Identification </h3>
        <div class='panel'>
          <center>
          <img src='../assets/img/login.png'>
          Erreur : Mot de passe Invalide <br>
          </center>
          <div class='form'>
            Votre mot de passe semble invalide, vérifiez vos informations personnelles. Si le problème persiste, contactez un administrateur.
          </div>
          <input type='button' class='submit' value='Retour' onClick='history.back()'>
        </div>
      </div>
      `
      return res.json({ body: body });
    }
  });
});

app.post('/logout', (req, res) => {
  // Supprimer le token de la base de données
  const userId = req.user.id_account;
  const deleteTokenQuery = 'DELETE FROM tokens WHERE id_account = ?';
  connection.query(deleteTokenQuery, [userId], (err, result) => {
      if (err) {
          console.error('Erreur lors de la suppression du token de l\'utilisateur :', err);
          return res.status(500).json({ message: 'Erreur lors de la déconnexion' });
      }
      // Supprimer le cookie côté client
      res.clearCookie('token');

      return res.json({ message: 'Déconnexion réussie' });
  });
});

app.use((req, res, next) => {
  // Récupérer le token depuis les cookies de la requête
  const token = req.cookies.token;

  // Vérifier si le token est présent
  if (!token) {
      return res.status(401).json({ message: 'Token manquant, veuillez vous connecter.' });
  }

  try {
      // Vérifier et décoder le token
      const decoded = jwt.verify(token, 'secret_key');
      req.user = decoded;
      next();
  } catch (error) {
      return res.status(401).json({ message: 'Token invalide ou expiré, veuillez vous connecter à nouveau.' });
  }
});

// Route pour vérifier l'authentification (check-auth)
app.get('/check-auth', (req, res) => {
  return res.json({ message: 'Utilisateur authentifié.', user: req.user });
});

app.post('/register', (req, res) => {
  const { pseudo, password, mail, user_level, nom, prenom, user_avatar } = req.body;

  upload(req, res, (err) => {
    if (err) {
        return res.status(400).json({ message: err });
    } else {
      // File uploaded successfully, continue with your registration logic
      const { pseudo, password, mail, user_level, nom, prenom } = req.body;
      const user_avatar = req.file ? req.file.filename : ''; // Assuming filename is stored in database

      // Tous les champs non remplis
      if (!pseudo || !password || !mail || !nom || !prenom || !user_avatar) {
        return res.status(400).json({ message: 'Veuillez renseignez tous les champs' });
      }

      // Adresse mail invalide
      if (!validator.isEmail(mail)) {
        let body = `
        <div class='message'>
          <h3>Erreur</h3>
          <div class='info'>
            L'adresse mail utilisée est invalide, veuillez en saisir une autre.<p>
            <input type='button' class='return' value='Retour' onClick='history.back()'>
          </div>
        </div>
        `;

        return res.json({ body: body });
      }

      // Vérification de la requête SQL
      const sqlVerif = `SELECT pseudo, mail FROM account WHERE pseudo = ${pseudo} OR mail = ${mail}`;

      // Tentative de vérification
      connection.query(sqlVerif, (err, results) => {
        if (err) {
          console.log("Erreur lors de la requête SQL", err)
          return res.status(500).json({ message: 'Erreur lors de la requête' });
        }

        if (results.length === 0) {
          password = sha1(password);
          // Ajout des informations de l'utilisateur dans la base de données
          // Initialisation
          const sql = 'INSERT INTO user (pseudo, password, mail, user_level, nom, prenom, user_avatar) VALUES (?, ?, ?, ?, ?, ?, ?)';
          // Tentative d'enregistrement
          connection.query(sql, [pseudo, password, mail, user_level, nom, prenom, user_avatar], (err) => {
            if (err) {
              console.error('Erreur lors de l\'enregistrement de l\'utilisateur : ', err);

              let body = `
              <div class='message'>
                <h3>Erreur</h3>
                <div class='info'>
                  Problème lors de l'enregistrement, veuillez réessayer dans un instant.<p>
                  <input type='button' class='return' value='Retour' onClick='history.back()'>
                </div>
              </div>
              `;
              return res.json({ body: body });
            }
            // Confirmation
            console.log('Nouvel utilisateur enregistré.');

            let body = `
            <div class='message'>
              <h3>Réussie</h3>
              <div class='info'>
                <p>La création de l'utilisateur est terminée, n'oubliez pas de fournir l'identifiant et le mot de passe à la personne concernée pour qu'elle puisse se connecter.</p>
                <input type='button' class='return' value='Retour' onClick='history.back()'>
              </div>
            </div>
            `;
            return res.json({ body: body });
          });
        } else {
          // Identifiant déjà existant
          let body = `
          <div class='message'>
            <h3>Erreur</h3>
            <div class='info'>
              L'identifiant que vous souhaitez créer existe déjà, veuillez en saisir un autre.<p>
            <input type='button' class='return' value='Retour' onClick='history.back()'>
            </div>
          </div>
          `
          return res.json({ body: body });
        }
      })
    }
  });
});

// Démarrage du serveur
app.listen(port, () => {
  console.log(`Le serveur est en écoute sur le port ${port}`);
});