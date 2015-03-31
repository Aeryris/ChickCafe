var mysql = require('mysql');
var fs = require('fs'),
    spawn = require('child_process').spawn,
    exec = require('child_process').exec,
    child,
    querystring = require('querystring'),
    express = require('express'),
    app = express(),
    server = require('http').createServer(app),
    io = require('socket.io').listen(server, {log:true, origins:'*:*'});

var db = mysql.createPool ({
    connectionLimit : 100,
    host: 'localhost',
    user: 'root',
    password: 'testtest',
    database: 'chickcafe',
    debug: false
});

function MySqlBackup(port){
    this.port = port;
    
    this.timesList = {};
    
}

MySqlBackup.prototype.start_http = function(){
    console.log("Listening on port " + SERVER_PORT);
    server.listen(SERVER_PORT);
    app.use(function(req, res, next) {
        res.header("Access-Control-Allow-Origin", "*");
        res.header("Access-Control-Allow-Headers", "X-Requested-With");
        res.header("Access-Control-Allow-Headers", "Content-Type");
        res.header("Access-Control-Allow-Methods", "PUT, GET, POST, DELETE, OPTIONS");
        next();
    });
    app.get('/', function (req, res) {
        res.sendFile(__dirname + '/backup_terminal.html');
    });
};


MySqlBackup.prototype.start_db = function(){

};

MySqlBackup.prototype.addTime = function(time){

        db.query('INSERT INTO backup SET ?', {time:time}, function(err, result){
            if (err) throw err;
            MySqlBackup.prototype.getTimes();
            io.emit('logdata', 'Added time: '+time);
        });
    
};


MySqlBackup.prototype.removeTime = function(id, time){
    console.log('Remove time ' + id);
    db.query('DELETE FROM backup WHERE ?', {id:id}, function(err, result){
        if (err) throw err;
        io.emit('logdata', 'Removed time: '+time);
        MySqlBackup.prototype.getTimes();
    
    });
    
    
};

MySqlBackup.prototype.getTimes = function(){
        io.emit('clearlist', 'Refreshing');
        db.query('SELECT * FROM backup ORDER BY time', function(err, rows){
                //io.emit('logdata', 'Refreshing');
                io.emit('addtime', rows);  
                MySqlBackup.prototype.timesList = rows;
        });
};

MySqlBackup.prototype.start_io = function(){
    io.sockets.on('connection', function (socket) {
        
        io.emit('clearlist', 'Refreshing');
        
        socket.on('addtime', function (msg) {
            console.log('Add time: ', msg);
            MySqlBackup.prototype.addTime(msg);
        });
        
        socket.on('removetime', function (msg) {
            console.log('remove time: ', msg);
            MySqlBackup.prototype.removeTime(msg.id, msg.time);
        });
        
        MySqlBackup.prototype.getTimes();
        
    });  
    
    
    
};

MySqlBackup.prototype.tick = function(){
    
    var date = new Date();
    var time = MySqlBackup.prototype.addZero(date.getHours()) + ':' + MySqlBackup.prototype.addZero(date.getMinutes()) + ':' + MySqlBackup.prototype.addZero(date.getSeconds());
    
    
    MySqlBackup.prototype.timesList.forEach(function(row){
        if(Date.parse('01/01/2011 '+time) == Date.parse('01/01/2011 '+row.time)){    
            MySqlBackup.prototype.performBackup(time);
            return;
        } 
    });

};

MySqlBackup.prototype.start = function(){
    MySqlBackup.prototype.start_http();
    MySqlBackup.prototype.start_io();
    MySqlBackup.prototype.start_db(); 
    setInterval(MySqlBackup.prototype.tick, 1000);
};

MySqlBackup.prototype.performBackup = function(time){
    var d = new Date();
    var fileName = MySqlBackup.prototype.addZero(d.getDay()) + '-' + MySqlBackup.prototype.addZero(d.getMonth()) + '-' + MySqlBackup.prototype.addZero(d.getFullYear()) + '-' +time + '-mysql_back_up.sql';

    child = exec('mysqldump  -h localhost -u root -ptesttest chickcafe', {maxBuffer: 2000*1024}, function(error, stdout, stderr){

        var dbBackup = stdout.split('\r\n');
    

        fs.writeFile(fileName, dbBackup, function(err, data){
            if(err)
                return console.log(err);

            console.log('Back up successful, saved as:' + fileName);
          

            io.emit('logdata', 'Backup completed at: '+time);


        });
    });
};

MySqlBackup.prototype.addZero = function(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
};

const SERVER_PORT = 8080;
var backup = new MySqlBackup(SERVER_PORT);
backup.start();
backup.getTimes();