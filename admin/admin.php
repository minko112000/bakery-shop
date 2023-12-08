<?php
include('../server/connect.php');
ob_start();
session_start();
if (!isset($_SESSION['admin'])) {
  header('location: login.php');
}
?>

<!DOCTYPE html>
<html>
  <head>
  <meta name="keywords" content="MM-2D,2D 3D, 2D, 3D, Myanmar 2D 3D, Myanmar 2D, Myanmar 3D, 3D 2D, 2D Myanmar, Thai SET" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Dashboard</title>
    <script src="https://kit.fontawesome.com/c3ce1fe727.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
  </head>
  <body class="c">
    
    <?php
    if (isset($_POST['submit'])) {
      $upload_category = $_POST['upload-category'];
      $upload_price = $_POST['upload-price'];
      $upload_title = $_POST['upload-title'];
      $upload_description = $_POST['upload-description'];
      $upload_img = $_FILES['upload-img'];
      $exp = explode('/', $upload_img['type']);
      $ext = end($exp);
      $img_name = md5(time().$upload_img['name']).'.'.$ext;
      $path = '../images/';
      if (move_uploaded_file($upload_img['tmp_name'], $path.$img_name)) {
        $query = "INSERT INTO
        products (image, category, price, title, description)
        VALUES ('$img_name', '$upload_category', $upload_price, '$upload_title', '$upload_description')";
        $result = mysqli_query($con, $query);
        if ($result) {
          echo("<script>alert('Success')</script>");
        }
      }
      
    }
    ?>
    
    <div class="bg-light" id="container">
      <nav class="c tsh bg-primary px-3">
        <b class="pointer text-light">Dashboard</b>
        <div>
          <a class="text-light pointer dashboard-action me-2">Upload</a>
          <a class="text-light pointer dashboard-action me-2">Orders</a>
          <a class="text-light pointer dashboard-action">Users</a>
        </div>
      </nav>
      <main>
        <div id="Upload-page" class="page ovsc">
          <form action="admin.php" method="POST" id="form" class="product-upload-form pt-3" enctype="multipart/form-data">
            <h1 class="ttsh text-gold text-center pointer">Product upload</h1>
            <input name="upload-img" hidden class="product-file" type="file" accept="image/png, image/jpg, image/jpeg">
            <div class="c py-4">
              <div id="upload-img" class="shadow text-info pointer c tsh p-2">
                +
              </div>
            </div>
            <div class="d-flex pb-3 px-5">
              <small>Categories</small>
              <select name="upload-category" id="categories-value" class="bg-light mt-1 shadow px-1">
                <option value="promotion">Promotion</option>
                <option value="arrivals">Arrivals</option>
                <option value="popular">Popular</option>
                <option value="best">Best seller</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div class="d-flex pb-3 px-5">
              <small>Price</small>
              <input name="upload-price" class="shadow mt-1 px-1 bg-light" name="price" id="price-value" type="number">
            </div>
            <div class="d-flex pb-3 px-5">
              <small>Title</small>
              <input name="upload-title" class="shadow mt-1 bg-light px-1" name="title" id="title-value" type="text">
            </div>
            <div class="d-flex pb-3 des px-5">
              <small>Description</small>
              <textarea name="upload-description" id="des-value" class="shadow mt-1 bg-light p-2"></textarea>
            </div>
            <div class="px-5 pb-5">
              <button name="submit" class="mt-3 pointer bg-primary text-light tsh shadow-lg" type="button" id="upload-product">Upload</button>
            </div>
          </form>
        </div>
        <div id="Orders-page" class="page pt-1 d-none">
          <div class="c tb-row text-dark ttsh">
            <b class="c">Name</b>
            <b class="c">Phone</b>
            <b class="c">price</b>
            <b class="c">Action</b>
          </div>
          <div class="tb-wrapper text-dark ovsc ttsh"></div>
        </div>
        <div id="Users-page" class="page pt-1 d-none">
          <div class="c tb-row text-dark ttsh">
            <b class="c">No.</b>
            <b class="c">Name</b>
            <b class="c">Phone</b>
            <b class="c">Status</b>
          </div>
          <div id="users-container" class="tb-wrapper text-dark ovsc ttsh"></div>
        </div>
        <div id="details-page" class="page d-none bg-light position-absolute">
          <div class="bar text-light tsh c px-3 bg-primary">
            <i class="fa-solid event-page-hide tsh fa-arrow-left"></i>
            <b class="c position-relative">DETAILS</b>
          </div>
          <div class="ttsh text-dark px-4">
            <div class="c mt-2">
              <span class="p-2">Name</span><b class="p-2 name-div">@@@</b>
            </div>
            <div class="c mt-2">
              <span class="p-2">Phone</span><b class="p-2 phone-div">@@@</b>
            </div>
            <div class="c mt-2">
              <span class="p-2">Price</span><b class="p-2 price-div">@@@</b>
            </div>
            <div class="c mt-2">
              <span class="p-2">Products</span><b class="p-2 products-div">@@@</b>
            </div>
            <div class="c mt-2">
              <span class="p-2">Address</span><b class="p-2 address-div">@@@</b>
            </div>
          </div>
        </div>
      </main>
    </div>
    
    <script src="admin.js"></script>
  </body>
</html>