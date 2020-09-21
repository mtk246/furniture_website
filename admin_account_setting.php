<?php
  session_start();
  $connect = mysqli_connect("localhost","root","","mtk");

  if(isset($_SESSION['log_in_admin']))
  {
    $log_in_admin = $_SESSION['log_in_admin'];
  }
  else
  {
    header("location: admin_login.php");
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    <link href="./css/user_account_setting.css" type="text/css" rel="stylesheet"/>
    <link href="./css/admin.css" type="text/css" rel="stylesheet"/>
    <link rel="shortcut icon" href="./image/furniture_icon.ico" type="image/x-icon"/>
    <style type="text/css">
    .account_table
    {
      border-collapse: collapse;
      width: 50%;
      text-align: center;
      line-height: 50px;
      margin:auto;
    }
    table td,th
    {
      font-size: 20px;
    }
    .content_account_wrapper
    {
      padding:50px 0;
      padding-top: 20px;
      margin:auto;
      text-align: center;
    }
    </style>
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
                <a href="logout_admin.php"> Log Out </a>
              </span>
              <span class="nav_text">
                <a href="admin_register.php"> Register </a>
              </span>
              <span class="nav_text dropdown">
                <span class="dropdown-btn"><a href="#"><?php echo $_SESSION['log_in_admin']; ?> </a></span>
                <span class="dropdown-content" style="width: auto;">
                  <div class="content-list" style="width: 200px;text-align:center;">
                    <a href="./admin_account_setting.php"> Account Setting </a>
                  </div>
                </span>
              </span>
        </div>
      <div style="clear:both;"></div>
      </div>
    <!-- Header End -->

    <div class="content_account_wrapper">
      <div class="btn_edit">
        <a href="update_admin_account.php"><input type="submit" class="input_text" name="btn_edit" value="Edit Profile"/></a>
      </div>
      <div class="user_original_form">
        <h2> User Information </h2>
        <table class="account_table" border="1">
          <?php
            if(isset($_SESSION['log_in_admin']))
            {
              $query = "SELECT * FROM admin_accounts WHERE A_ID='".$_SESSION['log_in_adminid']."'";
              $result = mysqli_query($connect,$query);
              echo "<tr>";
                while($rows=mysqli_fetch_array($result))
                {
                  ?>
                    <tr>
                      <th> Name </th>
                      <td> <?php echo $rows['A_NAME']; ?> </td>
                    </tr>
                      <th> Username </th>
                      <td> <?php echo $rows['A_USERNAME']; ?> </td>
                    </tr>
                    <tr>
                      <th> Password </th>
                      <td> <?php echo $rows['A_PASSWORD']; ?> </td>
                    </tr>
                  <?php
                }
                echo "</tr>";
            }
          ?>
        </table>
      </div>
    </div>
  </body>
</html>
