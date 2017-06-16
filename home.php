<!DOCTYPE html>
<!-- homepage.php -->

<?php
include 'session.php';
include 'header.html';
include 'connectvarsEECS.php'; 

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}

$query = "SELECT pictureURL, description, uploadDate, numLikes, numDislikes
	FROM CryptidPhotos";

$result = mysqli_query($conn, $query);
if (!$result) {
	die("Query to show fields from table failed");
}

$num_fields = mysqli_num_fields($result);

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
		<button type='button' class='btn btn-outline-danger' data-toggle='button' aria-pressed='false' autocomplete='off'>
		$row[4] DEBUNK
		</button>
		</div>
		</div>";
}
echo "</div>";

mysqli_free_result($result);
mysqli_close($conn);
?>
