<div class="welcome">
<h2>友だちを見つけて、フォローしましょう！</h2>
<p>ツイッターに登録済みの友達を検索できます。</p>
<p>誰を検索しますか？</p>
<?php echo($this->Session->flash()); ?>
<form action="/index.php/users/searchUser" method="get" name="Search">
<input name="keyword" type="search" style="font-size:24px" required="required" maxlength="20" placeholder="ユーザー名や名前で検索" />
<input name="search_button" type="submit" value="検索" style="font-size:24px" />
<br />
<br />
<p align="right" style="margin-right:20px;font-size:12px">クリエイターのユーザー名：<span style="color:blue">wwxxww</span></p>
</form>
</div>