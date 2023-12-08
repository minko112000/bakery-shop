<?php
include('../server/connect.php');
ob_start();
session_start();
if (!isset($_SESSION['admin'])) {
  header('location: login.php');
} else {
  $users = [];
  $query = "SELECT * FROM users ORDER BY id DESC";
  $result = mysqli_query($con, $query);
  if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
      $users[] = $row;
    }
  }
  echo(json_encode($users));
}
?>
