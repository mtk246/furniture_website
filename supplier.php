<?php
  session_start();
  include "auto_id.php";
  $connect = mysqli_connect("localhost","root","","mtk");

  $id = autoID("supplier","S_ID","S_",10,"S_0000000001");
  $name = "";
  $address = "";
  $phone = "";
  $email = "";
  $alert_true = "";
  $alert_false = "";
  $alert_update = "";

  if(isset($_SESSION['log_in_admin']))
  {
    $log_in_admin = $_SESSION['log_in_admin'];
  }
  else
  {
    header("location: admin_login.php");
  }

  if(isset($_REQUEST['edit']))
  {
    $editid = $_REQUEST['edit'];
    $query = "SELECT * FROM supplier WHERE S_ID='$editid'";
    $result = mysqli_query($connect,$query);
    $row = mysqli_num_rows($result);

    if($row>0)
    {
      $data = mysqli_fetch_array($result);
      $id = $data[0];
      $name = $data[1];
      $address = $data[2];
      $phone = $data[3];
      $email = $data[4];
    }
  }

  if(isset($_REQUEST['btn_save']))
  {
    $id = $_REQUEST['s_id'];
    $name = $_REQUEST['s_name'];
    $address = $_REQUEST['s_address'];
    $phone = $_REQUEST['s_phone'];
    $email = $_REQUEST['s_email'];

    if(empty($id) || empty($name) || empty($address) || empty($phone) || empty($email))
    {
      $alert_false = "Please fill the form correctly";
    }
    else
    {
      $alert_true = "Successfully saved";
      $query = "INSERT INTO supplier VALUE('$id', '$name','$address','$phone','$email')";
      mysqli_query($connect,$query);
    }
  }

  if(isset($_REQUEST['btn_update']))
  {
    $id = $_REQUEST['s_id'];
    $name = $_REQUEST['s_name'];
    $address = $_REQUEST['s_address'];
    $phone = $_REQUEST['s_phone'];
    $email = $_REQUEST['s_email'];

    $query = "UPDATE supplier SET S_NAME='$name', S_ADDRESS='$address', S_PHONE='$phone', S_EMAIL='$email'
              WHERE S_ID='$id'";

    mysqli_query($connect,$query);
    $alert_update = "Successfully Updated";
  }

  if(isset($_REQUEST['delete']))
  {
    $deleteid = $_REQUEST['delete'];
    $query = "DELETE FROM supplier WHERE S_ID='$deleteid'";
    mysqli_query($connect,$query);
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    <link href="./css/admin_login.css" type="text/css" rel="stylesheet"/>
    <link href="./css/supplier.css" type="text/css" rel="stylesheet"/>
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

    <div class="div-form">
      <form action="supplier.php" method="post" class="form">
        <table class="table_form">
          <tr>
            <td><h1> Supplier </h1></td>
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
            <td class="alert_text" style="color: blue;"><?php echo $alert_update; ?></td>
          </tr>
          <tr>
            <td> ID </td>
            <td><input type="text" class="input_text" name="s_id" placeholder="ID" value="<?php echo $id; ?>" readonly/></td>
          </tr>
          <tr>
            <td> Name </td>
            <td><input type="text" class="input_text" name="s_name" placeholder="Name" value="<?php echo $name; ?>"/></td>
          </tr>
          <tr>
            <td> Address </td>
            <td><textarea name="s_address" rows="5" cols="23" placeholder="Address" value="<?php echo $address; ?>"></textarea></td>
          </tr>
          <tr>
            <td> Phone </td>
            <td><input type="text" class="input_text" name="s_phone" placeholder="Phone" value="<?php echo $phone; ?>"/></td>
          </tr>
          <tr>
            <td> Email </td>
            <td><input type="text" class="input_text" name="s_email" placeholder="Email" value="<?php echo $email; ?>"/></td>
          </tr>
        </table>
        <div class="button">
          <input type="submit" name="btn_save" value="Save"/>
          <input type="submit" name="btn_update" value="Update"/>
        </div>
      </form>
    </div>

    <div class="php-form">
      <?php
      echo "<div class='table_database'>";

        echo "<table border='1' class='database'";
        echo "<tr>";
          $query = "SELECT * FROM supplier";
          $result = mysqli_query($connect,$query);
            echo "<th>" . "ID" . "</th>";
            echo "<th>" . "Name" . "</th>";
            echo "<th>" . "Address" . "</th>";
            echo "<th>" . "Phone" . "</th>";
            echo "<th>" . "Email" . "</th>";
            echo "<th></th>";
            echo "<th></th>";
        echo "</tr>";

          while($data=mysqli_fetch_array($result))
          {
            echo "<tr class='edit_delete'>";
              echo "<td>" . $data[0] . "</td>";
              echo "<td>" . $data[1] . "</td>";
              echo "<td>" . $data[2] . "</td>";
              echo "<td>" . $data[3] . "</td>";
              echo "<td>" . $data[4] . "</td>";
              echo '<td class="edit"><img src="./image/edit_icon.png" width="20px"/><a href="supplier.php?edit='.$data[0].'">Edit</a></td>';
              echo '<td class="delete"><img src="./image/remove_icon.png" width="20px"/><a href="supplier.php?delete='.$data[0].'">Delete</a></td>';
          }
          echo "</tr>";
        echo "</table>";
      echo "</div>";
    ?>
    </div>

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
