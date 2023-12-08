<?php
include('server/connect.php');
ob_start();
session_start();
if (isset($_SESSION['username'])) {
  header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Login</title>
    <script src="https://kit.fontawesome.com/c3ce1fe727.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body class="c">
    
    <?php
    if (isset($_POST['submit'])) {
      $phone = $_POST['phone'];
      $password = md5($_POST['password']);
      $query = "SELECT * FROM users WHERE phone = '$phone' && password = '$password'";
      $result = mysqli_query($con, $query);
      if ($result) {
        if (mysqli_num_rows($result) == 1) {
          $row = mysqli_fetch_array($result);
          $_SESSION['username'] = $row['username'];
          header('location: index.php');
        } else {
          echo("<script>alert('Invalid phone or password')</script>");
        }
      }
    }
    ?>
    
    <div class="bg-light" id="container">
      <nav class="c tsh bg-primary px-3">
        <b class="pointer text-light">𝓑𝓐𝓚𝓔𝓡𝓨 𝓢𝓗𝓞𝓟</b>
        <div>
          <a class="text-light" href="signup.php">Signup</a>
        </div>
      </nav>
      <div class="form-container c">
        <form action="login.php" method="POST" id="form" class="px-5 pt-3">
          <h1 class="ttsh text-gold text-center pointer">𝓑𝓐𝓚𝓔𝓡𝓨 𝓢𝓗𝓞𝓟</h1>
          <div class="d-flex mt-3 shadow">
            <label class="bg-light">Phone</label>
            <i class="fa-solid fa-phone bg-primary text-light ttsh c"></i>
            <input name="phone" id="phone" type="number">
          </div>
          <div class="d-flex mt-4 shadow">
            <label class="bg-light">Password</label>
            <i class="fa-solid fa-key bg-primary text-light ttsh c"></i>
            <input name="password" id="password" type="password">
            <i class="eye fa-solid text-info c ttsh fa-eye"></i>
          </div>
          <button name="submit" class="mt-4 pointer bg-primary text-light login tsh shadow-lg" type="button" id="submit">Login</button>
          <span class="c ttsh mt-4">
            <small class="text-danger">No account yet!&nbsp;<a class="text-primary pointer" href="signup.php">Signup</a></small>
          </span>
        </form>
      </div>
    </div>
    
    <script src="js/reg.js"></script>
  </body>
</html>