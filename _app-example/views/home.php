<form class="user-login" action="<?php echo SUBDIR; ?>/user/login" method="post">
  <input type="text" name="username" placeholder="Username" />
  <input type="password" name="password" placeholder="Password" />
  <input type="submit" value="Login" />
</form>

<?php if(Registry::has('login_failed')): ?>
  <span class="error">Login failed!</span>
<?php endif; ?>

<?php if(Registry::has('login_needed')): ?>
  <span class="error">Not logged in!</span>
<?php endif; ?>