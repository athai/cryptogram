﻿<!DOCTYPE html>
<!-- homepage.php -->
<html>
	<head>
		<title>Cryptogram</title>
	</head>
<body>

<?php include 'header2.html';?>

<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
    }

	$query = "SELECT pictureURL, description, uploadDate FROM CryptidPhotos";

	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	
	$num_fields = mysqli_num_fields($result);
	//for($i=0; $i<$num_fields; $i++) {	
	//	$field = mysqli_fetch_field($result);	
	//	echo "<td><b>{$field->name}</b></td>";
	//}

  echo "<div class='card-columns'>";
  while($row = mysqli_fetch_row($result)) {	
    echo "<div class='card'>
            <img class='card-img-top img-fluid' src='$row[0]' style='width:100%; height:45%;'>
            <div class='card-block'>
              <p class='card-text'>$row[1]</p>
              <p class='card-text'>
                <small class='text-muted'>Uploaded $row[2]</small>
              </p>
            </div>
          </div>";
  }
  echo "</div>";

	mysqli_free_result($result);
	mysqli_close($conn);
	?>
</body>

</html>
