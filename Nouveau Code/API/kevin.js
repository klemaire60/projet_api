module.exports = function(express) {
    const router = express.Router();
  
    router.get('/kevin-route', (req, res) => {
      // Code de kevin


      res.send("Route de Kevin");
    });
  
    return router;
  };