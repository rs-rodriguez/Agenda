const http = require('http'),
path = require('path'),
express = require('express'),
bodyParser = require('body-parser')
session = require('express-session');
mongoClient = require('mongodb').MongoClient,
mongoose = require('mongoose');

connection = mongoose.connect('mongodb://192.168.56.101/agenda_db',function(error){
  if(error){
    console.log(error.name +" "+ error.message);
  }else{
    console.log('Conectado a MongoDB');
  }
});

const hostname = '127.0.0.1';
const port = 3000;


const RoutingUsers = require('./rutasUsuarios'),
      RoutingEvents = require('./rutasEventos') 

const app = express();

const server = http.createServer(app);

app.use(express.static('./client'));
app.use(bodyParser.json()) ;
app.use(bodyParser.urlencoded({ extended: true}));
app.use(session({ 
    secret: 'secret-pass', 
    cookie: { maxAge: 3600000 }, 
    resave: false,
    saveUninitialized: true,
  }));

  app.get('/', function(req, res){
    res.render('index');
 });

 app.use('/usuarios', RoutingUsers)
 app.use('/events', RoutingEvents)
 
server.listen(port, hostname, () => {
  console.log(`Server running at http://${hostname}:${port}/`);
});