const connection = require('./db');

// Création d'une classe utilisateur
class user_info {

    // attributs de l'utilisateur
    constructor() {
        this.pseudo = null;
        this.nom = null;
        this.prenom = null;
        this.mail = null;
        this.date_creation = null;
        this.last_connexion = null;
        this.ip_connexion = null;
        this.user_level = null;
        this.user_avatar = null;
        this.id_account = null;
    }

    // Méthode de sélection d'utilisateur avec en paramètre un pseudo
    select_user(pseudo, callback) {
        const sql = `SELECT pseudo, nom, prenom, mail, date_creation, last_connexion, ip_connexion, user_level, user_avatar, id_account FROM account WHERE pseudo = ?`;
        
        connection.query(sql, [pseudo], (err, results) => {
            if (err) {
                console.error('Erreur lors de l\'exécution de la requête :', err);
                return callback(err);
            }
            
            if (results.length === 0) {
                return callback(null, null); 
            }
            
            const user = results[0];

            this.pseudo = user.pseudo;
            this.nom = user.nom;
            this.prenom = user.prenom;
            this.mail = user.mail;
            this.date_creation = user.date_creation;
            this.last_connexion = user.last_connexion;
            this.ip_connexion = user.ip_connexion;
            this.user_level = user.user_level;
            this.user_avatar = user.user_avatar;
            this.id_account = user.id_account;

            callback(null, {
                pseudo: this.pseudo,
                nom: this.nom,
                prenom: this.prenom,
                mail: this.mail,
                date_creation: this.date_creation,
                last_connexion: this.last_connexion,
                ip_connexion: this.ip_connexion,
                user_level: this.user_level,
                user_avatar: this.user_avatar,
                id_account: this.id_account
            });
        });
    }
}

module.exports = { user_info };
