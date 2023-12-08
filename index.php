<?php
include('server/connect.php');
ob_start();
session_start();
if (!isset($_SESSION['username'])) {
  header('location: login.php');
}
?>

<!DOCTYPE html>
<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>𝓑𝓐𝓚𝓔𝓡𝓨 𝓢𝓗𝓞𝓟</title>
    <script src="https://kit.fontawesome.com/c3ce1fe727.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>
  <body class="c bg-white">
    
            <?php
              if (isset($_POST['buy-now'])) {
                $username = $_SESSION['username'];
                $products = $_POST['order-products'];
                $price = $_POST['order-price'];
                $name = $_POST['order-name'];
                $phone = $_POST['order-phone'];
                $address = $_POST['order-address'];
                $query = "INSERT INTO orders (username, name, phone, address, products, price)
                          VALUES ('$username', '$name', '$phone', '$address', '$products', '$price')";
                $result = mysqli_query($con, $query);
                if ($result) {
                  $query2 = "DELETE FROM cart WHERE username = '$username'";
                  $result2 = mysqli_query($con, $query2);
                  if ($result2) {
                    echo("<script>alert('Success')</script>");
                  }
                } else {
                  echo("<script>alert('Something wrong')</script>");
                }
              }
            ?>
    
    <div id="container" class="bg-light position-relative text-light">
      <nav class="c tsh bg-primary px-3">
        <b class="pointer">𝓑𝓐𝓚𝓔𝓡𝓨 𝓢𝓗𝓞𝓟</b>
        <div>
          <a class="text-light me-2" href="#contact-container">Contact</a>
          <a id="cart" class="text-light me-2">Cart</a>
        </div>
      </nav>
      <main>
        <div class="c mt-2 tsh banner">
          <div class="c left">
            <h3 class="text-gold text-danger">𝓑𝓐𝓚𝓔𝓡𝓨 𝓢𝓗𝓞𝓟</h3>
            <small class="text-success">The most popular product</small>
            <div class="mt-4">
              <button id="more-popular" class="pointer to-products shadow me-2 text-light ttsh px-2 bg-success">View</button>
            </div>
          </div>
        </div>
        <h3 class="ms-2 ttsh products-title position-relative text-primary mt-4">Promotion products</h3>
        <div id="promotion-banner" class="p-4 limit-sx d-flex products-box">
          
        </div>
        <h3 class="ms-2 ttsh products-title position-relative text-primary mt-4">Arrivals products</h3>
        <div id="arrivals-banner" class="p-4 limit-sx d-flex products-box"></div>
        <h3 class="ms-2 ttsh products-title position-relative text-primary mt-4">Popular products</h3>
        <div id="popular-banner" class="p-4 limit-sx d-flex products-box"></div>
        <h3 class="ms-2 ttsh products-title position-relative text-primary mt-4">Best seller products</h3>
        <div id="best-seller-banner" class="p-4 limit-sx d-flex products-box"></div>
        <h3 class="ms-2 ttsh products-title position-relative text-primary mt-4">Other products</h3>
        <div id="other-banner" class="p-4 limit-sx d-flex products-box"></div>
        <div id="products-page" class="page d-none bg-light position-absolute">
          <div class="bar tsh c px-3 bg-primary">
            <i class="fa-solid event-page-hide tsh fa-arrow-left"></i>
            <b class="c position-relative">Products</b>
          </div>
          <div class="wrapper px-2 d-flex ovsc"></div>
        </div>
        <div id="product-page" class="page d-none bg-light position-absolute">
          <div class="bar tsh c px-3 bg-primary">
            <i class="fa-solid event-page-hide tsh fa-arrow-left"></i>
            <b class="c position-relative">TITLE</b>
          </div>
          <div class="px-4">
            <img class="mt-2" src="images/b.jpg">
            <h3 class="mt-2 text-primary">Title</h3>
            <h2 class="mt-2 text-primary">500 Ks</h2>
            <span class="d-flex text-primary mt-2">minko.com.mm@gmail.comminkoko.r@gmail.com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minko112000</span>
          </div>
        </div>
        <div id="cart-page" class="page d-none bg-light position-absolute">
          <div class="bar tsh c px-3 bg-primary">
            <i class="fa-solid event-page-hide tsh fa-arrow-left"></i>
            <b class="c position-relative">CART</b>
          </div>
          <div class="c tb-row text-dark ttsh">
            <b class="c">product</b>
            <b class="c">Title</b>
            <b class="c">price</b>
          </div>
          <div class="wrapper px-2 d-flex ovsc"></div>
          <div id="order-bar" class="p-3 position-absolute text-dark ttsh">
            <div class="bg-primary p-3 shadow rounded text-white c">
              <span>Total price <b>0 Ks</b></span>
              <b id="add-address" class="p-1 pointer shadow bg-success text-white ttsh rounded px-2">Buy now</b>
            </div>
          </div>
        </div>
        <div id="add-address-page" class="page d-none bg-light position-absolute">
          <div class="bar tsh c px-3 bg-primary">
            <i class="fa-solid event-page-hide tsh fa-arrow-left"></i>
            <b class="c position-relative">ORDER</b>
          </div>
          <form action="index.php" method="POST" id="order-form" class="c text-dark px-4">
            <input name="order-products" hidden id="order-products">
            <input name="order-price" hidden id="order-price">
            <input name="order-name" id="order-name" class="ttsh shadow rounded mt-3 p-2" type="text" placeholder="Name">
            <input name="order-phone" id="order-phone" class="ttsh shadow rounded mt-3 p-2" type="number" placeholder="Phone">
            <textarea name="order-address" id="order-address" class="ttsh shadow rounded mt-3 p-2" placeholder="Address"></textarea>
            <button name="buy-now" id="buy-now" type="button" class="pointer bg-primary text-light ttsh shadow rounded c mt-3 p-2">Order</button>
          </form>
        </div>
        <div id="contact-container" class="mt-5 px-3 bg-dark">
          <div class="c">
            <h3 class="products-title my-4 position-relative tsh">Contact us</h3>
          </div>
          <div class="mt-2 c" id="follow-me-container">
            <div class="div1"></div>
            <div class="div2"></div>
            <a href="@" class="social-box c text-white tsh">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="@" class="social-box c text-white tsh">
              <i class="fa-brands fa-linkedin-in"></i>
            </a>
            <a href="@" class="social-box c text-white tsh">
              <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="@" class="social-box c text-white tsh">
              <i class="fa-brands fa-instagram"></i>
            </a>
          </div>
          <div class="p-4 c mt-5">
            &copy;&nbsp;Copy Right 2023
          </div>
        </div>
      </main>
    </div>
    
    <script src="js/script.js"></script>
  </body>
</html>