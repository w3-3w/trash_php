$(document).ready(function(){
	$("form#UserLoginForm").submit(function(){
		if(!$("input#UserUsername").val().match(/^[0-9a-zA-Z]{4,20}$/)){
			alert("ユーザー名は[0-9a-zA-Z_-]、4文字以上、20文字以下で入力してください。");
			return false;
		}
		else if(!$("input#UserPassword").val().match(/^[0-9a-zA-Z]{4,8}$/)){
			alert("パスワードは[0-9a-zA-Z]、4文字以上、8文字以下で入力してください。");
			$("input#UserPassword").val("");
			return false;
		}
		else return true;
	});
});