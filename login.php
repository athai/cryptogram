<?php
  include 'connectvarsEECS.php';
  session_start();
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$conn) {
    die('could not connect: ' . mysqli_error());
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $conn -> prepare("SELECT UserID FROM CryptogramUsers WHERE username=? AND password=?");

    if (isset($_POST['submit'])) {
  	  $username = mysqli_real_escape_string($conn, $_POST['username']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      if ($stmt) {
        $stmt -> bind_param("ss", $username, $password);
        $stmt -> execute();
    	$result = $stmt -> get_result();
    	if ($result -> num_rows == 1) {
          session_register("username");
    	  $_SESSION['login_user'] = $username;
    	  header("location: welcome.php");
    	}
    	else {
          $error = "Your username or password is invalid.";
          echo $error;
    	}
      }
    }
  }
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
  <head>
	<title>Log in</title>
  </head>

  <body>
    <h1>Log in</h1>
    
    <form action="" method="POST">
      Username: <input type="text" name="username" required><br>
      Password: <input type="password" name="password" required><br>
      <input type="submit" name="submit" value="SUBMIT">
	</form>

   </body>
</html>   
