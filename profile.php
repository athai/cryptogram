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

  // CHANGE THIS LATER: Should grab id of user who is currently logged in
  $query = "SELECT username, profilePicture, favoriteCryptid, description
            FROM CryptogramUsers WHERE userID=5";
  $qpics = "SELECT COUNT(*), pictureURL, description FROM CryptidPhotos LIMIT 3";
  $qcomm = "SELECT text, postDate FROM Comments LIMIT 3";

	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}

	$pic_results = mysqli_query($conn, $qpics);
	if (!$pic_results) {
		die("Query to show fields from table failed");
	}

	$comm_results = mysqli_query($conn, $qcomm);
	if (!$comm_results) {
		die("Query to show fields from table failed");
	}

	$num_fields = mysqli_num_fields($result);
	//for($i=0; $i<$num_fields; $i++) {	
	//	$field = mysqli_fetch_field($result);	
	//	echo "<td><b>{$field->name}</b></td>";
	//}

  echo "<div class='container' style='margin-left:20px'>";
  echo "<div class='row'>";
  while($row = mysqli_fetch_row($result)) {	
    echo "<div class='card' style='width:30%; height:20%'>
            <img class='card-img-top img-fluid' src='$row[1]' style='width:100%; height:45%;'>
            <div class='card-block'>
              <p class='card-text'>
                <small class='text-muted'>Favorite Cryptid: $row[2]</small>
              </p>
              <p class='card-text'>$row[3]</p>
            </div>
          </div>";
  }

  //echo "<div class='card-group' style='padding-left:10px; width:70%'; height:20%;>";
  //while($row = mysqli_fetch_row($pic_results)) {	
  //  echo "<div class='card'>
  //          <img class='card-img-top' src='$row[1]' style='width:15%; height:%15'>
  //        </div>";
  //}
  ////  <div class='card'>
  ////    <img class='card-img-top' src='...' alt='card image cap'>
  ////  </div>
  ////  <div class='card'>
  ////    <img class='card-img-top' src='...' alt='card image cap'>
  ////  </div>
  ////  </div>";
  //echo "</div>";

  echo "<table class='table table-striped' style='padding-left:15px; width:70%'>
          <thead>
            <tr>
              <th>Photos</th>
            </tr>
          </thead>";
  echo "<tbody>";
  while($row = mysqli_fetch_row($pic_results)) {	
    echo "<tr>
            <td>$row[1]</td>
          </tr>";
  }
  echo "</tbody>";
  echo "</table>";

  // Try this?
<ul class="list-unstyled">
  <li class="media">
    <img class="d-flex mr-3" src="..." alt="Generic placeholder image">
    <div class="media-body">
      <h5 class="mt-0 mb-1">List-based media object</h5>
      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
    </div>
  </li>
  <li class="media my-4">
    <img class="d-flex mr-3" src="..." alt="Generic placeholder image">
    <div class="media-body">
      <h5 class="mt-0 mb-1">List-based media object</h5>
      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
    </div>
  </li>
  <li class="media">
    <img class="d-flex mr-3" src="..." alt="Generic placeholder image">
    <div class="media-body">
      <h5 class="mt-0 mb-1">List-based media object</h5>
      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
    </div>
  </li>
</ul>

  echo "</div>";  // closes row div
  echo "</div>";  // closes container div

  //echo "<div class='card-group'>";
  //while($row = mysqli_fetch_row($pic_results)) {	
  echo "<div class='container' style='align: center'>";
  echo "<table class='table table-striped'>
          <thead>
            <tr>
              <th>Recent Comments</th>
              <th>Date Posted</th>
            </tr>
          </thead>";
  echo "<tbody>";
  while($row = mysqli_fetch_row($comm_results)) {	
    echo "<tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
          </tr>";
  }
  echo "</tbody>";
  echo "</table>";
  echo "</div>";  // closes container div
  //echo "</div>";

// Use the following as a template to display a users top photos

    //<div class='card'>
    //  <img class='card-img-top' src='...' alt='card image cap'>
    //  <div class='card-block'>
    //    <h4 class='card-title'>card title</h4>
    //    <p class='card-text'>this is a wider card with supporting text below as a natural lead-in to additional content. this content is a little bit longer.</p>
    //    <p class='card-text'><small class='text-muted'>last updated 3 mins ago</small></p>
    //  </div>
    //</div>
    //<div class='card'>
    //  <img class='card-img-top' src='...' alt='card image cap'>
    //  <div class='card-block'>
    //    <h4 class='card-title'>card title</h4>
    //    <p class='card-text'>this card has supporting text below as a natural lead-in to additional content.</p>
    //    <p class='card-text'><small class='text-muted'>last updated 3 mins ago</small></p>
    //  </div>
    //</div>
    //<div class='card'>
    //  <img class='card-img-top' src='...' alt='card image cap'>
    //  <div class='card-block'>
    //    <h4 class='card-title'>card title</h4>
    //    <p class='card-text'>this is a wider card with supporting text below as a natural lead-in to additional content. this card has even longer content than the first to show that equal height action.</p>
    //    <p class='card-text'><small class='text-muted'>last updated 3 mins ago</small></p>
    //  </div>
    //</div>";

  //<div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
  //  <ol class='carousel-indicators'>
  //    <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
  //    <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
  //    <li data-target='#carouselExampleIndicators' data-slide-to='2'></li>
  //  </ol>
  //  <div class='carousel-inner' role='listbox'>
  //    <div class='carousel-item active'>
  //      <img class='d-block img-fluid' src='...' alt='First slide'>
  //    </div>
  //      <div class='carousel-item active'>
  //      <img class='d-block img-fluid' src='...' alt='2nd slide'>
  //    </div>
  //    <div class='carousel-item active'>
  //      <img class='d-block img-fluid' src='...' alt='3rd slide'>
  //    </div>
  //  </div>
  //  <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
  //    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
  //    <span class='sr-only'>Previous</span>
  //  </a>
  //  <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
  //    <span class='carousel-control-next-icon' aria-hidden='true'></span>
  //    <span class='sr-only'>Next</span>
  //  </a>
  //</div>

  mysqli_free_result($result);
  mysqli_free_result($results);
  mysqli_free_result($results);
	mysqli_close($conn);
	?>
</body>

</html>
