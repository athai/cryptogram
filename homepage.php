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

	$query = "SELECT pictureURL FROM CryptidPhotos";

	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	
	$num_fields = mysqli_num_fields($result);
	//for($i=0; $i<$num_fields; $i++) {	
	//	$field = mysqli_fetch_field($result);	
	//	echo "<td><b>{$field->name}</b></td>";
	//}

  //echo "<h1>List {$table}</h1>";
	//echo "<table border='1'><tr>";
	// printing table headers
	//for($i=0; $i<$fields_num; $i++) {	
	//	$field = mysqli_fetch_field($result);	
	//	echo "<td><b>{$field->name}</b></td>";
	//}

  while($row = mysqli_fetch_row($result)) {	
    echo "<div class='row'>
            <div class='col-md-6'>
              <div class='thumbnail'>";	
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable	
		foreach($row as $cell)		
      echo "<img src='$cell' style='width:50%; height:50'>";

    echo "    </div>
            </div>
          </div>";
	}

	mysqli_free_result($result);
	mysqli_close($conn);
	?>
</body>

</html>
