<?php
  session_start();
  $connect = mysqli_connect("localhost","root","","mtk");

  $alert_update = "";

  if(isset($_SESSION['log_in']))
  {
    $log_in_username = $_SESSION['log_in'];
  }
  else
  {
    header("location: login.php");
  }

  if(isset($_REQUEST['btn_update']))
  {
    $id = $_SESSION['log_in_userid'];
    $name = $_REQUEST['c_name'];
    $address = $_REQUEST['c_address'];
    $phone = $_REQUEST['c_phone'];
    $email = $_REQUEST['c_email'];
    $username = $_REQUEST['c_username'];
    $password = $_REQUEST['c_password'];

    $query = "UPDATE register SET C_NAME='$name',C_ADDRESS='$address',C_PHONE='$phone',C_EMAIL='$email',C_USERNAME='$username',C_PASSWORD='$password' WHERE C_ID='$id'";
    mysqli_query($connect,$query);

    $alert_update = "Update Successfully";
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    <link rel="shortcut icon" href="./image/furniture_icon.ico" type="image/x-icon"/>
  </head>
  <body>
    <!-- Header Start -->
      <div class="header" style="width:auto; height:auto; background:none;padding-bottom: 50px;">
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
          <span class="nav_text"><a href="#"> Contact </a></span>
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
    <div class="div-form" style="height: 900px; padding:0;">
      <form action="update_user_account.php" method="post" class="form">
        <table class="table_form">
          <tr>
            <td><h1> Edit Account Setting </h1></td>
          </tr>
          <tr class="alert_box">
            <td></td>
            <td class="alert_text" style="color: blue;"><?php echo $alert_update; ?></td>
          </tr>
          <?php
          $query = "SELECT * FROM register WHERE C_ID='".$_SESSION['log_in_userid']."'";
          $result = mysqli_query($connect,$query);

          while($rows=mysqli_fetch_array($result))
          {
            ?>
            <tr style="display:none;">
              <td> Customer ID </td>
              <td><input type="text" class="input_text" name="c_id" placeholder="<?php echo $_SESSION['log_in_userid']; ?>" readonly/></td>
            </tr>
            <tr>
              <td> Name </td>
              <td><input type="text" class="input_text" name="c_name" placeholder="Name" value="<?php echo $rows['C_NAME']; ?>"/></td>
            </tr>
            <tr>
              <td> Address </td>
              <td><textarea name="c_address" rows="5" cols="23" placeholder="Address" value="<?php echo $rows['C_ADDRESS']; ?>"></textarea></td>
            </tr>
            <tr>
              <td> Phone </td>
              <td><input type="text" class="input_text" name="c_phone" placeholder="Phone" value="<?php echo $rows['C_PHONE']; ?>"/></td>
            </tr>
            <tr>
              <td> Email </td>
              <td><input type="text" class="input_text" name="c_email" placeholder="Email" value="<?php echo $rows['C_EMAIL']; ?>"/></td>
            </tr>
            <tr>
              <td> Username </td>
              <td><input type="text" class="input_text" name="c_username" placeholder="Username" value="<?php echo $log_in_username; ?>"/></td>
            </tr>
            <tr>
              <td> Password </td>
              <td><input type="password" class="input_text" name="c_password" placeholder="Password" value="<?php echo $rows['C_PASSWORD']; ?>"/></td>
            </tr>
            <?php
          }
          ?>

          <tr class="button">
            <td><input type="submit" name="btn_update" value="Update Setting"/></td>
            <td><input type="submit" name="btn_cancel" value="Cancel"/></td>
          </tr>
        </table>
      </form>
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
        <div>
      </div>
    <!-- Footer End -->
  </body>
</html>
