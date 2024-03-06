const express = require('express');
const mysql = require("mysql");
const app = express();

//récupération des différents fichiers js
const login = require('./kevin/login')(express);
const bastien = require('./bastien')(express);
const yann = require('./yann')(express);

app.use('/api', bastien);
app.use('/api', yann);
app.use('/api', login);