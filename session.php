<?php
  include 'connectvarsEECS.php';
  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  session_start();
  
  $user_check = $_SESSION['login_user'];
  $ses_sql = mysqli_query($conn, "SELECT username FROM CryptogramUsers WHERE username='$user_check'");

  $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

  $login_session = $row['username'];

  if(!isset($SESSION['login_user'])) {
    header("location: login.php");
  }

  mysqli_close($conn);
?>
