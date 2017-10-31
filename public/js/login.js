jQuery( function($) {

    var dataInit = location.search;
    if(dataInit == "?register") {
         $("#login-to-register").click();
    } else {
         $("#login-to-login").click();
    }


	$("#login_account").bind( "keyup", function(event) {
 		if(event.keyCode == 13) {
			$("#login_password").focus();
		}
	});

	$("#login_password").bind( "keyup", function(event) {
   		if(event.keyCode == 13) {
			$("#login_confirm").click();
		}
	});

	$(".direct_guest").click( function() {
		//location='guest.php';
		location='/guest';
	});

	$(".show_register").click( function() {
		$(".login_ctn").hide();
		$(".register_ctn").show();
	});

	$(".show_login").click( function() {
		$(".register_ctn").hide();
		$(".login_ctn").show();
	});
	
	// 登陆
	$("#login_confirm").click( function() {
		var loginAccount = $("#login_account").val();
		var loginPassword = $("#login_password").val();

		if( loginAccount == "") {
			$("#login_account").focus();
		}
		
		if( loginAccount != "" && loginPassword == "" ) {
			$("#login_password").focus();
		} else {
			
			var loginResult = LA_loginConfirm(loginAccount,loginPassword);
			if(loginResult.status) {
				//location="index.php";
				layer.msg(loginResult.log);
				location="/home";
			} else {
				$("#login_password").val("");
				$("#login_account").focus();
				$(".input-tip").html("用户名或密码 有误！");
				$(".input-tip").slideDown();
			}
		}
	});
	
	$(".register_selector").click( function() {
		$(".register_selector").removeClass("reg_selected");
		$(this).addClass("reg_selected");
	});

	$("#register-confirm").click ( function() {

        var email_allow = $("#register-email").attr("data-allow");
        var phone_allow = $("#register-phone").attr("data-allow");
        var name_allow = $("#register-name").attr("data-allow");
        var nickname_allow = $("#register-nickname").attr("data-allow");
        var realname_allow = $("#register-realname").attr("data-allow");
        var password_allow = $("#register-password").attr("data-allow");
        var password_confirm_allow = $("#register-password-confirm").attr("data-allow");

		if( (email_allow == 1) && (nickname_allow == 1) && (password_allow == 1) && (password_confirm_allow == 1) )
        {
			var register_form = $("#register-form");
            $.post('/login/register', register_form.serialize(), function(data) {
                if(data.status)
                {
                    _myAlert("注册成功",3000,"success");
                    $('#register-email').val("");
                    $('#register-phone').val("");
                    $('#register-name').val("");
                    $('#register-nickname').val("");
                    $('#register-realname').val("");
                    $('#register-password').val("");
                    $('#register-password-confirm').val("");
                    $(".input_explain").html("");
                    $(".input_explain").attr("title","");
                    $(".input-tip").html("注册成功，请登录！");
                    $(".input-tip").slideDown();
                }
                else
                {
                    _myAlert(data.msg,3000,"fail");
                    $(".input-tip").html("对不起，注册失败，请重试！");
                    $(".input-tip").slideDown();
                }
            }, 'json');
		}
        else
        {
            $(".input-tip").html("请填正确填写注册信息！");
            $(".input-tip").slideDown();
		}
	});




    // 验证 Email
    $("#register-email").blur( function() {
        var register_email = $(this).val();
        var my_explain = $(this).parent().find(".input_explain");

        if(register_email == "") {
            $(this).attr("data-allow",0);
            my_explain.html("!");
            my_explain.attr("title","用户名不能为空");
        }
        else {
            var allowText = checkEmail(register_email);
            if(!allowText) {
                $(this).attr("data-allow",0);
                my_explain.html("!");
                my_explain.attr("title","邮箱有误");
                $(".input-tip").html("邮箱有误！");
                $(".input-tip").slideDown();
            }
            else {
                var result = LA_check_email(register_email);
                if(!result.status) {
                    $(this).attr("data-allow",1);
                    my_explain.html('<span class="input_ok"></span>');
                    my_explain.attr("title","");
                    $(".input-tip").slideUp();
                } else {
                    $(this).attr("data-allow",0);
                    my_explain.html("!");
                    my_explain.attr("title","该邮箱已存在");
                    $(".input-tip").html("该邮箱已存在！");
                    $(".input-tip").slideDown();
                }
            }
        }
    });
    // 验证 Phone
	$("#register-phone").blur ( function() {
		var register_phone = $(this).val();
		var my_explain = $(this).parent().find(".input_explain");

		if(register_phone == "") {
			$(this).attr("data-allow",0);
			my_explain.html("!");
			my_explain.attr("title","用户名不能为空");
		}
        else {
			var allowText = checkPhone(register_phone);
			if(!allowText) {
					$(this).attr("data-allow",0);
					my_explain.html("!");
					my_explain.attr("title","手机号有误");
					$(".input-tip").html("手机号有误！");
					$(".input-tip").slideDown();
			}
            else {
				var result = LA_check_phone(register_phone);//layer.msg(the_result.log);
				
				if(result.status) {
                    $(this).attr("data-allow",1);
					my_explain.html('<span class="input_ok"></span>');
					my_explain.attr("title","");
					$(".input-tip").slideUp();
				}
                else {
                    $(this).attr("data-allow",0);
					my_explain.html("!");
					my_explain.attr("title","该手机已存在");
					$(".input-tip").html("该手机已存在！");
					$(".input-tip").slideDown();
				}
			}
		}
	});
    // 验证 注册名（轻博号）
	$("#register-name").blur ( function() {
		var register_name = $(this).val();
		var my_explain = $(this).parent().find(".input_explain");

		if(register_name == "") {
            $(this).attr("data-allow",0);
			my_explain.html("!");
			my_explain.attr("title","用户名不能为空");
		}
        else {
			var name_length = register_name.length;

			var allowText = checkPassname(register_name);
			if(allowText != "true") {
                $(this).attr("data-allow",0);
                my_explain.html("!");
                my_explain.attr("title","必须由字母和数字组合，字母开头");
                $(".input-tip").html("用户名必须由字母和数字组合，字母开头！");
                $(".input-tip").slideDown();
			}
            else {
				var the_result;
				the_result = LA_check_name(register_name);
				if(the_result.status) {
                    $(this).attr("data-allow",1);
					my_explain.html('<span class="input_ok"></span>');
					my_explain.attr("title","");
					$(".input-tip").slideUp();
				}
                else {
                    $(this).attr("data-allow",0);
					my_explain.html("!");
					my_explain.attr("title","该用户名已存在");
					$(".input-tip").html("该用户名已存在！");
					$(".input-tip").slideDown();
				}
			}
			
		}
	});
    // 验证 昵称
    $("#register-nickname").blur( function() {
        var  my_self = $(this);
        var  my_explain = $(this).parent().find(".input_explain");

        if($(this).val() == "") {
            $(this).attr("data-allow",0);
            my_explain.html("!");
            my_explain.attr("title","真实姓名不能为空！");
            $(".input-tip").html("真实姓名不能为空！");
            $(".input-tip").slideDown();
        }
        else {
            $(this).attr("data-allow",1);
            my_explain.html('<span class="input_ok"></span>');
            my_explain.attr("title","");
            $(".input-tip").slideUp();
        }
    });
    // 验证 真实姓名
	$("#register-realname").blur( function() {
		var  my_self = $(this);
		var  my_explain = $(this).parent().find(".input_explain");

		if($(this).val() == "") {
            $(this).attr("data-allow",0);
			my_explain.html("!");
			my_explain.attr("title","真实姓名不能为空！");
			$(".input-tip").html("真实姓名不能为空！");
			$(".input-tip").slideDown();
		}
        else {
            $(this).attr("data-allow",1);
			my_explain.html('<span class="input_ok"></span>');
			my_explain.attr("title","");
			$(".input-tip").slideUp();
		}
	});
    // 验证 密码
	$("#register-password").blur( function() {
		var  my_explain = $(this).parent().find(".input_explain");

		if($(this).val() == "") {
			$(this).attr("data-allow",0);
			my_explain.html("!");
			my_explain.attr("title","密码不能为空！");
			$(".input-tip").html("密码不能为空！");
			$(".input-tip").slideDown();
		} else if($(this).val().length < 1) {
			$(this).attr("data-allow",0);
			my_explain.html("!");
			my_explain.attr("title","密码太短，不少于6位！");
			$(".input-tip").html("密码太短，不少于6位！");
			$(".input-tip").slideDown();
		} else if($(this).val().length > 20) {
			$(this).attr("data-allow",0);
			my_explain.html("!");
			my_explain.attr("title","密码太长，不超过20位！");
			$(".input-tip").html("密码太长，不超过20位！");
			$(".input-tip").slideDown();
		} else {
			$(this).attr("data-allow",1);
			my_explain.html('<span class="input_ok"></span>');
			my_explain.attr("title","");
			$(".input-tip").slideUp();
		}
	});
    // 验证 劝人密码
	$("#register-password-confirm").blur( function() {
			var my_explain = $(this).parent().find(".input_explain");
			var loginPassword = $($(this).attr("data-password"));
			
			if(loginPassword.attr("data-allow") == "1") {
				if($(this).val() == loginPassword.val()) {
					$(this).attr("data-allow",1);
					my_explain.html('<span class="input_ok"></span>');
					my_explain.attr("title","");
					$(".input-tip").slideUp();
				} else {
					$(this).attr("data-allow",0);
					my_explain.html("!");
					my_explain.attr("title","两次密码不一致");
					$(".input-tip").html("两次密码不一致！");
					$(".input-tip").slideDown();
				}
			} else {
				$(this).attr("data-allow","0");
				my_explain.html("!");
			}
	});
    // 选择性别
	$(".sex-selector").click( function() {
		$(this).addClass("sex-selected").siblings(".sex-selector").removeClass("sex-selected");
        $("#register-sex").val($(this).attr("data-sex"));
	});




    // 验证
	$("#setF_confirm").click ( function() {

			var belongId = $("#set_belongId").val();
			var itemId = $("#set_itemId").val();
			var userItemId = $("#set_userItemId").val();
			var attaching = $("#set_attaching").val();
			
			var result = LA_setAttaching(belongId,itemId,userItemId,attaching);
			layer.msg(result.log);
			if(result.log == "set Attaching success") {
				//$("#set_belongId").val("");
				//$("#set_itemId").val("");
				//$("#set_userItemId").val("");
				$("#set_attaching").val("");
			}
	});
})


function LA_loginConfirm(account,password) // Laravel 确认登陆
{
	var result;
	jQuery.ajax
	({
		url:"/login/submit",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			account:account,
			password:password//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//alert(data.log);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}
function LA_check_name(name) // Laravel 检查注册名是否被占用
{
	var result;
	jQuery.ajax
	({
		url:"/login/check/name",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			name:name
		},
		success:function(data) {
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
function LA_check_phone(phone)// Laravel 检查手机是否被占用
{
    var result;
    jQuery.ajax
    ({
        url:"/login/check/phone",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            phone:phone
        },
        success:function(data) {
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
function LA_check_email(email)// Laravel 检查邮箱是否被占用
{
    var result;
    jQuery.ajax
    ({
        url:"/login/check/email",
        async:false,
        cache:false,
        type:"post",
        dataType:'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        data: {
            email:email
        },
        success:function(data) {
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




function LA_setAttaching(belongId,itemId,userItemId,attaching) // Laravel 设置 附图
{
	var result;
	jQuery.ajax
	({
		url:"/service/setAttaching",
		async:false,
		cache:false,
		type:"post",
		dataType:'json',
		headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
		data: {
			belongId:belongId,
			itemId:itemId,
			userItemId:userItemId,
			attaching:attaching//,
			//_token:$('meta[name="_token"]').attr('content')
		},
		success:function(data) {
			//result = $.trim(data);
			result = data;//alert(data.log);
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
		}
	});
	return result;
}

function registerCheckPassname(passname) // 检验注册名
{
	var theReturn;
	var firstString = passname.slice(0,1);
	if( checkAlnum(passname) ) {
		if( checkVar(firstString) ) {
			theReturn = "true";
		} else {
			theReturn = "首字母必须为数字";
		}
		/*if( checkdigit(passname) ) {
			theReturn = "必须有字母";
		} else {
		}*/
	} else {
		theReturn = "只能输入字母和数字";
	}
	//theReturn = "只能输入字母和数字";
	return theReturn;
}

