module.exports = function(express) {
    const router = express.Router();
  
    router.get('/bastien-route', (req, res) => {
      //code de bastien
        

      res.send("Route de Bastien");
    });
  
    return router;
  };