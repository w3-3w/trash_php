<script src="/js/jquery-2.1.3.min.js"></script>
<script src="/js/register_check.js"></script>
<div class="auth">
<div class="authpanel">
<h3>ツイッターに参加しましょう</h3>

<div class="authform">

<?php echo $this->Session->flash(); ?>
<form action="/index.php/users/register" id="UserRegisterForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>
<fieldset>
<legend>
<?php echo('ユーザー登録'); ?>
</legend>

<div class="input text required"><label for="UserName">名前</label><input name="data[User][name]" maxlength="20" type="text" id="UserName" placeholder="4～20文字"/></div>
<div class="input text required"><label for="UserUsername">ユーザー名</label><input name="data[User][username]" maxlength="20" type="text" id="UserUsername" placeholder="4～20文字、[0-9A-Za-z_]のみ"/></div>
<div class="input password"><label for="UserPassword">パスワード</label><input name="data[User][password]" type="password" id="UserPassword"/></div>
<div class="input password"><label for="UserPasswordCheck">パスワード（確認）</label><input name="data[User][password_check]" type="password" id="UserPasswordCheck"/></div>
<div class="input text"><label for="UserEmail">メールアドレス</label><input name="data[User][email]" maxlength="100" type="text" id="UserEmail" placeholder="100文字以内"/></div>
<div class="input checkbox required"><input type="hidden" name="data[User][public]" id="UserPublic_" value="1"/><input type="checkbox" name="data[User][public]"  value="1" id="UserPublic"/><label for="UserPublic">つぶやきを非公開にする</label></div>

</fieldset>
<div class="submit"><input  type="submit" value="登録"/></div></form>

</div>
</div>
<div class="authhelp">
<p>もうツイッターに登録していますか？<a href="/index.php/users/login">ログイン</a></p>
</div>
</div>
