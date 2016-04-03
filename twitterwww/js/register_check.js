$(document).ready(function(){
	$("form#UserRegisterForm").submit(function(){
		if(!$("input#UserName").val().match(/^[0-9a-zA-Z_-]{4,20}$/)){
			alert("名前は[0-9a-zA-Z_-]、4文字以上、20文字以下で入力してください。");
			return false;
		}
		else if(!$("input#UserUsername").val().match(/^[0-9a-zA-Z]{4,20}$/)){
			alert("ユーザー名は[0-9a-zA-Z_-]、4文字以上、20文字以下で入力してください。");
			return false;
		}
		else if(!$("input#UserPassword").val().match(/^[0-9a-zA-Z]{4,8}$/)){
			alert("パスワードは[0-9a-zA-Z]、4文字以上、8文字以下で入力してください。");
			$("input#UserPassword").val("");
			$("input#UserPasswordCheck").val("");
			return false;
		}
		else if($("input#UserPassword").val() != $("input#UserPasswordCheck").val()){
			alert("パスワードとパスワード(確認)が異なります。");
			$("input#UserPassword").val("");
			$("input#UserPasswordCheck").val("");
			return false;
		}
		else return true;
	});
});