<?php
include('../server/connect.php');
ob_start();
session_start();

$orders = [];

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'del') {
      $id = $_GET['id'];
      $query = "INSERT INTO cart (username, product) VALUES ('$username', '$id')";
      $result = mysqli_query($con, $query);
      if ($result) {
        echo('ok');
      }
    } else if ($action == 'get') {
      $query = "SELECT * FROM orders ORDER BY id DESC";
      $result = mysqli_query($con, $query);
      if ($result) {
        while($row = mysqli_fetch_assoc($result)) {
          $orders[] = $row;
        }
      }
      echo(json_encode($orders));
    }
  }
}
?>