<?php
  include "auto_id.php";
  $connect = mysqli_connect("localhost","root","","mtk");

  $id = autoID("register","C_ID","C_",10,"C_0000000001");
  $name = "";
  $address = "";
  $phone = "";
  $gender = "";
  $email = "";
  $birth = "";
  $username = "";
  $password = "";
  $alert_true = "";
  $alert_false = "";
  $alert_update = "";

  if(isset($_REQUEST['btn_signup']))
  {
    $id = $_REQUEST['c_id'];
    $name = $_REQUEST['c_name'];
    $address = $_REQUEST['c_address'];
    $phone = $_REQUEST['c_phone'];
    $gender = $_REQUEST['c_gender'];
    $email = $_REQUEST['c_email'];
    $birth = $_REQUEST['c_birth'];
    $username = $_REQUEST['c_username'];
    $password = $_REQUEST['c_password'];

    if(!isset($id) || !isset($name) || !isset($address) || !isset($phone) || !isset($gender) || !isset($email) || empty($birth) || !isset($username) ||
    !isset($password))
    {
      $alert_false = "Please fill the form correctly";
    }
    else
    {
      $alert_true = "Successfully Sign up";
      $query = "INSERT INTO register VALUE('$id', '$name','$address','$phone','$gender','$email','$birth','$username','$password')";
      mysqli_query($connect,$query);
      /*
      echo "<div class='table_database'>";

      //show data from database with table
        echo "<table border='1' class='database'";
        echo "<tr>";
          $query = "SELECT * FROM customer";
          $result = mysqli_query($connect,$query);
            echo "<th></th>";
            echo "<th></th>";
            echo "<th>" . "ID" . "</th>";
            echo "<th>" . "Name" . "</th>";
            echo "<th>" . "Address" . "</th>";
            echo "<th>" . "Phone" . "</th>";
            echo "<th>" . "Gender" . "</th>";
            echo "<th>" . "Email" . "</th>";
            echo "<th>" . "Birth" . "</th>";
            echo "<th>" . "Username" . "</th>";
            echo "<th>" . "Password" . "</th>";
        echo "</tr>";

          while($data=mysqli_fetch_array($result))
          {
            echo "<tr class='edit_delete'>";
              echo '<td class="edit"><img src="./image/edit_icon.png" width="20px"/><a href="customer.php?edit='.$data[0].'">Edit</a></td>';
              echo '<td class="delete"><img src="./image/remove_icon.png" width="20px"/><a href="customer.php?delete='.$data[0].'">Delete</a></td>';
              echo "<td>" . $data[0] . "</td>";
              echo "<td>" . $data[1] . "</td>";
              echo "<td>" . $data[2] . "</td>";
              echo "<td>" . $data[3] . "</td>";
              echo "<td>" . $data[4] . "</td>";
              echo "<td>" . $data[5] . "</td>";
              echo "<td>" . $data[6] . "</td>";
              echo "<td>" . $data[7] . "</td>";
              echo "<td>" . $data[8] . "</td>";
          }
          echo "</tr>";
        echo "</table>";
      echo "</div>";
      */
    }
  }

  if(isset($_REQUEST['btn_update']))
  {
    $id = $_REQUEST['c_id'];
    $name = $_REQUEST['c_name'];
    $address = $_REQUEST['c_address'];
    $phone = $_REQUEST['c_phone'];
    $gender = $_REQUEST['c_gender'];
    $email = $_REQUEST['c_email'];
    $birth = $_REQUEST['c_birth'];
    $username = $_REQUEST['c_username'];
    $password = $_REQUEST['c_password'];


    $query = "UPDATE customer
              SET C_NAME='$name', C_ADDRESS='$address', C_PHONE='$phone', C_GENDER='$gender', C_EMAIL='$email',
              C_BIRTH='$birth', C_USERNAME='$username', C_PASSWORD='$password'
              WHERE C_ID='$id'";

    mysqli_query($connect,$query);
    $alert_update = "Successfully Updated";
  }

//edit button
  if(isset($_REQUEST['edit']))
  {
    $editid = $_REQUEST['edit'];
    $query = "SELECT * FROM register WHERE C_ID='$editid'";
    $result = mysqli_query($connect,$query);
    $row = mysqli_num_rows($result);

    if($row>0)
    {
      $data = mysqli_fetch_array($result);
      $id = $data[0];
      $name = $data[1];
      $address = $data[2];
      $phone = $data[3];
      $gender = $data[4];
      $email = $data[5];
      $birth = $data[6];
      $username =$data[7];
      $password = $data[8];
    }
/*
    echo "<div class='table_database'>";

    //show data from database with table
      echo "<table border='1' class='database'";
      echo "<tr>";
        $query = "SELECT * FROM customer";
        $result = mysqli_query($connect,$query);
          echo "<th></th>";
          echo "<th></th>";
          echo "<th>" . "ID" . "</th>";
          echo "<th>" . "Name" . "</th>";
          echo "<th>" . "Address" . "</th>";
          echo "<th>" . "Phone" . "</th>";
          echo "<th>" . "Gender" . "</th>";
          echo "<th>" . "Email" . "</th>";
          echo "<th>" . "Birth" . "</th>";
          echo "<th>" . "Username" . "</th>";
          echo "<th>" . "Password" . "</th>";
      echo "</tr>";

        while($data=mysqli_fetch_array($result))
        {
          echo "<tr class='edit_delete'>";
          echo '<td class="edit"><img src="./image/edit_icon.png" width="20px"/><a href="customer.php?edit='.$data[0].'">Edit</a></td>';
          echo '<td class="delete"><img src="./image/remove_icon.png" width="20px"/><a href="customer.php?delete='.$data[0].'">Delete</a></td>';
          echo "<td>" . $data[0] . "</td>";
          echo "<td>" . $data[1] . "</td>";
          echo "<td>" . $data[2] . "</td>";
          echo "<td>" . $data[3] . "</td>";
          echo "<td>" . $data[4] . "</td>";
          echo "<td>" . $data[5] . "</td>";
          echo "<td>" . $data[6] . "</td>";
          echo "<td>" . $data[7] . "</td>";
          echo "<td>" . $data[8] . "</td>";
        }
        echo "</tr>";
      echo "</table>";
    echo "</div>";
    */
  }

//delete button
  if(isset($_REQUEST['delete']))
  {
    $deleteid = $_REQUEST['delete'];
    $query = "DELETE FROM register WHERE C_ID='$deleteid'";
    mysqli_query($connect,$query);

    /* echo "<div class='table_database'>";

    //show data from database with table
     echo "<table border='1' class='database'";
      echo "<tr>";
        $query = "SELECT * FROM customer";
        $result = mysqli_query($connect,$query);
          echo "<th></th>";
          echo "<th></th>";
          echo "<th>" . "ID" . "</th>";
          echo "<th>" . "Name" . "</th>";
          echo "<th>" . "Address" . "</th>";
          echo "<th>" . "Phone" . "</th>";
          echo "<th>" . "Gender" . "</th>";
          echo "<th>" . "Email" . "</th>";
          echo "<th>" . "Birth" . "</th>";
          echo "<th>" . "Username" . "</th>";
          echo "<th>" . "Password" . "</th>";
      echo "</tr>";

        while($data=mysqli_fetch_array($result))
        {
          echo "<tr class='edit_delete'>";
          echo '<td class="edit"><img src="./image/edit_icon.png" width="20px"/><a href="customer.php?edit='.$data[0].'">Edit</a></td>';
          echo '<td class="delete"><img src="./image/remove_icon.png" width="20px"/><a href="customer.php?delete='.$data[0].'">Delete</a></td>';
          echo "<td>" . $data[0] . "</td>";
          echo "<td>" . $data[1] . "</td>";
          echo "<td>" . $data[2] . "</td>";
          echo "<td>" . $data[3] . "</td>";
          echo "<td>" . $data[4] . "</td>";
          echo "<td>" . $data[5] . "</td>";
          echo "<td>" . $data[6] . "</td>";
          echo "<td>" . $data[7] . "</td>";
          echo "<td>" . $data[8] . "</td>";
        }
        echo "</tr>";
      echo "</table>";

      echo "</div>";
      */
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
  <body style="background-color: #ddd;">
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
              <span class="nav_text">
                <a href="login.php"> Log In </a>
              </span>
              <span class="nav_text">
                <a href="register.php"> Register </a>
              </span>
        </div>
      <div style="clear:both;"></div>
    </div>
    <!-- Header End -->

    <!-- Content Start -->
    <div class="div-form">
      <form action="register.php" method="post" class="form" style="height:800px;">
        <table class="table_form">
          <tr>
            <td><h1> Sign Up </h1></td>
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
          <tr style="display:none;">
            <td> Customer ID </td>
            <td><input type="text" class="input_text" name="c_id" placeholder="ID" value="<?php echo $id; ?>" readonly/></td>
          </tr>
          <tr>
            <td> Name </td>
            <td><input type="text" class="input_text" name="c_name" placeholder="Name" value="<?php echo $name; ?>"/></td>
          </tr>
          <tr>
            <td> Address </td>
            <td><textarea name="c_address" rows="5" cols="23" placeholder="Address" value="<?php echo $address; ?>"></textarea></td>
          </tr>
          <tr>
            <td> Phone </td>
            <td><input type="text" class="input_text" name="c_phone" placeholder="Phone" value="<?php echo $phone; ?>"/></td>
          </tr>
          <tr>
            <td> Gender </td>
            <td>
              <input type="radio" name="c_gender" value="Male" required/> Male
              <input type="radio" name="c_gender" value="Female" required/> Female
            </td>
          </tr>
          <tr>
            <td> Email </td>
            <td><input type="text" class="input_text" name="c_email" placeholder="Email" value="<?php echo $email; ?>"/></td>
          </tr>
          <tr>
            <td> Date of Birth </td>
            <td><input type="date" class="c_birth" name="c_birth" style="width:200px;height:30px;border-radius:5px;border:1px solid;padding-left:10px;"/></td>
          </tr>
          <tr>
            <td> Username </td>
            <td><input type="text" class="input_text" name="c_username" placeholder="Username" value="<?php echo $birth; ?>"/></td>
          </tr>
          <tr>
            <td> Password </td>
            <td><input type="password" class="input_text" name="c_password" placeholder="Password" value="<?php echo $password; ?>"/></td>
          </tr>
        </table>
        <div class="button">
          <input type="submit" name="btn_signup" value="Sign Up"/>
        </div>
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
