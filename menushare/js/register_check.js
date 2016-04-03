$(document).ready(function(){
	$("form#UserRegisterForm").submit(function(){
		if(!$("input#reg_username").val().match(/^[0-9a-zA-Z]{4,16}$/)){
			alert("用户名仅限字母与数字，4到16字符。");
			return false;
		}
		else if(!$("input#reg_password").val().match(/^[0-9a-zA-Z_]{4,16}$/)){
			alert("密码仅限字母与数字与下划线，4到16字符。");
			$("input#reg_password").val("");
			$("input#reg_passwordC").val("");
			return false;
		}
		else if($("input#reg_password").val() != $("input#reg_passwordC").val()){
			alert("两次密码不相同，请重新输入。");
			$("input#reg_password").val("");
			$("input#reg_passwordC").val("");
			return false;
		}
		else return true;
	});
});