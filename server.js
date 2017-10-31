var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

var _ = require('underscore');
var mysql = require("mysql");

var connection = mysql.createConnection({
	host : 'localhost',
	user : 'root',
	password : '123456',
	port : '3306',
});
connection.connect(function(err) {
	if(err){
		console.log('[query] - ' + err);
		return;
	}
	console.log('[connection connect] secceed.');
});
connection.end(function(err) {
	if(err){
		console.log('[close] - ' + err);
		return;
	}
	console.log('[connection end] secceed.');
});


server.listen(8899);


	var redisClient = redis.createClient();
	redisClient.subscribe('laravelSessionChannel');

	redisClient.on("message", function(channel, data) {
		console.log("laravel service \n");
  		var jsonData = eval('(' + data + ')');
		var myID = parseInt(jsonData.myID);
		
		var toSocket = _.where(userList,{myID:myID});
		var toTSocket;
		_.each(toSocket, function(value, index, list) {
				var toTSocket = _.findWhere(io.sockets.sockets,{id:value.id});
				toTSocket.emit('sessionChannel',"xxlaravel");
		});
	});
		
var currentDate;
var userList = [];	
var guestList = [];	

io.on('connection', function (socket) {
 
	var address = socket.handshake.address; // 获取客户端IP地址
	currentDate = new Date();
	console.log(" \n ");
	console.log(" ---------------------------------------------------------------- ");
	console.log(" a client [ connected ] ---- IP " + address);
	console.log(" Time ---- " + currentDate);
	console.log(" ---------------------------------------------------------------- ");
	console.log(" \n ");
	
	// 注册在线用户
	socket.on("userInit", function(user) {
		user.id = socket.id;
		userList.push(user);
		
		currentDate = new Date();
		console.log(" ---------------------------------------------------------------- ");
		console.log(" Time： ---- " + currentDate);
		console.log(" [ user login ] - (" + _.size(userList) + ")");
		console.log(" guest  - (" + _.size(guestList) + ")");
		console.log(" ---------------------------------------------------------------- ");
		//console.log("userInit - " + user.myID + " - " + user.myName + " - " + user.id + " userInit \n");
		
//  		var jsonData = eval('(' + data + ')');
//  		//var obj = data.parseJSON(); 
//  		//var obj = JSON.parse(data);
//  		//var dataINT = parseInt(data);

		//io.emit("userInit", user);
		//socket.emit("userInit", user);
		//socket.broadcast.emit("userInit", user);
	});
	// 注册游客用户
	socket.on("guestInit", function(guest) {
		guest.id = socket.id;
		guestList.push(guest);
		
		currentDate = new Date();
		console.log(" ---------------------------------------------------------------- ");
		console.log(" Time： ---- " + currentDate);
		console.log(" home - (" + _.size(userList) + ")");
		console.log(" [ guest visit ] - (" + _.size(guestList) + ")");
		console.log(" ---------------------------------------------------------------- ");
	});
	
	var redisClient = redis.createClient();
	redisClient.subscribe('sessionChannel');
	
 	// 发消息通知指定人
	socket.on("sessionHim", function(sessionId) {
		
		var toSocket = _.where(userList,{myID:sessionId});
		var toTSocket;
		_.each(toSocket, function(value, index, list) {
				toTSocket = _.findWhere(io.sockets.sockets,{id:value.id});
				toTSocket.emit('sessionChannel',"socketxx");
		});
	});
  

//	var redisClient = redis.createClient();
//	redisClient.subscribe('sessionChannel');
  
		
		//toSocket.emit('sessionS',"xxx");
		//toSocket.emit('message',data.myID);
		
		//var toSocket = message;
		//console.log("the  " + userList[0].myID + toSocket + " - " + data + " the");
		//socket.emit(channel, userList);


//	redisClient.get("name",function(err,response) {
//		//console.log(err,response); //will print lee
//		//console.log(response); //will print lee
//	});
  
//	redisClient.info(function(err,response){
//		console.log(err,response);
//	});
 /*
  redisClient.on("message", function(channel, from, message) {
    console.log("new message in queue " + from + message + " channel");
    socket.emit(channel, message);
  });
*/ 
	// 关闭连接
	socket.on('disconnect', function() {
		var user = _.findWhere(userList,{id:socket.id});
		if(user) {
			userList = _.without(userList,user);
			//socketList = _.without(socketList,socket);
			//send the userlist to all client
			//io.emit('userList',userList);
			//send login info to all.
			//socket.broadcast.emit('loginInfo',user.name+"下线了。");
		}
		var guest = _.findWhere(guestList,{id:socket.id});
		if(guest) {
			guestList = _.without(guestList,guest);
		}
		
		currentDate = new Date();
		console.log(" ---------------------------------------------------------------- ");
		console.log(" a client [ quit ] ");
		console.log(" Time： ---- " + currentDate);
		console.log(" user - (" + _.size(userList) + ")");
		console.log(" guest - (" + _.size(guestList) + ") \n");
		console.log(" ---------------------------------------------------------------- ");
		redisClient.quit();
	});
 
});



