<?php
include 'session.php';
include 'header.html';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	include 'connectvarsEECS.php';
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if ($conn->connect_errno) {
		die('could not connect: ' . $conn->connect_error);
		exit();
	}
	// prepared statement: select the old password from the users table where
	// the user is the one currently logged in, and the pw is the "old pw" that
	// they provided.
	$pw_stmt = $conn->prepare("SELECT password FROM CryptogramUsers WHERE username=? AND password=?");
	if (isset($_POST['submit'])) {
		// init vars: error var and the user data from each form field
		$error = "";
		$username = $conn->real_escape_string($_POST['username']);
		$email = $conn->real_escape_string($_POST['email']);
		$old_password = $conn->real_escape_string($_POST['old_password']);
		$new_password = $conn->real_escape_string($_POST['new_password']);
		$profile_pic = $conn->real_escape_string($_POST['profile_pic']);
		$fav_cryptid = $conn->real_escape_string($_POST['fav_cryptid']);
		$description = $conn->real_escape_string($_POST['description']);

		// check user's old pw is correct if provided, and that if they did
		// provide an old pw, that they also inc. a new password
		if (!empty($old_password) || !empty($new_password)) {
			$pw_stmt->bind_param("ss", $login_session, $old_password);
			$pw_stmt->execute();
			$result = $pw_stmt->get_result();
			// if a single row returned, confirmed that their old password is
			// what they entered...
			if ($result->num_rows == 1) {
				if (empty($new_password)) {
					$error="To change your password, you must provide both your old and new passwords.";
				}
			}
			else {
				$error="Your old password is incorrect.";
			}
		}
		if ($error != "") {
			echo $error;
		}
		else {
			$update_str = "UPDATE CryptogramUsers SET ";
			$fields = array(
				"username"=>$username, "email"=>$email,
				"password"=>$new_password, "profilePicture"=>$profile_pic,
				"favoriteCryptid"=>$fav_cryptid, "description"=>$description);
			foreach($fields as $field=>$value) {
				if(!empty($value)) {
					$update_str .= $field . "=" . "'" . $value . "'" . ", ";
				}
			}
			$update_str = substr($update_str, 0, -2);
			$update_str .= " WHERE UserID=" . $login_id;
			if ($conn->query($update_str) === TRUE) {
				echo "Changes saved!";
			}
			else {
				echo "There was an error in your update attempt: " . $conn->error;
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
	<title>Edit your account</title>
  </head>

  <body>
	<?php if(!empty($login_session)) : ?>
	<h1>Edit your account</h1>
	<p>Leave fields you wish to remain unchanged blank.</p>
	<form action="" id="edit_acct_form" method="POST">
	  Username: <input type="text" name="username"><br>
	  Email: <input type="email" name="email"><br>
	  Old password: <input type="password" name="old_password"><br>
	  New password: <input type="password" name="new_password"><br>
	  Profile picture url: <input type="text" name="profile_pic"><br>
	  Favorite cryptid: <input type="text" name="fav_cryptid"><br>
	  <textarea name="description" placeholder="Say a little about yourself..."></textarea>
	  <input type="submit" name="submit" value="SAVE CHANGES">
	</form>

	<?php else : ?>
	<p>Please log in first.</p>
	<?php endif; ?>
  </body>
</html>
