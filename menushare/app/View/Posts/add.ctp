<head>
<title>做饭香香 - 撰写</title>
<meta charset="utf-8" />
<link href="/css/style.css" rel="stylesheet" type="text/css"  media="all" />
<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' type='text/css'>
<script src="/js/jquery-2.1.3.min.js"></script>
<script src="/js/add_post.js"></script>
<script>
var maxImageCount=<?php echo(MENUSHARE_MAXIMAGES); ?>;
</script>
</head>
<body>
<!---start-wrap---->
<div class="wrap">
<!---start-left-sidebar---->
<div class="left-sidebar">
	<div class="logo">
		<a href="/index.php/posts/index"><img src="/images/logo.png" title="logo" /></a>
		<h1>自由的菜谱分享</h1>
		<h1><?php echo(AuthComponent::user('username')); ?></h1>
	</div>
	<div class="top-nav">
		<ul>
			<li><a href="/index.php/posts/index">主页</a></li>
			<li><a href="/index.php/posts/add">发表</a></li>
			<li><a href="/index.php/users/logout">注销</a></li>
		</ul>
	</div>
</div>
<!----start-content----->
<div class="content">
	<div class="grids">
		<div class="grid box">
			<?php echo $this->Session->flash(); ?>
			<div class="form-area">
				<form action="/index.php/posts/add" id="PostSubmitForm" method="post" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="input"><input name="data[Post][title]" maxlength="100" type="text" placeholder="标题" value="<?php echo($title); ?>" autofocus="autofocus" /></div>
					<div class="textarea"><textarea name="data[Post][content]" maxlength="5000" type="text" placeholder="内容"><?php echo($content); ?></textarea></div>
					<div class="label" id="div_label_0"><label for="image_0">上传图片1：</label></div>
					<div class="input" id="div_image_0"><input name="data[Image][0]" id="image_0" type="file" accept="image/jpeg, image/pjpeg" /></div>
					<div class="input"><input name="data[Post][user_id]" type="hidden" value="<?php echo(AuthComponent::user('id')); ?>" /></div>
					<div class="input"><input type="submit" value="发表" style="width: 20%" /></div>
				</form>
			</div>
			<div class="comments">
				<ul>
				<li><a href="javascript:void(0);" id="add_pic">添加一张图片</a></li>
				<li></li>
				</ul>
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