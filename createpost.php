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

	$PICTUREURL = htmlspecialchars($_POST["pictureURL"]);
	$DESCRIPTION = htmlspecialchars($_POST["description"]);
	$TAG = htmlspecialchars($_POST["tag"]);


	$NUMLIKES = 0;
	$NUMDISLIKES = 0;
	$TODAY = date("Y-m-d");
	
	#use sessions and accounts to get later
	$USER = 1;

	if($PICTUREURL!="") {
		$sql = "INSERT INTO CryptidPhotos (uploadDate, pictureURL, numLikes, numDislikes, description) VALUES ('$TODAY', '$PICTUREURL', '$NUMLIKES', '$NUMDISLIKES', '$DESCRIPTION')";

		if($conn->query($sql) === TRUE) {
			echo "Success";
		} else {
			echo "Error:" . $sql . "<br>" . $conn->error;
		}
	}

	
	$TAGS = explode(",", $TAG);
	
	foreach($TAGS as $TOG) {
		
		$check = 0;

		$sql = "SELECT text FROM Tags";
		$result = $conn->query($sql);
			
		while($row = $result->fetch_assoc()){
			if($row["text"] === $TOG){
				$check = 1;
			}
		}

		if($check === 0){
			$sql = "INSERT INTO Tags (text) VALUES ('$TOG')";
			if($conn->query($sql) === TRUE){
				echo "Success";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		
	}

	$conn->close();
?>

<?php include 'header.html';?>
<?php include 'createpost.html';?>

</body>
</html>
