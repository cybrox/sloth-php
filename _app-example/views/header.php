<html>
<head>
  <title>Imagesave</title>

  <?php Autoloader::load_vendor(); ?>
  <?php Autoloader::load_public(); ?>
</head>
<?php if(Session::has('user')): ?>
  <body data-token="<?php echo Session::get('user')->auth_token; ?>">
<?php else: ?>
  <body>
<?php endif; ?>

  <header>
    <div class="user-panel">
      <?php if(Session::has('user')): ?>
        <?php echo Session::get('user')->username; ?> &bull; 
        <a href="<?php echo Router::link("user/logout"); ?>"> Logout</a>
      <?php else: ?>
        <a href="<?php echo Router::link("/"); ?>"> Login</a>
      <?php endif; ?>
      </div>
    <h1 class="page-name">Imagesave</h1>
  </header>

  <section id="content">