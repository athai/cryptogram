<!DOCTYPE html>
<!-- homepage.php -->
<html>
	<head>
		<title>Cryptogram</title>
	</head>
<body>

<?php include 'header.html';?>

<?php
// change the value of $dbuser and $dbpass to your username and password
	include 'connectvarsEECS.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
    }

	$query = "SELECT pictureURL, description FROM CryptidPhotos";

	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	
	$num_fields = mysqli_num_fields($result);
	//for($i=0; $i<$num_fields; $i++) {	
	//	$field = mysqli_fetch_field($result);	
	//	echo "<td><b>{$field->name}</b></td>";
	//}

  echo "<div class='container'>
          <div class='row'>";
  while($row = mysqli_fetch_row($result)) {	
    echo "  <div class='col-md-4'>
              <div class='thumbnail'>	
                <img src='$row[0]' style='width:35%; height:35%'>
                <div class='caption text-center'>
                  <p>$row[1]</p>
                </div>
              </div>
            </div>";
  }
  echo "  </div>
        </div>";

	mysqli_free_result($result);
	mysqli_close($conn);
	?>
</body>

</html>
