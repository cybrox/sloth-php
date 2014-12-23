<form class="user-login" action="user/login" method="post">
  <input type="text" name="username" placeholder="Username" />
  <input type="password" name="password" placeholder="password" />
  <input type="submit" value="login" />
</form>

<?php if(Registry::has('login_failed')): ?>
  <span class="error">Login failed</span>
<?php endif; ?>