module.exports = function(express) {
    const router = express.Router();
    
    router.get('/', (req, res) => {
        //code du login
        
        
        res.send("login réussi");
    });
    
    return router;
};