<!DOCTYPE html>
<!-- homeview.php -->
<html>
  <head>
    <title>Cryptogram</title>
  </head>
<body>

<?php include 'header.html';?>

<!-- recent photos: gallery -->
<?php
  include 'connectvarsEECS.php';

  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$conn){
    die('Could not connect: ' . mysql_error());
  }
  $query = "SELECT pictureURL FROM CryptidPhotos";
  $result = mysqli_query($conn, $query);
  if (!$result){
    die("Query failed");
  }
  $num_fields = mysqli_num_fields($result);

  for ($i=0; $i<$num_fields; $i++){
    $link = mysqli_fetch_field($result);
    echo "<div class='row'>
            <div class='col-md-6'>
              <div class='thumbnail'>
                <a href='#'>
                  <img src='$link'>
                </a>
              </div>
            </div>
          </div>";
  }

  mysqli_free_result($result);
  mysqli_close($conn);
?>

</body>
</html>
