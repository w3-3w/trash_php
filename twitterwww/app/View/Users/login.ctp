<script src="/js/jquery-2.1.3.min.js"></script>
<script src="/js/login_check.js"></script>
<div class="auth">
<div class="authpanel">

<div class="authform">

<?php echo($this->Session->flash('auth')); ?>
<br />
<?php echo $this->Session->flash(); ?>
<form action="/index.php/users/login" id="UserLoginForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>
<fieldset>
<legend>
<?php echo('ログイン'); ?>
</legend>

<div class="input text required"><label for="UserUsername">ユーザー名</label><input name="data[User][username]" maxlength="20" type="text" id="UserUsername"/></div>
<div class="input password"><label for="UserPassword">パスワード</label><input name="data[User][password]" type="password" id="UserPassword"/></div>

</fieldset>
<div class="submit"><input  type="submit" value="ログイン"/></div></form>

</div>
</div>
<div class="authhelp">
<p>ユーザー登録（無料）</p>
<a href="/index.php/users/register"><div class="button">ユーザー登録</div></a>
</div>
</div>