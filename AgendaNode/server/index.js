const http = require('http'),
path = require('path'),
express = require('express'),
bodyParser = require('body-parser')
session = require('express-session');

const hostname = '127.0.0.1';
const port = 3000;

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

//app.use('/usuarios', RoutingUsers);
//app.use('/events', RoutingEvents);

server.listen(port, hostname, () => {
  console.log(`Server running at http://${hostname}:${port}/`);
});