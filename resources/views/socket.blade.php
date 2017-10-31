@extends('master')
 
@section('content')
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
 
	<div class="container">
		<div class="row">
			<div class="sendx">sendx</div>
          <div class="msg-list-body user-content">
            <ul>
              <li style="display:none;"><a href="#"><span></span></a></li>
            </ul>
          </div>
			<div class="col-lg-8 col-lg-offset-2" >
				<div id="messages" ></div>
			</div>
		</div>
	</div>
	
	
	
	
	<script>
		var socket = io.connect('http://longyun.pub:8899');
		
		var myID = Math.floor(Math.random()*3+1);
		//var myID = 123;
		var name = "cui";
		var age = 17;
		var dataObj = {
			myID:myID,
			name:name,
			age:age
			};
		//socket.emit('message', dataObj); //向服务器发送消息
		socket.emit('userInit', dataObj); //向服务器发送消息
		
		socket.on('message', function (data) {
			//socket.emit('message', {rp:"fine,thank you"}); //向服务器发送消息
			$( "#messages" ).append( "<p> message "+data+"</p>" );
			//addUser(data);
		});
		socket.on('sessionS', function (data) {
			//socket.emit('message', {rp:"fine,thank you"}); //向服务器发送消息
			$( "#messages" ).append( "<p> session "+data+"</p>" );
			//addUser(data);
		});
		socket.on('userInit', function (data) {
			//socket.emit('message', {rp:"fine,thank you"}); //向服务器发送消息
			$( "#messages" ).append( "<p> userInit "+data.myID + " - " + data.name + " - " + data.id +"</p>" );
		});
	</script>
 
@endsection