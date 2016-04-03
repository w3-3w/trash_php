<head>
<title>做饭香香 - 登录</title>
<meta charset="utf-8" />
<link href="/css/style.css" rel="stylesheet" type="text/css"  media="all" />
<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' type='text/css'>
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
			<li><a href="/index.php/users/register">注册</a></li>
		</ul>
	</div>
</div>
<!----start-content----->
<div class="content">
	<div class="grids">
		<div class="grid box">
			<?php echo($this->Session->flash('auth')); ?>
			<?php echo $this->Session->flash(); ?>
			<div class="form-area">
				<form action="/index.php/users/login" id="UserLoginForm" method="post" accept-charset="utf-8">
					<div class="label"><label for="l_username">用户名</label></div>
					<div class="input"><input name="data[User][username]" id="l_username" maxlength="16" type="text" placeholder="4~16字符" value="<?php echo($username); ?>" autofocus="autofocus" /></div>
					<div class="label"><label for="l_password">密码</label></div>
					<div class="input"><input name="data[User][password]" id="l_password" maxlength="16" type="password" placeholder="4~16字符" /></div>
					<div class="input"><input type="submit" value="登录" style="width: 20%" /></div>
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