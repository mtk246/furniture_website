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
    <style type="text/css">
      div.admin_name
      {
        background-color: #EEEEEE;
        width:300px;
        line-height: 80px;
        padding: 0 50px;
        margin:auto;
        border-radius: 20px;
        border: 1px solid #ffc700;
      }
      span.admin_name
      {
        text-transform: uppercase;
      }
      h2
      {
        text-align: center;
        color:#5452C9;
        font-size: 30px;
      }
      h3
      {
        float: left;
        padding-left: 20px;
        padding-top: 80px;
        color:#5452C9;
      }
      table
      {
        border-collapse: collapse;
        width: 100%;
        height: 200px;
        text-align: center;
        line-height:50px;
      }
      .label
      {
        padding:50px 0;
        background-color: #eee;
        margin-top: 30px;
        border-radius: 20px;
        border: 1px solid #ffc700;
      }
      div.table
      {
        margin-left: 200px;
        width: auto;
        height:300px;
        padding:50px;
        background-color: white;
        border-radius: 20px;
        overflow-y:scroll;
      }
      .deliver_hyperlink
      {
        text-decoration: none;
        padding:15px 30px;
        outline:none;
        border-radius: 10px;
        color: #5452C9;
        font-weight: bold;
      }
      .deliver_hyperlink:hover
      {
        color: #ffc700;
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

    <!-- Content Start -->
    <div class="content_admin">
      <div class="admin_name">
        <h2> Welcome <span class="admin_name"> <?php echo $_SESSION['log_in_admin']; ?> </span> !</h2>
      </div>
      <div class="label label0">
        <h3> Delivery Status </h3>
        <div class="table">
          <table class="content_table content_table_1" border="1" style="overflow-y:scroll;">
              <tr>
                <th> Voucher ID </th>
                <th> Order Date </th>
                <th> Customer ID </th>
                <th> Address </th>
                <th> Phone </th>
                <th> Total Amount </th>
              </tr>
            <?php
              $query = "SELECT * FROM checkout WHERE STATUS='PENDING'";
              $result = mysqli_query($connect,$query);

              echo "<tr>";
                while($rows=mysqli_fetch_array($result))
                {
                  $_SESSION['delivery_id'] = $rows['V_ID'];
                  $delivery_id = $_SESSION['delivery_id'];
                  ?>
                    <td><?php echo $rows['V_ID']; ?> </td>
                    <td><?php echo $rows['P_DATE']; ?> </td>
                    <td><?php echo $rows['U_ID']; ?> </td>
                    <td><?php echo $rows['U_ADDRESS']; ?> </td>
                    <td><?php echo $rows['U_PHONE']; ?> </td>
                    <td><?php echo $rows['TOTAL']; ?> </td>
                    <td><a href='./delivery.php?did=<?php echo $delivery_id; ?>' class="deliver_hyperlink">Make Deliver</a></td>
                  <?php
                  echo "</tr>";
                }
            ?>
          </table>
        </div>
      </div>

      <div style="clear:both;"></div>

      <div class="label label1">
        <h3> User Accounts </h3>
        <div class="table">
          <table class="content_table content_table_1" border="1" style="overflow-y:scroll;">
              <tr>
                <th> ID </th>
                <th> Name </th>
                <th> Email </th>
                <th> Phone </th>
                <th> Address </th>
              </tr>
            <?php
              $query = "SELECT * FROM register";
              $result = mysqli_query($connect,$query);

              echo "<tr>";
                while($rows=mysqli_fetch_array($result))
                {
                  ?>
                    <td><?php echo $rows['C_ID']; ?> </td>
                    <td><?php echo $rows['C_NAME']; ?> </td>
                    <td><?php echo $rows['C_EMAIL']; ?> </td>
                    <td><?php echo $rows['C_PHONE']; ?> </td>
                    <td><?php echo $rows['C_ADDRESS']; ?> </td>
                  <?php
                  echo "</tr>";
                }
            ?>
          </table>
        </div>
      </div>

      <div style="clear:both;"></div>

      <div class="label label2">
        <h3> Admin Accounts </h3>
        <div class="table">
        <table class="content_table content_table_2" border="1">
          <tr>
            <th> ID </th>
            <th> Name </th>
          </tr>
          <?php
            $query = "SELECT * FROM admin_accounts";
            $result = mysqli_query($connect,$query);


            echo "<tr>";
              while($rows=mysqli_fetch_array($result))
              {
                ?>
                  <td><?php echo $rows['A_ID']; ?> </td>
                  <td><?php echo $rows['A_NAME']; ?> </td>
                <?php
                echo "</tr>";
              }
          ?>
        </table>
      </div>
    </div>

      <div style="clear:both;"> </div>

      <div class="label label 3">
        <h3> User Purchases </h3>
        <div class="table">
        <table class="content_table content_table_3" border="1">
          <tr>
            <th> Voucher No. </th>
            <th> Total </th>
            <th> User ID </th>
            <th> User Name </th>
            <th> Email </th>
            <th> Address </th>
            <th> Phone </th>
          </tr>
          <?php
            $query = "SELECT * FROM checkout";
            $result = mysqli_query($connect,$query);


            echo "<tr>";
              while($rows=mysqli_fetch_array($result))
              {
                ?>
                  <td><?php echo $rows['V_ID']; ?> </td>
                  <td><?php echo $rows['TOTAL']; ?> </td>
                  <td><?php echo $rows['U_ID']; ?> </td>
                  <td><?php echo $rows['U_NAME']; ?> </td>
                  <td><?php echo $rows['U_EMAIL']; ?> </td>
                  <td><?php echo $rows['U_ADDRESS']; ?> </td>
                  <td><?php echo $rows['U_PHONE']; ?> </td>
                <?php
                echo "</tr>";
              }
          ?>
        </table>
      </div>
    </div>

      <div style="clear:both;"></div>

      <div class="label label4">
        <h3> Available Furniture </h3>
        <div class="table">
        <table class="content_table content_table_4" border="1">
          <tr>
            <th> ID </th>
            <th> Name </th>
            <th> Quantity </th>
            <th> Image </th>
          </tr>
          <?php
            $query = "SELECT * FROM furniture";
            $result = mysqli_query($connect,$query);


            echo "<tr>";
              while($rows=mysqli_fetch_array($result))
              {
                ?>
                  <td><?php echo $rows['F_ID']; ?> </td>
                  <td><?php echo $rows['F_NAME']; ?> </td>
                  <td><?php echo $rows['F_QUANTITY']; ?> </td>
                  <td><img src="<?php echo $rows['F_IMAGE']; ?>" style="width:30%;"/> </td>
                <?php
                echo "</tr>";
              }
          ?>
        </table>
      </div>
    </div>

      <div style="clear:both;"></div>

      <div class="label label5">
        <h3> Purchases from Admin </h3>
        <div class="table">
        <table class="content_table content_table_5" border="1">
          <tr>
            <th> ID </th>
            <th> Name </th>
            <th> Purchase Date </th>
          </tr>
          <?php
            $query = "SELECT * FROM purchase";
            $result = mysqli_query($connect,$query);


            echo "<tr>";
              while($rows=mysqli_fetch_array($result))
              {
                ?>
                  <td><?php echo $rows['P_ID']; ?> </td>
                  <td><?php echo $rows['S_ID']; ?> </td>
                  <td><?php echo $rows['TOTAL_AMOUNT']; ?> </td>
                <?php
                echo "</tr>";
              }
          ?>
        </table>
      </div>
    </div>
    </div>
    <!-- Content End -->
  </body>
</html>
