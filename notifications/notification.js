var mysql = require('mysql');
var http = require('http'),
    express = require('express'),
    app = express(),
    server = require('http').createServer(app),
    io = require('socket.io').listen(server, {log:true, origins:'*:*'});

const SERVER_PORT = 8081;

var db = mysql.createPool ({
    connectionLimit : 100,
    host: 'localhost',
    user: 'root',
    password: 'testtest',
    database: 'chickcafe',
    debug: false
});

var user_id = [];





server.listen(SERVER_PORT);
app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "X-Requested-With");
    res.header("Access-Control-Allow-Headers", "Content-Type");
    res.header("Access-Control-Allow-Methods", "PUT, GET, POST, DELETE, OPTIONS");
    next();
});
app.get('/', function (req, res) {
    res.sendFile(__dirname + '/notification.html');
});

//function

function refresh(){
   // console.log('Node refresh');
    io.emit('refresh', 'Notifications list');
}
setInterval(refresh,1000);

function dbNotifications(){
    io.on('connection', function (socket) {
        socket.on('fetch', function (msg) {
            console.log('Fetch', msg);
            io.emit('refresh', 'Notifications list');
        });

    });
}
io.on('connection', function (socket) {
    socket.on('userid', function (data) {
        user_id = data.user_id;

        console.log("Started with user ID: " + user_id);
    });
});



//io.on('check', function )


app.get('/', function(req, res){
    console.log(req);
});

function Notification(){};

Notification.prototype.ticker = function(){

};

Notification.prototype.send = function(to, msg){
    
};





