<?php
  session_start();
  $connect = mysqli_connect("localhost","root","","mtk");

  $alert_update = "";

  if(isset($_SESSION['log_in_admin']))
  {
    $log_in_username = $_SESSION['log_in_admin'];
  }
  else
  {
    header("location: admin_login.php");
  }

  if(isset($_REQUEST['btn_update']))
  {
    $id = $_SESSION['log_in_adminid'];
    $name = $_REQUEST['c_name'];
    $username = $_REQUEST['c_username'];
    $password = $_REQUEST['c_password'];

    $query = "UPDATE admin_accounts SET A_NAME='$name',A_USERNAME='$username',A_PASSWORD='$password' WHERE A_ID='$id'";
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

    <!-- Content Start -->
    <div class="div-form" style="height: 900px; padding:0;">
      <form action="update_admin_account.php" method="post" class="form">
        <table class="table_form">
          <tr>
            <td><h1> Edit Account Setting </h1></td>
          </tr>
          <tr class="alert_box">
            <td></td>
            <td class="alert_text" style="color: blue;"><?php echo $alert_update; ?></td>
          </tr>
          <?php
          $query = "SELECT * FROM admin_accounts WHERE A_ID='".$_SESSION['log_in_adminid']."'";
          $result = mysqli_query($connect,$query);

          while($rows=mysqli_fetch_array($result))
          {
            ?>
            <tr style="display:none;">
              <td> Customer ID </td>
              <td><input type="text" class="input_text" name="c_id" placeholder="<?php echo $_SESSION['log_in_adminid']; ?>" readonly/></td>
            </tr>
            <tr>
              <td> Name </td>
              <td><input type="text" class="input_text" name="c_name" placeholder="Name" value="<?php echo $rows['A_NAME']; ?>"/></td>
            </tr>
            <tr>
              <td> Username </td>
              <td><input type="text" class="input_text" name="c_username" placeholder="Username" value="<?php echo $log_in_username; ?>"/></td>
            </tr>
            <tr>
              <td> Password </td>
              <td><input type="password" class="input_text" name="c_password" placeholder="Password" value="<?php echo $rows['A_PASSWORD']; ?>"/></td>
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
  </body>
</html>
