module.exports = function(express, mysql) {
    const router = express.Router();
    const app = express();
    const connection = mysql.createConnection({
        host : localhost
    })

    router.get('/', (req, res) => {
        //code du login
        

        res.send("login réussi");
    });
    
    return router;
};