<?php if ($mode != 'search') { ?>
<div class="tweet_user_panel" style="background-color:#CC8; margin-right: 20px">
<p style="font-size:18px"><?php echo($user['username']); ?> | <?php echo(h($user['name'])); ?></p>
<div class="user_stats">
<p><?php echo($followCount); ?></p>
<a href="/index.php/users/followList/<?php echo($user['id']); ?>/follow">フォローしている</a>
</div>
<div class="user_stats">
<p><?php echo($followedCount); ?></p>
<a href="/index.php/users/followList/<?php echo($user['id']); ?>/followed">フォローされている</a>
</div>
<div class="user_stats">
<p><?php echo($tweetCount); ?></p>
<a href="/index.php/tweets/user/<?php echo($user['id']); ?>">投稿数</a>
</div>
</div>
<?php } ?>


<div class="tweet_home">

<div class="tweet_submit_panel">

<?php if ($mode == 'search') { ?>
<h3><?php echo($keyword); ?>の検索結果：</h3>
<form action="/index.php/users/searchUser" method="get" name="Search">
<input name="keyword" type="search" value="<?php echo($keyword); ?>" placeholder="ユーザー名や名前で検索"/>
<input type="submit" name="submit" value="検索" />
</form>
<?php }
elseif ($mode == 'followed') echo((($user['id'] == AuthComponent::user('id')) ? 'わたし' : $user['username'])."は{$followedCount}人にフォローされています。");
else echo((($user['id'] == AuthComponent::user('id')) ? 'わたし' : $user['username'])."は{$followCount}人をフォローしています。"); ?>

</div>

<hr />

<div class="tweet_list" style="background-color:#CC6; width:75%" align="left">

<?php if (count($userList) === 0) { ?>
<div class="tweet_frame" style="font-size: 32px<?php if ($mode == 'search') echo('; color:red'); ?>" align="center">
<?php echo(($mode == 'search') ? '対象のユーザーはみつかりません。' : '空っぽ'); ?>
</div>
<?php }
else { ?>

<div class="tweet_frame">
<?php foreach($userList as $userItem) : ?>

<?php if ($userItem['User']['id'] != AuthComponent::user('id')) { ?>
<div class="tweet_delete_button" align="right">
<?php if (array_key_exists($userItem['User']['id'], $this->Session->read('User.followList'))) { ?>
<a href="/index.php/users/unfollow/<?php echo($userItem['User']['id']); ?>?redirect=<?php echo(urlencode(
($mode == 'search') ? "/users/userList/$keyword/$page" : "/users/followList/{$user['id']}/$mode/$page"
)); ?>"><img src="/img/unfollow.png" width="24" height="24"></a>
<?php }
else { ?>
<a href="/index.php/users/follow/<?php echo($userItem['User']['id']); ?>?redirect=<?php echo(urlencode(
($mode == 'search') ? "/users/userList/$keyword/$page" : "/users/followList/{$user['id']}/$mode/$page"
)); ?>"><img src="/img/follow.png" width="24" height="24"></a>
<?php } ?>
</div>
<?php } ?>

<div class="tweet_item">
<p><span class="username"><a href="/index.php/tweets/user/<?php echo($userItem['User']['id']); ?>"><?php echo($userItem['User']['username']); ?></a></span><span class="username" style="color: #000"><?php echo(h($userItem['User']['name'])); ?></span></p>
<p><?php if (isset($userItem['Tweet'][0])) echo('<strong>最新のつぶやき：</strong>'.h($userItem['Tweet'][0]['content'])); else echo('<span style="color:blue">このユーザーは、つぶやきを一つも投稿しなかった。</span>'); ?></p>
<span class="posttime"><?php if (isset($userItem['Tweet'][0])) echo($userItem['Tweet'][0]['post_time']); ?></span>
</div>
<?php endforeach; ?>
</div>

<?php } ?>

<div class="tweet_item" align="right">
<?php if ($page > 1) { ?>
<span><a href="/index.php/users/<?php echo(($mode == 'search') ? "userList/$keyword" : "followList/{$user['id']}/$mode"); ?>/<?php echo($page - 1); ?>">前へ</a></span>
<?php } ?>
<span>[<?php echo($page); ?>]</span>
<?php if (count($userList) === 10) { ?>
<span><a href="/index.php/users/<?php echo(($mode == 'search') ? "userList/$keyword" : "followList/{$user['id']}/$mode"); ?>/<?php echo($page + 1); ?>">前へ</a></span>
<?php } ?>
</div>
</div>
</div>