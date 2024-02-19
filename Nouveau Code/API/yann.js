// yann.js
module.exports = function(express) {
    const router = express.Router();
  
    router.get('/yann-route', (req, res) => {
      //code de yann

      
      res.send("Route de Yann");
    });
  
    return router;
  };
  