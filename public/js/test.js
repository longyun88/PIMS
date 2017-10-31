jQuery ( function($) {
		//test();
});



	$(document).on("click",".ajaxTest",function() {
//		var result = LA_ajaxTest(1,['cuilongyun','longyun']);
//		$(".ajaxTestShow").html(result.id + result.name);
	});
	
	
	$(document).on("click",".sendx",function() {
		alert(678);
		//socket.emit('sessionHim', 120); //向服务器发送消息
		LA_socketTest(120,"sendx");
	});




function LA_socketTest(id,name)
{
	var result;
	jQuery.ajax
	({
		url:"/socketTest",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			id:id,
			name:name//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}



