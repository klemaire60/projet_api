const express = require('express');
const app = express();

//récupération des 3 fichiers
const bastien = require('./bastien')(express);
const yann = require('./yann')(express);
const kevin = require('./kevin')(express);

app.use('/api', bastien);
app.use('/api', yann);
app.use('/api', kevin);