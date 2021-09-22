<?php
  session_start();
  include("auto_id.php");

  $connect = mysqli_connect("localhost","root","","mtk");

  $feedback_id = autoID("feedback","FEEDBACK_ID","F_","10","F_0000000001");
  $error = "";
  $success = "";

  if(isset($_SESSION['log_in']))
  {
    $log_in_username = $_SESSION['log_in'];
    $user_id = $_SESSION['log_in_userid'];
  }
  else
  {
    header("location: login.php");
  }

  if(isset($_REQUEST['send']))
  {
    $f_id = $_REQUEST['feedback_id'];
    $c_id = $_REQUEST['customer_id'];
    $subject = $_REQUEST['txt_subject'];
    $content = $_REQUEST['txt_content'];

    if(empty($subject) || empty($content))
    {
      $error = "Please fill the form completely to send Feedback !!";
    }
    else
    {
      $success = "Feedback submitted successfully";
      $query = "INSERT INTO feedback VALUES('$f_id','$c_id','$subject','$content')";
      mysqli_query($connect,$query);
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    <link href="./css/feedback.css" type="text/css" rel="stylesheet"/>
  </head>
  <body>
  <!-- Header Start -->
    <div class="header" style="width:auto; height:auto; background:none;padding-bottom:30px;">
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
    <div class="announcement">
      <span> Your feedback is our first priority </span>
    </div>
    <form id="form" action="feedback.php" method="post">
      <h1> Feedback </h1>
      <div class="notification">
        <label class="error notify"><?php echo $error; ?></label>
        <label class="success notify"><?php echo $success; ?></label>
      </div>
      <table>
        <tr style="display:none;">
          <td> Feedback ID </td>
          <td><input type="text" name="feedback_id" value="<?php echo $feedback_id; ?>" readonly/></td>
        </tr>
        <tr style="display:none;">
          <td> Customer ID </td>
          <td><input type="text" name="customer_id" value="<?php echo $user_id; ?>" readonly/></td>
        </tr>
        <tr>
          <td style="font-weight:bold;"> Subject </td>
          <td><input type="text" class="subject" name="txt_subject" placeholder="Subject" maxlength="75"></td>
        </tr>
        <tr>
          <td style="font-weight:bold;"> Content </td>
          <td>
            <textarea class="content" name="txt_content" onkeyup="countChars(this);" placeholder="Write a feedback" maxlength="800"></textarea>
          </td>
        </tr>
      </table>
      <p id="charNum"> 0 characters </p>
      <div class="send_button_wrapper"><input type="submit" form="form" name="send" class="send" value="Send"/></div>
    </form>
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

<script type="text/javascript" src="./js/jQuery.js"></script>

<script type="text/javascript">
  function countChars(obj)
  {
    var maxLength = 800;
    var strLength = obj.value.length;

    if(strLength>maxLength)
    {
      document.getElementById("charNum").innerHTML = '<span style="color:red;">'+strLength+' out of '+maxLength+' characters</span>';
    }
    else
    {
        document.getElementById("charNum").innerHTML = strLength+' out of '+maxLength+' characters';
    }
  }
</script>
