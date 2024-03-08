const express = require('express');
const app = express(); 
const login = require('./kevin');

connection.connect((err) => {
    if (err) {
      console.error('Erreur de connexion à la base de données :', err);
      throw err;
    }
    console.log('Connecté à la base de données MySQL');
  });

//récupération des différents fichiers js
const bastien = require('./bastien')(express);
const yann = require('./yann')(express);

app.use('./api', yann);
app.use('./api', bastien);
app.use('./api', login);