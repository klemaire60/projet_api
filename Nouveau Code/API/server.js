const express = require('express');
const app = express(); 
const mysql = require('mysql')
const port = 8080;

const connection = mysql.createConnection({
  host : 'localhost',
  user : 'journalltrpedago',
  password : 'Pedago1234',
  database : 'journalltrpedago'
})

connection.connect((err) => {
  if (err) {
    console.error('Erreur de connexion à la base de données :', err);
    throw err;
  }
  console.log('Connecté à la base de données MySQL');
});

// Démarrer le serveur
app.listen(port, () => {
  console.log(`Le serveur est en écoute sur le port ${port}`);
});

app.post('/login', (req, res) => {
  
  const { login, mdp } = req.body;
  
  if (!login || !mdp) {
    return res.status(400).json({ message: 'login et mdp requis' });
  }
  
  const sql = 'SELECT password FROM account WHERE pseudo = (?)';
  
  // Exécute la requête
  connection.query(sql, [login], (err, results) => {
    if (err) {
      console.error('Erreur lors de l\'exécution de la requête :', err);
      res.status(500).send('Erreur lors de la requête');
      return;
    }
    
    if(results == '') {
      req.body.success = false;
      return
    }
    else 
    {
      let passwd = sha1(results);
      req.body.success = passwd === mdp;
    }
    
    res.json(req.body);
  });
});