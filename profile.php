<!DOCTYPE html>
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

  $query = "SELECT username, profilePicture, favoriteCryptid, description
            FROM CryptogramUsers";

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
              <p class='card-text'>
                <small class='text-muted'>Uploaded $row[2]</small>
              </p>
              <p class='card-text'>$row[1]</p>
              <button type='button' class='btn btn-outline-primary' data-toggle='button' aria-pressed='false' autocomplete='off'>
                $row[3] BELIEVE
              </button>
            </div>
          </div>";
  }
  echo "</div>";

// Use the following as a template to display a users top photos

//<div class="card-group">
//  <div class="card">
//    <img class="card-img-top" src="..." alt="Card image cap">
//    <div class="card-block">
//      <h4 class="card-title">Card title</h4>
//      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
//      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
//    </div>
//  </div>
//  <div class="card">
//    <img class="card-img-top" src="..." alt="Card image cap">
//    <div class="card-block">
//      <h4 class="card-title">Card title</h4>
//      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
//      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
//    </div>
//  </div>
//  <div class="card">
//    <img class="card-img-top" src="..." alt="Card image cap">
//    <div class="card-block">
//      <h4 class="card-title">Card title</h4>
//      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
//      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
//    </div>
//  </div>
//</div>

	mysqli_free_result($result);
	mysqli_close($conn);
	?>
</body>

</html>
