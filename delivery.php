<?php
  session_start();
  include "auto_id.php";
  $connect = mysqli_connect("localhost","root","","mtk");

  $delivery_id = autoID("checkout","DELIVERY_ID","D_","10","D_0000000001");
  $date = date("Y-m-d");
  $_SESSION['voucher_id'] = $_REQUEST['did'];
  $voucher_id = $_SESSION['voucher_id'];

  if(isset($_REQUEST['submit_btn']))
  {
    $delivery = $_REQUEST['delivery_id'];
    $agent = $_REQUEST['delivery_agent'];

    $query = "UPDATE checkout SET DELIVERY_ID='$delivery',STATUS='DELIVERING' WHERE V_ID='$voucher_id'";
    mysqli_query($connect,$query);

    $sql = "UPDATE user_final_purchase SET STATUS='DELIVERING' WHERE V_ID='$voucher_id'";
    mysqli_query($connect,$sql);

    $delivery_status = "INSERT INTO delivery_status VALUES('$voucher_id','$date','$delivery','$agent','DELIVERING')";
    mysqli_query($connect,$delivery_status);

    unset($_SESSION['voucher_id']);

    header("location:admin.php");
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    <link href="css/delivery.css" type="text/css" rel="stylesheet"/>
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
          <!--
              <span class="nav_text">
                <a href="admin_register.php"> Register </a>
              </span>
          -->
              <span class="nav_text dropdown">
                <span class="dropdown-btn"><a href="admin.php"><?php echo $_SESSION['log_in_admin']; ?> </a></span>
          <!--
                <span class="dropdown-content" style="width: auto;">
                  <div class="content-list" style="width: 200px;text-align:center;">
                    <a href="./admin_account_setting.php"> Account Setting </a>
                  </div>
                </span>
          -->
              </span>
        </div>
      <div style="clear:both;"></div>
      </div>
    <!-- Header End -->

    <!-- Content Start -->
      <form action="" method="post">
      <div class="table">
        <table>
          <tr>
            <td> Date </td>
            <td><input type="text" name="delivery_id" value="<?php echo $date; ?>" readonly/></td>
          </tr>
          <tr>
            <td> Delivery ID </td>
            <td><input type="text" name="delivery_id" value="<?php echo $delivery_id; ?>" readonly/></td>
          </tr>
          <tr>
            <td> Voucher No. </td>
            <td><input type="text" name="voucher_id" value="<?php echo $voucher_id; ?>" readonly/></td>
          </tr>
          <tr>
            <td> Delivery Agent </td>
            <td>
              <select id="delivery_agent" class="delivery_agent" name="delivery_agent" required>
                <option value="" selected="selected"> Choose Delivery Agent </option>
                <?php
                  $sql = "SELECT D_ID,D_NAME FROM delivery_agent";
                  $result = mysqli_query($connect,$sql);

                  while($rows=mysqli_fetch_array($result))
                  {
                    ?>
                      <option value="<?php echo $rows['D_ID']; ?>">
                        <?php echo $rows['D_NAME']; ?>
                      </option>
                    <?php
                  }
                ?>
            </td>
          </tr>
        </table>
        <div class="submit_btn_wrapper"><input type="submit" name="submit_btn" value="Make Deliver"/></div>
      </div>
    </form>
    <!-- Content End -->
  </body>
</html>
