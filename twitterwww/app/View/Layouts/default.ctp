<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
<div class="header">
<div class="logo">
<a href="/index.php/tweets">
<img src="/img/logo.png" height="50" width="125">
</a>
</div>
<div class="headermenu">
<ul class="nav">
<li><a href="/index.php/tweets"><?php echo((AuthComponent::user() === null) ? 'ホーム' : (AuthComponent::user('name').'さん')); ?></a></li>
<?php
if (AuthComponent::user() === null) { ?>
<li><a href="/index.php/users/register">ユーザー登録</a></li>
<li><a href="/index.php/users/login">ログイン</a></li>
<?php } else { ?>
<li><a href="/index.php/users/searchUser">友だちを検索</a></li>
<li><a href="/index.php/users/logout">ログアウト</a></li>
<?php } ?>
</ul>
</div>
</div>
<div class="fakehead"></div>
<!-- 以上是header -->

<?php echo $this->fetch('content'); ?>

</body>
</html>
