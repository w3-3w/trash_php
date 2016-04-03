<head>
<title>做饭香香 - 注册</title>
<meta charset="utf-8" />
<link href="/css/style.css" rel="stylesheet" type="text/css"  media="all" />
<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' type='text/css'>
<script src="/js/jquery-2.1.3.min.js"></script>
<script src="/js/register_check.js"></script>
</head>
<body>
<!---start-wrap---->
<div class="wrap">
<!---start-left-sidebar---->
<div class="left-sidebar">
	<div class="logo">
		<a href="/index.php/posts/index"><img src="/images/logo.png" title="logo" /></a>
		<h1>自由的菜谱分享</h1>
	</div>
	<div class="top-nav">
		<ul>
			<li><a href="/index.php/users/login">登录</a></li>
		</ul>
	</div>
</div>
<!----start-content----->
<div class="content">
	<div class="grids">
		<div class="grid box">
			<?php echo $this->Session->flash(); ?>
			<div class="form-area">
				<form action="/index.php/users/register" id="UserRegisterForm" method="post" accept-charset="utf-8">
					<div class="label"><label for="reg_username">用户名</label></div>
					<div class="input"><input name="data[User][username]" id="reg_username" maxlength="16" type="text" placeholder="4~16字符" autofocus="autofocus" /></div>
					<div class="label"><label for="reg_password">密码</label></div>
					<div class="input"><input name="data[User][password]" id="reg_password" maxlength="16" type="password" placeholder="4~16字符" /></div>
					<div class="label"><label for="reg_passwordC">确认密码</label></div>
					<div class="input"><input name="passwordC" id="reg_passwordC" maxlength="16" type="password" /></div>
					<div class="input"><input type="submit" value="注册" style="width: 20%" /></div>
				</form>
			</div>

		</div>
	</div>
	<div class="clear"> </div>
	<div class="footer">
		<p>MenuShare &#169	 All Rights Reserved | Developed By Steve Wei</p>
	</div>
	<div class="clear"> </div>
</div>
<!---start-right-sidebar---->
<div class="right-sidebar">

</div>
<!---end-sidebar---->
</div>
<!---end-wrap---->
</body>