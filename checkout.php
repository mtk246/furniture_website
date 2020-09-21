<?php
  session_start();
  include "auto_id.php";
  $connect = mysqli_connect("localhost","root","","mtk");

  $v_id = autoID("checkout","V_ID","V_",10,"V_0000000001");
  $date = date("Y-m-d");
  $id = "";
  $name = "";
  $email = "";
  $address = "";
  $phone = "";
  $city = "";
  $postcode = "";
  $card = "";
  $expiry = "";
  $cvc = "";
  $total = 0;

  $alert_true = "";
  $alert_false = "";
  $alert_update = "";

  if(isset($_SESSION['log_in']))
  {
    $log_in_username = $_SESSION['log_in'];
  }
  else
  {
    header("location: login.php");
  }

  if(isset($_REQUEST['btn_confirm']))
  {
    $v_id = $_REQUEST['v_id'];
    $date = $_REQUEST['date'];
    $delivery_id = "";
    $id = $_SESSION['log_in_userid'];
    $name = $_REQUEST['c_name'];
    $email = $_REQUEST['c_email'];
    $address = $_REQUEST['c_address'];
    $phone = $_REQUEST['c_phone'];
    $city = $_REQUEST['c_city'];
    $postcode = $_REQUEST['c_postcode'];
    $card = $_REQUEST['c_card'];
    $expiry = $_REQUEST['c_expiry'];
    $cvc = $_REQUEST['c_cvc'];
    $total = $_REQUEST['total'];
    $status = "PENDING";

    if(empty($email) || empty($name) || empty($address) || empty($phone) || empty($city) || empty($postcode) || empty($card) || empty($cvc) || empty($expiry))
    {
      $alert_false = "Please fill the form correctly";
    }
    else
    {
      $alert_true = "Successfully saved";
      $query = "INSERT INTO checkout VALUES('$v_id','$date','$total','','$id','$name','$email','$address','$phone','$city','$postcode','$card','$expiry','$cvc','$status')";
      mysqli_query($connect,$query);
    }

/*
    if(isset($_SESSION['user_purchase']))
    {
      $count = count($_SESSION['user_purchase']);

      for($i=0; $i<$count; $i++)
      {
        $u_id = $_SESSION['log_in'];
        $p_id = $_SESSION['user_purchase'][$i]['id'];
        $p_qty = $_SESSION['user_purchase'][$i]['qty'];
        $p_price = $_SESSION['user_purchase'][$i]['price'];

        $product_quantity = "UPDATE furniture SET F_QUANTITY = F_QUANTITY - '$p_qty' WHERE F_ID='$p_id'";
        mysqli_query($connect,$product_quantity);

        $final_products = "INSERT INTO user_final_purchase VALUES('$u_id','$p_id','$p_qty','$p_price')";
        mysqli_query($connect,$final_products);

        $sql = "DELETE FROM user_temporary_purchase WHERE C_ID='".$_SESSION['log_in_userid']."'";
        mysqli_query($connect,$sql);

      }
    }
    */

    $query = "SELECT * FROM user_temporary_purchase WHERE C_ID='".$_SESSION['log_in_userid']."'";
    $result = mysqli_query($connect,$query);

    while($rows=mysqli_fetch_array($result))
    {
      $c_id = $rows['C_ID'];
      $f_id = $rows['F_ID'];
      $p_qty = $rows['P_QUANTITY'];
      $f_price = $rows['F_PRICE'];
      $f_amount = $rows['F_AMOUNT'];

      $sql = "INSERT INTO user_final_purchase VALUES('$v_id','$date','$c_id','$f_id','$p_qty','$f_price','$f_amount','$status')";
      mysqli_query($connect,$sql);

      $product_quantity = "UPDATE furniture SET F_QUANTITY = F_QUANTITY - '$p_qty' WHERE F_ID='$f_id'";
      mysqli_query($connect,$product_quantity);

      $query = "DELETE FROM user_temporary_purchase WHERE C_ID='".$_SESSION['log_in_userid']."'";
      mysqli_query($connect,$query);
    }

    header("location: alert_confirm.php");
  }

  if(isset($_REQUEST['add']))
  {
    $id = $_REQUEST['add'];

    $query = "UPDATE user_temporary_purchase SET P_QUANTITY = P_QUANTITY + 1 WHERE F_ID='$id'";
    mysqli_query($connect,$query);

    $sql = "SELECT * FROM user_temporary_purchase WHERE F_ID='$id'";
    $result = mysqli_query($connect,$sql);

    while($rows=mysqli_fetch_array($result))
    {
      $qty = $rows['P_QUANTITY'];
      $price = $rows['F_PRICE'];
      $amount = $rows['F_AMOUNT'];

      $amount = $qty*$price;

      $query = "UPDATE user_temporary_purchase SET F_AMOUNT='$amount' WHERE F_ID='$id'";
      mysqli_query($connect,$query);
    }
  }

  if(isset($_REQUEST['minus']))
  {
    $minus = $_REQUEST['minus'];

    $query = "UPDATE user_temporary_purchase SET P_QUANTITY = P_QUANTITY - 1 WHERE F_ID='$minus'";
    mysqli_query($connect,$query);

    $sql = "SELECT * FROM user_temporary_purchase WHERE F_ID='$minus'";
    $result = mysqli_query($connect,$sql);

    while($rows=mysqli_fetch_array($result))
    {
      $qty = $rows['P_QUANTITY'];
      $price = $rows['F_PRICE'];
      $amount = $rows['F_AMOUNT'];
      $amount = $qty*$price;

      if($qty!=0)
      {
        $query = "UPDATE user_temporary_purchase SET F_AMOUNT='$amount' WHERE F_ID='$minus'";
        mysqli_query($connect,$query);
      }
      else
      {
        $query = "DELETE FROM user_temporary_purchase WHERE F_ID='$minus'";
        mysqli_query($connect,$query);
      }

    }
  }

  if(isset($_REQUEST['row']))
  {
    $row = $_REQUEST['row'];
/*
    unset($_SESSION['user_purchase'][$row]);
    $_SESSION['user_purchase'] = array_values($_SESSION['user_purchase']);
*/
    $query = "DELETE FROM user_temporary_purchase WHERE F_ID='$row'";
    mysqli_query($connect,$query);
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    <link href="./css/supplier.css" type="text/css" rel="stylesheet"/>
    <link href="./css/checkout.css" type="text/css" rel="stylesheet"/>
    <link rel="shortcut icon" href="./image/furniture_icon.ico" type="image/x-icon"/>
  </head>
  <body>
    <!-- Header Start -->
      <div class="header" style="width:auto;height:auto;background:none;">
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
      <!--
        <div class="intro_text">
          <label  class="intro_text_1"> Furniture By MTK </label><br/>
          <label class="intro_text_2"> For Your Home Needs </label><br/>
          <label class="intro_text_3"><a href="#"> Discover More </a></label>
        </div>
      -->
      </div>
      <div style="clear:both;"></div>
    </div>
    <!-- Header End -->

    <div class="checkout_form">
      <form action="checkout.php" method="post" class="form">
        <table class="table_form">
          <tr>
            <td><h1> Checkout </h1></td>
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
            <td> Voucher No. </td>
            <td><input type="text" name="v_id" class="input_text" value="<?php echo $v_id; ?>" style="background-color:#878484;color:white;text-align:center;" readonly/></td>
          </tr>
          <tr style="display:none;">
            <td> Date </td>
            <td><input type="text" name="date" class="input_text" value="<?php echo $date; ?>" style="background-color:#878484;color:white;" readonly/></td>
          </tr>
          <tr>
            <td> Total Amount </td>
            <td><input type="text" class="input_text" name="total"
              value="
              <?php
                $query = "SELECT F_AMOUNT FROM user_temporary_purchase WHERE C_ID='".$_SESSION['log_in_userid']."'";
                $result = mysqli_query($connect,$query);

                while($row=mysqli_fetch_array($result))
                {
                    $total += $row['F_AMOUNT'];
                }
                echo $total;
              ?>
              " style="background-color:#878484;color:white;" readonly/></td>
          </tr>
          <tr>
            <td> Email </td>
            <td><input type="email" class="input_text" name="c_email" placeholder="Email" required/></td>
          </tr>
          <tr>
            <td> Name </td>
            <td><input type="text" class="input_text" name="c_name" placeholder="Name" value="<?php //echo $name; ?>" required/></td>
          </tr>
          <tr>
            <td> Address </td>
            <td><textarea name="c_address" rows="5" cols="23" placeholder="Address" value="<?php //echo $address; ?>"></textarea></td>
          </tr>
          <tr>
            <td> Phone </td>
            <td><input type="text" class="input_text" name="c_phone" placeholder="Phone" value="<?php //echo $phone; ?>" required/></td>
          </tr>
          <tr>
            <td> City </td>
            <td>
              <input type="text" class="input_text" name="c_city" placeholder="City" required/>
            </td>
          </tr>
          <tr>
            <td> Postcode </td>
            <td><input type="text" class="input_text" name="c_postcode" placeholder="Postcode" value="<?php //echo $email; ?>" required/></td>
          </tr>
          <tr>
            <td> Card Number </td>
            <td><input type="number" class="input_text" name="c_card" placeholder="0000 0000 0000 0000" maxlength="16" required/></td>
          </tr>
          <tr>
            <td> Expiry Date </td>
            <td><input type="date" class="input_text" name="c_expiry" placeholder="00/00/00/" required/></td>
          </tr>
          <tr>
            <td> CVV/CVC </td>
            <td><input type="number" class="input_text" name="c_cvc" placeholder="000" maxlength="3" required/></td>
          </tr>
          <tr class="button">
            <td><br/><input type="submit" class="btn_confirm" name="btn_confirm" value="Confirm CheckOut"/></td>
          </tr>
        </table>
          <div class="checkout_table_wrapper">
            <h1> My Cart </h1>
          <table border="1" class="checkout_table">
            <tr>
              <th style="display:none;"> Furniture ID </th>
              <th> Furniture Name </th>
              <th> Quantity </th>
              <th> Price </th>
              <th> Amount </th>
              <td style="display:none;"></td>
            </tr>
        <?php
        $query = "SELECT * FROM user_temporary_purchase where C_ID='".$_SESSION['log_in_userid']."'";
        $result = mysqli_query($connect,$query);

        while($rows=mysqli_fetch_array($result))
        {
          ?>
            <tr>
              <td> <?php echo $rows['F_NAME']; ?> </td>
              <td> <?php echo $rows['P_QUANTITY']; ?> </td>
              <td> <?php echo $rows['F_PRICE']; ?> </td>
              <td> <?php echo $rows['F_AMOUNT']; ?> </td>
              <td style="border-top:0.1px solid #fff;border-right:0.1px solid #fff;border-bottom:0.1px solid #fff;padding:0 5px;">
                <?php
                  echo '<a href="checkout.php?add='.$rows['F_ID'].'">'?> <img src="./image/add_btn.png" style="width:30px;"/><?php echo '</a>';
                ?>
              </td>
              <td style="border-top:0.1px solid #fff;border-right:0.1px solid #fff;border-bottom:0.1px solid #fff;padding:0 5px;">
                <?php
                  echo '<a href="checkout.php?minus='.$rows['F_ID'].'">'?> <img src="./image/minus_btn.png" style="width:30px;"/><?php echo '</a>';
                ?>
              </td>
              <td style="border-top:0.1px solid #fff;border-right:0.1px solid #fff;border-bottom:0.1px solid #fff;padding:0 5px;">
                <?php
                  echo '<a href="checkout.php?row='.$rows['F_ID'].'">'?> <img src="./image/remove_btn.png" style="width:30px;"/><?php echo '</a>';
                ?>
              </td>
            </tr>
          <?php
        }
        ?>
      </table>
    </div>
      </form>
    </div>

    <div style="clear:both;"></div>

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
