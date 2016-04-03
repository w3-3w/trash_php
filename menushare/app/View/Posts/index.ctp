<head>
<title>做饭香香</title>
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
		<?php foreach ($posts as $post) : ?>
		<div class="grid box">
			<?php echo $this->Session->flash(); ?>
			<div class="grid-header">
				<h3><?php echo(h($post['Post']['title'])); ?></h3>
				<ul>
				<li><span>由 <?php echo($post['User']['username']); ?> 发表于 <?php echo($post['Post']['post_time']); ?> </span></li>
				</ul>
			</div>
			<div class="grid-img-content">
				<a href="/index.php/posts/view/<?php echo($post['Post']['id']); ?>"><img src="http://menushare-postimages.stor.sinaapp.com/<?php echo($post['Post']['id']); ?>_0.jpg" /></a>
				<p><?php echo(mb_substr(h($post['Post']['content']), 0, 200, 'UTF-8')); ?> …</p>
				<div class="clear"> </div>
			</div>
			<div class="comments">
			<ul>
				<li><img src="/images/views.png" title="被浏览次数" /><span><?php echo($post['Post']['views']); ?></span></li>
				<li><img src="/images/likes.png" title="评分" /><span><?php echo($post['Rank']['avg_rank']); ?></span></li>
				<li><a class="readmore" href="/index.php/posts/view/<?php echo($post['Post']['id']); ?>">阅读全文</a></li>
			</ul>
			</div>
		</div>
		<?php endforeach; ?>
		<div class="clear"> </div>
	</div>
	<div class="clear"> </div>
	<div class="content-pagenation">
		<?php if ($page > 1) : ?>
		<li><a href="/index.php/posts">首页</a></li>
		<li><a href="/index.php/posts/index/<?php echo($page - 1); ?>">上一页</a></li>
		<?php endif; ?>
		<li><span><?php echo($page); ?></span></a></li>
		<?php if ($page < $pageCount) : ?>
		<li><a href="/index.php/posts/index/<?php echo($page + 1); ?>">下一页</a></li>
		<li><a href="/index.php/posts/index/<?php echo($pageCount); ?>">末页</a></li>
		<?php endif; ?>
		<div class="clear"> </div>
	</div>
	<div class="clear"> </div>
	<div class="footer">
		<p>MenuShare &#169	 All Rights Reserved | Developed By Steve Wei</p>
	</div>
	<div class="clear"> </div>
</div>
<!---start-right-sidebar---->
<div class="right-sidebar">
	<!--
	<div class="search-bar">
		<form>
			<input type="text" value="搜索文章" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '搜索文章';}" />
			<input type="submit" value="" />
		</form>
	</div>
	<div class="clear"> </div>
	<div class="search-bar">
		<form>
	   		<input type="text" value="搜索用户" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '搜索用户';}" />
	   		<input type="submit" value="" />
	   	</form>
	</div>
	<div class="clear"> </div>
	-->
</div>
<!---end-sidebar---->
</div>
<!---end-wrap---->
</body>