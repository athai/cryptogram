<!DOCTYPE html>

<head>
  <title>Cryptogram</title>
</head>

<body>

<?php
	include 'connectvarsEECS.php';
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if($conn->connect_error){
		echo "Connection Failed";
	}

	$PICTUREURL = htmlspecialchars($_POST["pictureURL"]);
	$DESCRIPTION = htmlspecialchars($_POST["description"]);
	$TAG = htmlspecialchars($_POST["tag"]);

	$NUMLIKES = 0;
	$NUMDISLIKES = 0;
	$TODAY = date("Y-m-d");
	
	#use sessions and accounts to get later
	$userid = 1;

	if($PICTUREURL!="") {
		$sql = "INSERT INTO CryptidPhotos (uploadDate, pictureURL, numLikes, numDislikes, description) VALUES ('$TODAY', '$PICTUREURL', '$NUMLIKES', '$NUMDISLIKES', '$DESCRIPTION')";

		if($conn->query($sql) === TRUE) {
			$picid = $conn->insert_id;	
			$sql = "INSERT INTO Uploaded (pictureID, UserID) VALUES ('$picid', '$userid')";
			$result = $conn->query($sql);
		} else {
			echo "Error:" . $sql . "<br>" . $conn->error . "<br>";
		}
	}

	$TAG = str_replace(' ','',$TAG);	
	$TAGS = explode(",", $TAG);
	
	foreach($TAGS as $TOG) {
		
		$check = 0;

		$sql = "SELECT * FROM Tags";
		$result = $conn->query($sql);
			
		while($row = $result->fetch_assoc()){
			if($row["text"] === $TOG){
				$check = 1;
				$tagid = $row["TagID"];
				$sql = "INSERT INTO Tagged (TagID, pictureID) VALUES ('$tagid', '$picid')";
				if($conn->query($sql) === TRUE){
					echo "Sucess";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
			}
		}

		if($check === 0){
			$sql = "INSERT INTO Tags (text) VALUES ('$TOG')";
			if($conn->query($sql) === TRUE){
				$tagid = $conn->insert_id;
				$sql = "INSERT INTO Tagged (TagID, pictureID) VALUES ('$tagid', '$picid')";
				$conn->query($sql);
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
			}
		}

		$sql = "SELECT * FROM CryptogramUsers";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()){
			if($row["username"] === $TOG){
				$userid = $row["UserID"];
				$sql = "SELECT * FROM Cryptids";
				$resulttwo = $conn->query($sql);
				while($rowtwo = $resulttwo->fetch_assoc()){
					if($rowtwo["userID"] === $userid){
						$cryptidid = $rowtwo["cryptidID"];
						$sql = "INSERT INTO Pictured (pictureID, cryptidID) VALUES ('$picid', '$cryptidid')";
						if($conn->query($sql) === FALSE){
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
						}
					}
				}
			}
		}

		
	}

	$conn->close();
?>

<?php include 'header.html';?>
<?php include 'createpost.html';?>

</body>
</html>
