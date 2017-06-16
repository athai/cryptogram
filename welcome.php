<?php
include 'header.html';
include 'session.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Temp Welcome page</title>
  </head>

  <body>
    <?php if(!empty($login_session)) : ?>
    <h1>welcome <?php echo $login_session; ?></h1>
	<h2><a href="logout.php">Sign Out</a></h2>
	<?php else : ?>
	<h1>welcome anon</h1>
	<h2><a href="login.php">Log in</a></h2>
	<?php endif; ?>
  </body>
</html>
