<?php
  session_start();
  include "auto_id.php";

  $connect = mysqli_connect("localhost","root","","mtk");

  $id = autoID("admin_accounts","A_ID","A_",10,"A_0000000001");
  $name = "";
  $username = "";
  $password = "";

  $alert_true = "";
  $alert_false = "";

  if(isset($_SESSION['log_in_admin']))
  {
    $log_in_admin = $_SESSION['log_in_admin'];
  }
  else
  {
    header("location: admin_login.php");
  }

  if(isset($_REQUEST['btn_submit']))
  {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $confirm_password = $_REQUEST['confirm_password'];

    if($password == $confirm_password)
    {
      $passwordOK = $password;
      $query = "INSERT INTO admin_accounts VALUES('$id','$name','$username','$passwordOK')";
      mysqli_query($connect,$query);
      $alert_true = "Successfully Added";
    }
    else
    {
      $alert_false = "Password might be wrong combination";
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    <style type="text/css">
    .table_form
    {
      background-image: url("./image/log_in_background.jpg");
      background-size: 100%;
      border-radius: 30px;
    }
    </style>
    <link rel="shortcut icon" href="./image/furniture_icon.ico" type="image/x-icon"/>
  </head>
  <body>
    <!-- Header Start -->
      <div class="header" style="width:auto; height:auto; background:none;padding-bottom: 50px;">
        <div class="nav-bar">
          <span class="logo_text" style="padding-right:100px;"> MTK<small style="font-size: 20px;"> furniture (Admin Dashboard) </small> </span>
          <span class="nav_text"><a href="admin.php"> Home </a></span>
          <span class="nav_text">
            <a href="purchase.php"> Purchase </a></span>

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
              <div class="content-list">
                <a href="./furniture.php"> Furniture </a>
              </div>
            </span>
          </span>
          <?php
            if(isset($_SESSION['log_in_admin']))
            {
              ?>
                <span class="nav_text">
                  <a href="checkout.php"> Cart </a>
                </span>
                </span>
                <span class="nav_text">
                  <a href="logout_admin.php"> Log Out </a>
                </span>
                <span class="nav_text">
                  <a href="index.php"><?php echo $log_in_admin; ?></a>
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
                <a href="index.php"><?php echo $log_in_admin; ?></a>
              </span>
              <?php
            }
          ?>
        </div>
      <div style="clear:both;"></div>
    </div>
    <!-- Header End -->

    <div class="admin_register">
      <form action="admin_register.php" method="post" class="form">
        <table class="table_form">
          <tr>
            <td><h1> Register Admin Account </h1></td>
          </tr>
          <tr class="alert_box">
            <td></td>
            <td class="alert_text" style="color: red;"><?php echo $alert_false; ?></td>
          </tr>
          <tr class="alert_box">
            <td></td>
            <td class="alert_text"><?php echo $alert_true; ?></td>
          </tr>
          <tr class="alert_box">
            <td></td>
            <td class="alert_text" style="color: blue;"><?php //echo $alert_update; ?></td>
          </tr>
          <tr>
            <td> ID No. </td>
            <td><input type="text" name="id" class="input_text" value="<?php echo $id; ?>" readonly/></td>
          </tr>
          <tr>
            <td> Name </td>
            <td><input type="text" class="input_text" name="name" placeholder="Name" value="<?php //echo $name; ?>"/></td>
          </tr>
          <tr>
            <td> Username </td>
            <td><input type="text" class="input_text" name="username" placeholder="Username" style=""/></td>
          </tr>
          <tr>
            <td> Password </td>
            <td><input type="password" class="input_text" name="password" placeholder="Password"/></td>
          </tr>
          <tr>
            <td> Confirm Password </td>
            <td><input type="password" class="input_text" name="confirm_password" placeholder="Password"/></td>
          </tr>
          <tr class="button">
            <td><input type="submit" name="btn_submit" value="Add User"/></td>
          </tr>
      </table>
    </form>
  </div>
</body>
</html>
