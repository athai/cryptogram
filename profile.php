<!DOCTYPE html>
<!-- homepage.php -->
<?php
include 'session.php';
include 'header.html';
// change the value of $dbuser and $dbpass to your username and password
include 'connectvarsEECS.php'; 

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}

// CHANGE THIS LATER: Should grab id of user who is currently logged in
$query = "SELECT username, profilePicture, favoriteCryptid, description
	FROM CryptogramUsers WHERE UserID='$login_id'";
$qpics = "SELECT COUNT(*), pictureURL, description FROM CryptidPhotos LIMIT 5";
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

echo "<table class='table table-responsive' style='padding-left:15px; width:70%'>
	<thead>
	<tr>
	<th>Photos</th>
	</tr>
	</thead>";
echo "<tbody>";
while($row = mysqli_fetch_row($pic_results)) {	
	echo "<tr>
		<td valing='middle'><img src='$row[1]' style='width:64px; height:64px'></td>
		<td valign='middle'>$row[1]</td>
		</tr>";
}
echo "</tbody>";
echo "</table>";

echo "</div>";  // closes row div
echo "</div>";  // closes container div

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

mysqli_free_result($result);
mysqli_free_result($results);
mysqli_free_result($results);
mysqli_close($conn);
?>
</body>

</html>
