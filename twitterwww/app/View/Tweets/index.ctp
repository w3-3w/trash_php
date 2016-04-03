<?php if ($showSendPanel) { ?>
<div class="tweet_submit_panel">
<h3>いまなにしてる？</h3>
<?php echo $this->Session->flash(); ?>

<form action="/index.php/tweets/send" method="post" name="Tweet">
<textarea name="data[Tweet][content]" cols="50" rows="3" style="font:18px Arial, Helvetica, sans-serif; display:block" required="required" placeholder="15～140文字で入力してください。" maxlength="140"></textarea>
<input type="hidden" name="data[Tweet][user_id]" value="<?php echo($user['id']); ?>" />
<div class="my_last_tweet"><label for="submit">
<?php
if (empty($myLastTweet)) { ?>
<strong>初めてのつぶやきを投稿しましょう！</strong>
<?php } else { ?>
<strong>最新のつぶやき：</strong>
<?php
echo(h($myLastTweet['Tweet']['content']));
?>
<span class="posttime">
<?php echo(h($myLastTweet['Tweet']['post_time'])); ?>
</span>
</label></div>
<?php } ?>
<input type="submit" name="submit" value="投稿する" style="font-size:28px; border-radius:15px">
</form>

</div>
<hr />
<?php } ?>

<div class="tweet_home">
<h3>ホーム</h3>
<div class="tweet_list" style="background-color:#CC6" align="left">

<?php
if (count($tweets) === 0) { ?>
<div class="tweet_frame" style="font-size: 44px" align="center">
空っぽ
</div>
<?php } else { ?>
<?php foreach ($tweets as $tweet) : ?>
<div class="tweet_frame">

<?php if ($tweet['Tweet']['user_id'] == AuthComponent::user('id')) { ?>
<div class="tweet_delete_button" align="right">
<a href="/index.php/tweets/delete/<?php echo($tweet['Tweet']['id'].'?redirect='.urlencode($showSendPanel ? "/tweets/index/$page" : "/tweets/user/{$user['id']}/$page")); ?>"><img src="/img/tweet-delete.png" /></a>
</div>
<?php } ?>

<div class="tweet_item">
<p><span class="username"><a href="/index.php/tweets/user/<?php echo($tweet['Tweet']['user_id']); ?>"><?php echo($tweet['User']['username']); ?></a></span><?php echo(h($tweet['Tweet']['content'])); ?></p>
<span class="posttime"><?php echo(h($tweet['Tweet']['post_time'])); ?></span>
</div>
</div>
<?php endforeach; ?>
<?php } ?>


<div class="tweet_item" align="right">
<?php if ($page > 1) { ?>
<span><a href="/index.php/tweets/<?php echo($showSendPanel ? 'index' : "user/{$user['id']}"); ?>/<?php echo($page - 1); ?>">前へ</a></span>
<?php } ?>
<span>[<?php echo($page); ?>]</span>
<?php if (count($tweets) === 10) { ?>
<span><a href="/index.php/tweets/<?php echo($showSendPanel ? 'index' : "user/{$user['id']}"); ?>/<?php echo($page + 1); ?>">次へ</a></span>
<?php } ?>
</div>
</div>

<div class="tweet_user_panel" style="background-color:#CC8">
<p style="font-size:18px"><?php echo($user['username']); ?> | <?php echo($user['name']); ?></p>
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
</div>