<?php
include 'connectvarsEECS.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

session_start();

$user_check = $_SESSION['login_user'];
$ses_sql = $conn->query("SELECT username FROM CryptogramUsers WHERE username='$user_check'");

$row = $ses_sql->fetch_array(MYSQLI_ASSOC);

$login_session = $row['username'];

$conn->close();
?>
