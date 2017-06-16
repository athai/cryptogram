<?php
include 'connectvarsEECS.php';
session_start();
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_errno) {
	die('could not connect: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$stmt = $conn->prepare("SELECT UserID FROM CryptogramUsers WHERE username=? AND password=?");

	if (isset($_POST['submit'])) {
		$username = $conn->real_escape_string($_POST['username']);
		$password = $conn->real_escape_string($_POST['password']);
		if ($stmt) {
			$stmt->bind_param("ss", $username, $password);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result->num_rows == 1) {
				$_SESSION['login_user'] = $username;
				header("location: welcome.php");  // change to actual home later
			}
			else {
				$error = "Your username or password is invalid.";
				echo $error;
			}
		}
	}
}
$conn->close();
include 'header.html';
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
