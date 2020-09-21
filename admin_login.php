<?php
  session_start();
  $connect = mysqli_connect("localhost","root","","mtk");

  $username = "";
  $password = "";

  $alert_true = "";
  $alert_false = "";

  if(isset($_SESSION['log_in_admin']))
  {
    header("location: admin.php");
  }

  if(isset($_REQUEST['btn_login']))
  {
    $username = $_REQUEST['a_username'];
    $password = $_REQUEST['a_password'];

    $query = "SELECT * FROM admin_accounts WHERE A_USERNAME='$username' AND A_PASSWORD='$password'";
    $result = mysqli_query($connect,$query);
    $rows = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);

    if($count!=0)
    {
      $admin_id = $rows['A_ID'];
      $_SESSION['log_in_admin'] = $username;
      $_SESSION['log_in_adminid'] = $admin_id;
      header("location: admin.php");
    }
    else
    {
      $alert_false = "Wrong username or password";
    }
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="./css/main.css" type="text/css"/>
    <link rel="stylesheet" href="./css/admin_login.css" type="text/css"/>
    <style type="text/css">

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
              <span class="nav_text">
                <a href="admin_login.php"> Log In </a>
              </span>
            <!--
              <span class="nav_text">
                <a href="admin_register.php"> Register </a>
              </span>
            -->
        </div>
      <div style="clear:both;"></div>
      </div>
    <!-- Header End -->


    <div class="div-form">
      <form action="admin_login.php" method="post" class="form">
        <table class="table_form">
          <tr>
            <td><h1> Admin Log In </h1></td>
          </tr>
          <tr class="alert_box">
            <td></td>
            <td class="alert_text" style="color: red;"><?php echo $alert_false; ?></td>
          </tr>
          <tr class="alert_box">
            <td></td>
            <td class="alert_text"><?php echo $alert_true; ?></td>
          </tr>
            <td> Username </td>
            <td><input type="text" class="input_text" name="a_username" placeholder="Username" value="<?php  ?>"/></td>
          </tr>
          <tr>
            <td> Password </td>
            <td><input type="password" class="input_text" name="a_password" placeholder="Password" value="<?php  ?>"/></td>
          </tr>
        </table>
        <div class="button">
          <input type="submit" name="btn_login" value="Log in"/>
        </div>
      </form>
    </div>
  </body>
</html>
