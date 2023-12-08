<?php
include('connect.php');
ob_start();
session_start();
if (!isset($_SESSION['username'])) {
  header('location: login.php');
} else {
  $products = [];
  $query = "SELECT * FROM products ORDER BY id DESC";
  $result = mysqli_query($con, $query);
  if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
      $products[] = $row;
    }
  }
  echo(json_encode($products));
}
?>
