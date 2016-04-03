<head>
<title>做饭香香 - 文章</title>
<meta charset="utf-8" />
<link href="/css/style.css" rel="stylesheet" type="text/css"  media="all" />
<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' type='text/css'>
<script src="/js/jquery-2.1.3.min.js"></script>
<script src="/js/post_detail.js"></script>
<script>
var postId=<?php echo($post['Post']['id']); ?>;
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
			<div class="grid-header">
			<h3><?php echo(h($post['Post']['title'])); ?></h3>
			<ul>
				<li><span>由 <?php echo($post['User']['username']); ?> 发表于 <?php echo($post['Post']['post_time']); ?> </span></li>
			</ul>
			</div>
			<div class="singlepage">
				
				<?php for ($i = 0; $i < $post['Post']['img_count']; $i += 1) : ?>
				<img src="http://menushare-postimages.stor.sinaapp.com/<?php echo($post['Post']['id'].'_'.$i); ?>.jpg" />
				<?php endfor; ?>
				
				<p><?php echo(strtr(h($post['Post']['content']), array("\n" => '</p><p>'))); ?></p>
				<div class="clear"> </div>
			</div>
			<div class="comments">
			<ul>
				<li><img src="/images/<?php echo($isRanked ? 'likes1' : 'likes'); ?>.png" title="评分" id="rank_pic"/><span id="avg_rank"><?php echo($avgRank); ?></span></li>
				<li><?php if (! $isRanked) : ?>
				<img src="/images/star_deactivated.png" title="评一星" id="star_1" class="rank" />
				<img src="/images/star_deactivated.png" title="评二星" id="star_2" class="rank" />
				<img src="/images/star_deactivated.png" title="评三星" id="star_3" class="rank" />
				<img src="/images/star_deactivated.png" title="评四星" id="star_4" class="rank" />
				<img src="/images/star_deactivated.png" title="评五星" id="star_5" class="rank" />
				<?php endif; ?></li>
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