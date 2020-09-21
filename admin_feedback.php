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
    <link href="./css/admin.css" type="text/css" rel="stylesheet"/>
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
                <a href="./admin_feedback.php"> Feedback </a>
              </div>
              <div class="content-list">
                <a href="./report.php"> Report </a>
              </div>
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

    <div class="label label0">
      <h3> Users Feedbacks </h3>
      <div class="table" style="height:500px;">
        <table class="content_table content_table_1" border="1" style="overflow-y:scroll;table-layout:fixed;width:100%;">
            <tr>
              <th> Feedback ID </th>
              <th> Customer ID </th>
              <th> Subject </th>
              <th> Content </th>
            </tr>
          <?php
            $query = "SELECT * FROM feedback";
            $result = mysqli_query($connect,$query);

            echo "<tr>";
              while($rows=mysqli_fetch_array($result))
              {
                ?>
                  <td><?php echo $rows['FEEDBACK_ID']; ?> </td>
                  <td><?php echo $rows['CUSTOMER_ID']; ?> </td>
                  <td style="word-wrap:break-word;"><?php echo $rows['SUBJECT']; ?> </td>
                  <td style="word-wrap:break-word;"><?php echo $rows['CONTENT']; ?> </td>
                <?php
                echo "</tr>";
              }
          ?>
        </table>
      </div>
    </div>
  </body>
</html>
