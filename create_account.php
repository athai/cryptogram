<!DOCTYPE html>
<!-- create_account.php -->
<html>
  <head>
	<title>Create an Account</title>
  </head>

  <body>

	<?php include 'header.html';?>

	<h1>Create an Account</h1>

	<form action="create_account.php" method="POST">
	  Username: <input type="text" name="username" required><br>
	  Email: <input type="email" name="email" required><br>
	  Password: <input type="password" name="password" required><br>
	  Repeat password: <input type="password" name="pw_repeat" required><br>
	  <input type="submit" name="submit" value="SUBMIT">
	</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	include 'connectvarsEECS.php';
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if ($conn->connect_errno) {
		die('could not connect: ' . $conn->connect_error);
		exit();
	}
	$stmt = $conn->prepare("INSERT INTO CryptogramUsers (username, email, password) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $username, $email, $password);

	if (isset($_POST['submit'])) {
		$error = false;
		$username = $_POST['username'];
		$sql = "SELECT username FROM CryptogramUsers";
		if ($result = $conn->query($sql)) {
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					if ($row["username"] == $username) {
						$error = true;
						echo "That username is already taken. ";
					}
				}
			}
		}
		if (!preg_match("/^[A-Za-z][A-Za-z0-9]{2,14}$/", $username)) {
			$error = true;
			echo "Username must be between 3 and 15 characters, and can only contain letters and numbers. ";
		}
		$email = $_POST['email'];
		$password = $_POST['password'];
		$pw_repeat = $_POST['pw_repeat'];
		if (strlen($password) < 8 || strlen($password) > 15) {
			$error = true;
			echo "Password must be between 8 and 15 characters. ";
		}
		if ($password != $pw_repeat) {
			$error = true;
			echo "Passwords don't match. ";
		}
		if ($error) {
			echo "Please redo your form. ";
		}
		else {
			$stmt->execute();
			if ($stmt) {
				echo "Your account was created! ";
			}
			else {
				echo "Something went wrong. :/ ";
			}
		}
	}
	$conn->close();
}
?>
  </body>
</html>
