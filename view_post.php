<?php include("header.html");?>

<?php
	if(isset($_GET["pictureID"])){
		$pid = $_GET["pictureID"];
		//echo "$pid";

	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","garciaa4-db","8d2WRQFY7n38l19e","garciaa4-db");
	if($mysqli_connect_errno()){
		echo "failed to connect to MySQL".mysqli_connect_error($mysqli);
	}

	$sql = "SELECT pictureURL, numLikes, numDislikes, FROM CryptidPhotos WHERE pictureID = $pid";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc()
		echo "id: " . $pid. " URL: " . $row["pictureURL"]. " likes: " . $row["numLikes"]. " Dislikes: " . $row["numDislikes"]. "<br>";
	}
	

$mysqli->close();
?>
