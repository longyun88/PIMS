jQuery ( function($) {
	learning();
	var somearray = ["mon", "tue", "wed", "thur"];
	showArray(somearray);
	console.log("br------br");
	
	removeByValue(somearray, "tue");
	showArray(somearray);
	console.log("br------br");
	
	somearray.removeByValue("wed");
	showArray(somearray);
	console.log("br------br");
	//layer.msg($(".ajaxTestShow").attr("MD-id") + $(".ajaxTestShow").attr("MD-type"));
	
	//LA_test("sql"); // 测试token
	
});

var scope="global";  
function t(){  
    console.log(scope);  
     
    var scope="local"  
    console.log(scope);  
}  
t();


var name="globals";  
if(true){  
    var name="locals";  
    console.log(name)  
}  
console.log(name); 

function learning() 
{
	var xing = document.getElementById("xingInput");
	var ming = document.getElementById("mingInput");
	
	var showButton =document.getElementById("showButton");
	showButton.onclick=function(){
		var name = xing.value+" "+ming.value;
		var nameView = document.getElementById("nameView");
		nameView.innerHTML = name;
		return false;
	}
}


	var myApp = angular.module('pimsApp', [], function($interpolateProvider) {
		$interpolateProvider.startSymbol('[%');
		$interpolateProvider.endSymbol('%]');
	});
	myApp.controller("myCtrl",function($scope){
	});

function showArray(arr) // 输出数组
{
//	for (key in arr) {
//		console.log(arr[key]);
//	}
	for(var i=0;i<arr.length;i++) {
	console.log(arr[i]);
	}
}

function removeByValue(arr, val) // 删除数组中某一个元素
{
	for(var i=0; i<arr.length; i++) {
		if(arr[i] == val) {
			arr.splice(i, 1);
			break;
		}
	}
}

Array.prototype.removeByValue = function(val) {
	for(var i=0; i<this.length; i++) {
		if(this[i] == val) {
			this.splice(i, 1);
			break;
		}
	}
}




function LA_test(test) 
{
	layer.msg(5);
	var result;
	jQuery.ajax
	({
		url:"/myapi/test",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		data: {
			test:test//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;layer.msg(result.test);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}

