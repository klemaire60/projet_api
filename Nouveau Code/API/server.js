const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const sha1 = require('sha1');

const app = express();
const port = 8080;

// Middleware pour permettre CORS
app.use(cors());

// Middleware pour parser les requêtes JSON
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Connexion à la base de données MySQL
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'journalltrpedago',
  password: 'Pedago1234',
  database: 'journalltrpedago'
});

connection.connect((err) => {
  if (err) {
    console.error('Erreur de connexion à la base de données :', err);
    throw err;
  }
  console.log('Connecté à la base de données MySQL');
});

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
      return res.status(401).json({ message: 'Login incorrect' });
    }
    
    const dbPassword = results[0].password;
    const hashedPassword = sha1(password);
    
    if (dbPassword === hashedPassword) {
      return res.json({ success: true });
    } else {
      return res.status(401).json({ message: 'Mot de passe incorrect' });
    }
  });
});

// Démarrage du serveur
app.listen(port, () => {
  console.log(`Le serveur est en écoute sur le port ${port}`);
});
