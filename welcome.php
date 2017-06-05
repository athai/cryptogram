<?php
  include 'session.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Temp Welcome page</title>
  </head>

  <body>
    <h1>welcome <?php echo $login_session; ?></h1>
    <h2><a href="logout.php">Sign Out</a></h2>
  </body>
</html>
