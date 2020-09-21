<?php
  session_start();
  $connect = mysqli_connect("localhost","root","","mtk");

  if(isset($_SESSION['log_in']))
  {
    $log_in_username = $_SESSION['log_in'];
  }

  if(isset($_REQUEST['shop_again']))
  {
    header("location: product_detail.php");
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    <link href="./css/alert_confirm.css" type="text/css" rel="stylesheet"/>
    <style type="text/css">
      .shop-more
      {
        padding-top: 50px;
      }
    </style>
    <link rel="shortcut icon" href="./image/furniture_icon.ico" type="image/x-icon"/>
  </head>
  <body>
    <!-- Header Start -->
      <div class="header" style="width:auto; height:auto; background:none;padding-bottom: 50px;">
        <div class="nav-bar">
          <span class="logo_text"> MTK<small style="font-size: 20px;"> furniture </small> </span>
          <span class="nav_text"><a href="#"> Home </a></span>
          <span class="nav_text">
            <a href="product_detail.php"> Shop </a></span>

          <!--
            <span class="dropdown-content">
              <div class="content-list">
                <a href="product_detail.php">Products</a>
              </div>
              <div class="content-list">
                <a href="#">Link 2</a>
              </div>
              <div class="content-list">
                <a href="#">Link 3</a>
              </div>
            </span>
          -->
          </span>
          <span class="nav_text"><a href="#"> Contact </a></span>
          <span class="nav_text"><a href="#">Support </a></span>
          <?php
            if(isset($_SESSION['log_in']))
            {
              ?>
                <span class="nav_text">
                  <a href="checkout.php"> Cart </a>
                </span>
                </span>
                <span class="nav_text">
                  <a href="logout.php"> Log Out </a>
                </span>
                <span class="nav_text">
                  <a href="index.php"><?php echo $log_in_username; ?></a>
                </span>
              <?php
            }
            else
            {
              ?>
              <span class="nav_text">
                <a href="login.php"> Log In </a>
              </span>
              <span class="nav_text">
                <a href="register.php"> Register </a>
              </span>
              <span class="nav_text">
                <a href="index.php"><?php echo $log_in_username; ?></a>
              </span>
              <?php
            }
          ?>
        </div>
      <div style="clear:both;"></div>
    </div>
    <!-- Header End -->

    <!-- Content Start -->
      <div class="alert_content_box">
        <span class="text"> Thanks For Shopping with us. We'll contact you in 24 hours for confirmation.</span>
        <div class="shop-more" name="shop_again">
          <a href="product_detail.php"> Shop Again </a>
        </div>
      </div>
    <!-- Content End -->

    <!-- Footer Start -->
      <div class="footer">
        <div>
          <div class="footer1 footer-content">
            <h1 style="font-size: 50px;"> Don't miss out </h1>
            <p> Sign up for the latest news, product and coupons </p>
            <table class="email_birth">
              <tr>
                <td> Email Address </td>
                <td> Birthday </td>
              </tr>
              <tr>
                <td><input type="text" class="email" name="email" placeholder="Enter Your Email Address"/></td>
                <td><input type="date" class="email" name="date_of_birth"/></td>
              </tr>
              <tr>
                <td><input type="submit" name="btn_submit" value="Sign Up"/></td>
              </tr>
            </table><br/>
            <img src="./image/facebook.png"/>
            <img src="./image/instagram.png"/>
            <img src="./image/linkedin.png"/>
            <img src="./image/twitter.png"/>
            <img src="./image/whatsapp.png"/>
          </div>
          <div class="footer2 footer-content">
            <h3> COMPANY </h3>
            <p> About </p>
            <p> Products </p>
          </div>
          <div class="footer3 footer-content">
            <h3> FEATURES </h3>
            <p> Offers </p>
            <p> Coupons </p>
          </div>
          <div class="footer4 footer-content">
            <h3> CUSTOMER SERVICES </h3>
            <p> Contact Us </p>
            <p> My Account </p>
            <span class="google_map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d488797.7901925697!2d95.90136575822115!3d16.839609803900338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1949e223e196b%3A0x56fbd271f8080bb4!2sYangon!5e0!3m2!1sen!2smm!4v1594034647164!5m2!1sen!2smm" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></span>
          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="copyright">
          <div>
            <span class="privacy"> Privacy </span>
            <span class="terms"> Terms and Conditions </span>
            <span class="copyright-text"> &copyCopyright by MTK Furniture </span>
          </div>
        </div>
      </div>
    <!-- Footer End -->
  </body>
</html>
