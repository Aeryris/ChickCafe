var http = require('http'),
    express = require('express'),
    app = express();

const SERVER_PORT = 8081;


app.get('/', function(req, res){
    console.log(req);
});

function Notification(){};

Notification.prototype.ticker = function(){

};

Notification.prototype.send = function(to, msg){
    
};


app.listen(SERVER_PORT);


