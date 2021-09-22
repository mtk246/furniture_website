<?php
  session_start();
  include "dbcontrol.php";

  $db_control = new DBController();

  if(isset($_SESSION['log_in']))
  {
    $log_in_username = $_SESSION['log_in'];
  }
  else
  {
    $log_in_username = "Guest";
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> MTK Furniture</title>
    <link rel="stylesheet" href="./css/main.css" type="text/css"/>
    <link rel="stylesheet" href="./css/purchase.css" type="text/css"/>
    <link rel="stylesheet" href="./css/preloader.css" type="text/css"/>
    <link rel="shortcut icon" href="./image/furniture_icon.ico" type="image/x-icon"/>

    <style type="text/css">
      div.content .image
      {
        float: left;
        width:300px;
        height:350px;
        padding:20px 0;
        margin-left:100px;
        margin-bottom:50px;
        background-color:#F5F5F5;
        text-align: center;
        text-transform: uppercase;
        border-radius: 20px;
        font-size: 20px;
        line-height: 30px;
      }
      div.content .image img
      {
        width:75%;
        transition: transform .2s;
        padding-bottom: 30px;
      }
      div.content .image:hover img
      {
        transform: scale(1.3);
      }
      div.content .shop-more
      {
        padding-top:20px;
      }
      div.content .shop-more a
      {
        text-decoration:none;
        color:white;
        background-color:#ffc700;
        padding:20px 30px;
        border-radius:10px;
      }
      div.content .shop-more:hover a
      {
        color:#ffc700;
        background-color:white;
      }
    </style>
    <link href="./css/register.css" type="text/css" rel="stylesheet"/>
  </head>
  <body>
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <span id="preloader">
        <span id="status">&nbsp;</span>
      </span>
    -->
    <!-- Header Start -->
      <div class="header" style="width:auto;">
        <div class="nav-bar">
          <span class="logo_text" style="padding-right:150px;"> MTK<small style="font-size: 20px;"> furniture </small> </span>
          <span class="nav_text"><a href="index.php"> Home </a></span>
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
          <span class="nav_text dropdown">
            <span class="dropdown-btn"><a href="#"> Contact </a></span>
            <span class="dropdown-content">
              <div class="content-list">
                <a href="./feedback.php"> Feedback </a>
              </div>
            </span>
          </span>
          <span class="nav_text"><a href="#">Support </a></span>
      <!--
          <span class="nav_text dropdown">
            <span class="dropdown-btn"><a href="#"> Management </a></span>
            <span class="dropdown-content">
              <div class="content-list">
                <a href="./supplier.php"> Supplier </a>
              </div>
              <div class="content-list">
                <a href="./delivery_agent.php"> Delivery Agent </a>
              </div>
              <div class="content-list">
                <a href="./furniture_type.php"> Furniture type </a>
              </div>
            </span>
          </span>
      -->
            <?php
              if(isset($_SESSION['log_in']))
              {
                  ?>
                  <span class="nav_text">
                    <a href="checkout.php"> Cart </a>
                  </span>
                  <span class="nav_text">
                    <a href="logout.php"> Log Out </a>
                  </span>
                  <span class="nav_text dropdown">
                    <span class="dropdown-btn"><a href="#"><?php echo $_SESSION['log_in']; ?> </a></span>
                    <span class="dropdown-content" style="width: auto;">
                      <div class="content-list" style="width: 200px;text-align:center;">
                        <a href="./user_account_setting.php"> Account Setting </a>
                      </div>
                    </span>
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
                <span class="nav_text dropdown">
                  <span class="dropdown-btn"><a href="index.php"><?php echo $log_in_username; ?></a></span>
                </span>
                <?php
              }
            ?>
          <div class="intro_text">
            <label  class="intro_text_1"> Furniture By MTK </label><br/>
            <label class="intro_text_2"> For Your Home Needs </label><br/>
            <label class="intro_text_3"><a href="#"> Discover More </a></label>
          </div>
        </div>
        <div style="clear:both;"></div>
      </div>
    <!-- Header End -->

    <!-- Content Start -->
    <div class="content">
        <!--
        <div class="content-wrapper">
          <span class="text">
            <span class="text1"> #LivingRoom </span><br/>
            <span class="text2"> Sofas </span><br/>
            <span class="text3"><a href="#"> Shop More </a></span>
          </span>
          <div class="image-content">
            <div class="img"><img src="./image/sofa.png"/></div>
          </div>
        </div>
        <div class="content-wrapper">
          <span class="text">
            <span class="text1"> #BedRoom </span><br/>
            <span class="text2"> Beds </span><br/>
            <span class="text3"><a href="#"> Shop More </a></span>
          </span>
          <div class="image-content">
            <div class="img"><img src="./image/bed.png"/></div>
          </div>
        </div>
        <div style="clear:both;"></div>
        <br/><br/>
        <hr class="line1"/>
        <div class="popular-items">
            <span class="text">
              <span class="text1"> Popular items of the week </span>
            </span>
        </div>
        <div class="content-wrapper-by-3">
          <span class="content-wrapper-image">
            <span class="content-image"><img src="./image/cupboard.png"/></span>

        //comment this session
        <div class="faded-text">
              <div class="title"><input type="submit" name="btn_addtocart" value="Add to Cart"/></div>
            </div>
        //
            <span class="label"> Cupboard </span><br/>
            <span class="label" style="font-size: 20px;color:#7c7c7c;"><small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$100 </small></span>
          </span>
          <span class="content-wrapper-image">
            <span class="content-image"><img src="./image/sink.png"/></span>

            //comment this session
            <div class="faded-text">
              <div class="title"><input type="submit" name="btn_addtocart" value="Add to Cart"/></div>
            </div>
        //
            <span class="label"> &nbsp;&nbsp;Sink </span><br/>
            <span class="label" style="font-size: 20px;color:#7c7c7c;"><small> &nbsp;&nbsp;&nbsp;&nbsp;$100 </small></span>
          </span>
          <span class="content-wrapper-image" style="background:rgb(165,165,165,0.7);z-index:3;">
            <span class="color-overlay">
              <span class="out-of-stock"> Out of Stock </span>
              <span class="content-image"><img src="./image/wooden_table.png" style="padding-top:20px;opacity:0.4;"/></span>
              <span class="label"> Wooden Table </span><br/>
              <span class="label" style="font-size: 20px;color:#7c7c7c;"><small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$100 </small></span>
            </span>
          </span>
          <div style="clear:both;"></div>
          <span class="content-wrapper-image">
            <span class="content-image"><img src="./image/sofa2.png" style="width:80%;"/></span>

            <span class="label"> Comfy Sofas </span><br/>
            <span class="label" style="font-size: 20px;color:#7c7c7c;"><small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$100 </small></span>
          </span>
          <span class="content-wrapper-image">
            <span class="content-image"><img src="./image/dresser.png" style="padding-top: 60px;"/></span>
            <span class="label">Dresser</span><br/>
            <span class="label" style="font-size: 20px;color:#7c7c7c;"><small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$100 </small></span>
          </span>
          <span class="content-wrapper-image">
            <span class="content-image"><img src="./image/bathtub.png"/></span>

            <span class="label"> Bath Tub </span><br/>
            <span class="label" style="font-size: 20px;color:#7c7c7c;"><small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$100 </small></span>
          </span>
          <div style="clear:both"> </div>
          <div class="shop-more"><a href="#"> Shop More </a></div>
        </div>
      -->
      <div class="gridview" style="height:500px;">
        <?php
          $query = $db_control->runQuery("SELECT * FROM furniture ORDER BY F_ID DESC LIMIT 6");
          if (!empty($query)) {
              foreach ($query as $key => $value) {
                  ?>
                  <div class="image">
                    <img src="<?php echo $query[$key]["F_IMAGE"] ; ?>"/>
                    <div class="product-info">
                      <div class="product-title"><?php echo $query[$key]["F_NAME"] ; ?></div>

                    </div>
                        <div class="add-to-cart">
                          <div><?php echo $query[$key]["F_PRICE"] ; ?> USD</div>
                          <div class="shop-more">
                            <a href="product_detail.php"> Show </a>
                          </div>
                        </div>
                    </div>
                    <?php
                    }
                  }
                ?>
                <div style="clear:both;"></div>
                <div class="shop-more" style="text-align:center;">
                  <a href="product_detail.php" style="font-size: 30px;"> Shop More </a>
                </div>
        </div>
    <div style="clear:both;"></div>

    <div class="newsletter">
      <div class="newsletter-content"> sign up now and get <span style="color: #FFC700; font-size: 50px;">50% </span>off for first purchase </div>
      <div class="email">
        <span><input type="text" class="email" name="email_text" placeholder="Enter your email"/></span>
        <span><input type="submit" class="subscribe" name="subscribe_button" value="Subscribe"/></span>
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

<script>
  $(window).on('load', function()
  {
    $('#status').delay(1000).fadeOut();
    $('#preloader').delay(1000).fadeOut('slow');
    $('body').delay(500).css({'overflow':'visible'});
  })
</script>
