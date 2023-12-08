<?php
include('connect.php');
ob_start();
session_start();

$cart = [];

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'add') {
      $id = $_GET['id'];
      $query = "INSERT INTO cart (username, product) VALUES ('$username', '$id')";
      $result = mysqli_query($con, $query);
      if ($result) {
        echo('ok');
      }
    } else if ($action == 'get') {
      $query = "SELECT * FROM cart
      LEFT JOIN products
      ON cart.product = products.id
      ORDER BY cart.id DESC";
      $result = mysqli_query($con, $query);
      if ($result) {
        while($row = mysqli_fetch_assoc($result)) {
          $cart[] = $row;
        }
      }
      echo(json_encode($cart));
    }
  }
}
?>