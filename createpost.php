<!DOCTYPE html>

<head>
  <title>Cryptogram</title>
</head>

<body>

<?php
	define('DB_HOST','classmysql.engr.oregonstate.edu');
	define('DB_USER','cs340_bowenjos');
	define('DB_PASSWORD','Z3nthB0rnOfL!ght');
	define('DB_NAME','cs340_bowenjos');

	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if($conn->connect_error){
		echo "Connection Failed";
	}

	$USERNAME = htmlspecialchars($_POST["username"]);
	$FIRSTNAME = htmlspecialchars($_POST["firstName"]);
	$LASTNAME = htmlspecialchars($_POST["lastName"]);
	$EMAIL = htmlspecialchars($_POST["email"]);
	$PASSWORD = htmlspecialchars($_POST["password"]);
	$AGE = htmlspecialchars($_POST["age"]);
	$check = 0;

	$sql = "SELECT username FROM Users";
	$result = $conn->query($sql);

	
	while($row = $result->fetch_assoc()){
		if($row["username"] == $USERNAME){
			echo "Username taken already";
			$check = 1;
		}
	}
	

	if($USERNAME!="" and $FIRSTNAME!="" and $LASTNAME!="" and $EMAIL!="" and $PASSWORD!="" and $check=="0") {
		$sql = "INSERT INTO Users (username, firstName, lastName, email, password, age) VALUES ('$USERNAME', '$FIRSTNAME', '$LASTNAME', '$EMAIL', '$PASSWORD', '$AGE')";

		if($conn->query($sql) === TRUE) {
			echo "Success";
		} else {
			echo "Error:" . $sql . "<br>" . $conn->error;
		}
	}

	$conn->close();
?>

<?php include 'header.html';?>
<?php include 'createpost.html';?>

<center>
	<form action="createpost.php" method="post">
		<fieldset>
			<legend>Create New Post</legend>
			Picture URL:<br>
			<input type="url" name="pictureURL" value=""><br>
			Description:<br>
			<input type="text" name="description" value=""><br>
			Tags (Comma Deliminated):<br>
			<input type="text" name="tag" value=""><br>
		
			<input type="submit" value="submit">
		</fieldset>
	</form>
</center>

</body>
</html>
