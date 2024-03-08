const express = require('express');
const router = express.Router();

// Middleware pour la route "/login"
router.post('/', (req, res) => {

    connection.query(`SELECT * FROM account WHERE pseudo = ${pseudo}`)
    res.send('Code de gestion du login');
});

module.exports = router;