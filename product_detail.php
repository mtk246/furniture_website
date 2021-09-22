<?php
  session_start();
  include "auto_id.php";
  include "dbcontrol.php";

  $db_control = new DBController();

  $connect = mysqli_connect("localhost","root","","mtk");

  $id = "";
  $name = "";
  $qty = "";
  $price = "";
  $date = date("Y-m-d");
  $amt = 0;
  $success_comment = "";
  $error = "";

  $comment_id = autoID("review","R_ID","R_",10,"R_0000000001");

  if(isset($_SESSION['log_in']))
  {
    $log_in_username = $_SESSION['log_in'];
  }
  else
  {
    $log_in_username = "Guest";
  }

  if(isset($_REQUEST['btn_checkout']))
  {
    if(isset($_SESSION['user_purchase']))
    {
      $count = count($_SESSION['user_purchase']);

      for($i=0; $i<$count; $i++)
      {
        $u_id = $_SESSION['log_in_userid'];
        $f_id = $_SESSION['user_purchase'][$i]['id'];
        $f_name = $_SESSION['user_purchase'][$i]['name'];
        $f_qty = $_SESSION['user_purchase'][$i]['qty'];
        $f_price = $_SESSION['user_purchase'][$i]['price'];
        $f_amount = $_SESSION['user_purchase'][$i]['amt'];

        $query = "INSERT INTO user_temporary_purchase VALUES('$u_id','$f_id','$f_name','$f_qty','$f_price','$f_amount')";
        mysqli_query($connect,$query);
      }

      unset($_SESSION['user_purchase']);

      header("location: checkout.php");
    }
  }

  if(isset($_REQUEST['add-to-cart']))
  {
    if(isset($_SESSION['log_in']))
    {
        $id = $_REQUEST['f_id'];
        $name = $_REQUEST['f_name'];
        $qty = $_REQUEST['f_qty'];
        $price = $_REQUEST['f_price'];
        $amt = $qty*$price;

        if(!isset($_SESSION['user_purchase']))
        {
          $_SESSION['user_purchase'][0]['id'] = $id;
          $_SESSION['user_purchase'][0]['name'] = $name;
          $_SESSION['user_purchase'][0]['qty'] = $qty;
          $_SESSION['user_purchase'][0]['price'] = $price;
          $_SESSION['user_purchase'][0]['amt'] = $amt;
        }
        else
        {
          $check = true;
          $count = count($_SESSION['user_purchase']);

          for($j=0; $j<$count; $j++)
          {
            if($id==$_SESSION['user_purchase'][$j]['id'])
            {
              $check = false;
              $_SESSION['user_purchase'][$j]['qty'] = $_SESSION['user_purchase'][$j]['qty']+$qty;
              $_SESSION['user_purchase'][$j]['amt'] = $_SESSION['user_purchase'][$j]['qty'] * $_SESSION['user_purchase'][$j]['price'];
            }
          }

          if($check == true)
          {
            $_SESSION['user_purchase'][$count]['id'] = $id;
            $_SESSION['user_purchase'][$count]['name'] = $name;
            $_SESSION['user_purchase'][$count]['qty'] = $qty;
            $_SESSION['user_purchase'][$count]['price'] = $price;
            $_SESSION['user_purchase'][$count]['amt'] = $amt;
            //$_SESSION['user_purchase'][$count]['total'] = $total;
          }
        }

    }
    else
    {
      header("location: login.php");
    }
  }

  if(isset($_REQUEST['add']))
  {
    $add = $_REQUEST['add'];
    $count = $_SESSION['user_purchase'];
    $query = "SELECT F_QUANTITY FROM furniture WHERE F_ID='$add'";
    mysqli_query($connect,$query);

    for($i=0; $i<$count; $i++)
    {

    }

  }

  if(isset($_REQUEST['row']))
  {
    $row = $_REQUEST['row'];

    unset($_SESSION['user_purchase'][$row]);
    $_SESSION['user_purchase'] = array_values($_SESSION['user_purchase']);
  }

  if(isset($_REQUEST['txt_comment_submit']))
  {
    $commentid = $_REQUEST['txt_comment_id'];
    $comment = $_REQUEST['txt_comment'];
    $furniture_id = $_REQUEST['txt_furniture_id'];
    $customer_id = $_SESSION['log_in_userid'];
    $customer_name = $_SESSION['log_in'];

    if($comment!="")
    {
      $query = "INSERT INTO review VALUES('$commentid','$customer_id','$customer_name','$furniture_id','$comment')";
      mysqli_query($connect,$query);

      header('location: product_detail.php?pdetail='.$furniture_id);
      $success_comment = "Commented Successfully";
    }
    else
    {
      $error = "Please write a comment to review";
      header('location: product_detail.php?pdetail='.$furniture_id);
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="./css/product_detail.css" type="text/css" rel="stylesheet"/>
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    <style type="text/css">
      .newsletter
      {
        width: 100%;
        background-color: rgb(221,221,221,0.3);
        border-radius: 10px;
        padding-bottom: 30px;
        margin-bottom: 30px;
      }
      .newsletter .newsletter-content
      {
        font-size: 30px;
        text-align: center;
        text-transform: uppercase;
        padding: 80px 0 30px 0;
      }
      .product_detail
      {
        background-color: rgb(221,221,221,0.3);
      }
      .product_description_wrapper
      {
        float:left;
        padding:50px;
        border-radius: 20px;
        overflow:hidden;
        background-color: white;
        width:800px;
        height:1000px;
        overflow-y: scroll;
        margin: 50px 0;
      }
      .remove_button_table
      {
        text-decoration: none;
      }
      .remove_button_table:hover
      {
        color: red;
      }
      .show_categories_wrapper
      {
        padding-bottom: 30px;
        font-size: 20px;
      }
      .show_categories
      {
        text-decoration: none;
        color: #fff;
        background-color: #ffc700;
        padding:15px 30px;
        border-radius: 10px;
      }
      .show_categories:hover
      {
        background-color: #eee;
        color: #5452c9;
      }
      .product_description
      {
        width:500px;
        height:500px;
        font-size: 20px;
        line-height: 50px;
        float:right;
        padding: 30px;
        background-color:white;
      }
      input[type="text"]
      {
        font-size: 20px;
        color: black;
        border: none;
        width: 150px;
        height: 30px;
      }
      input[type=submit]
      {
        width:200px;
        height: 40px;
        font-size: 15px;
        color: white;
        background-color: #ffc700;
        margin-top: 20px;
        border-radius: 5px;
        border:none;
      }
      input[type=submit]:hover
      {
        background-color: #fff;
        color: #ffc700;
      }

      .image
      {
        float: left;
        width:350px;
        height:400px;
        padding:20px 0;
        margin-left:50px;
        margin-bottom:50px;
        background-color:#F5F5F5;
        text-align: center;
        text-transform: uppercase;
        border-radius: 20px;
        font-size: 20px;
        line-height: 30px;
      }
      .image img
      {
        width:75%;
        transition: transform .2s;
        padding-bottom: 30px;
      }
      .image:hover img
      {
        transform: scale(1.3);
      }
      .see_more
      {
        text-decoration: none;
        font-size: 15px;
        margin-left: 20px;
        text-align: center;
        background-color: #FFC700;
        color: #fff;
        padding: 15px 20px;
        border-radius: 20px;
      }
      .see_more:hover
      {
        background-color: #fff;
        color: #ffc700;
      }
      .select_option
      {
        overflow-y: scroll;
        background-color: #fff;
        width: 200px;
        height: 400px;
        margin: 50px;
        border-radius: 20px;
        padding:30px 50px;
        text-align: center;
      }

      .select_hyperlink
      {
        display: block;
        text-decoration: none;
        font-size: 20px;
        color: #5452c9;
        line-height: 50px;
        text-transform: uppercase;
      }

      .select_hyperlink:hover
      {
          color: #fff;
          background-color: #ffc700;
          border-radius: 20px;
      }

      .show_all_categories
      {
        color: red;
      }

      .show_all_categories:hover
      {
        color: #000;
        background-color: #fff;
      }

      .cart_table
      {
        text-transform: uppercase;
      }

      .comment_wrapper
      {
        width: 500px;
        height: auto;
      }

      .name
      {
        font-size: 18px;
        text-decoration: underline;
      }

      .comment
      {
        border: 0.3px solid #a8a3a3;
        font-size: 15px;
        width: 600px;
        height: auto;
        padding: 20px 0 20px 10px;
        border-radius: 5px;
      }

      .no_comment
      {
        font-size: 18px;
      }

      .success_comment_wrapper
      {
        text-align: center;
        margin-bottom: 30px;
      }

      .success_comment
      {
        font-size: 30px;
        color: green;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 20px;
      }
    </style>
    <link rel="shortcut icon" href="./image/furniture_icon.ico" type="image/x-icon"/>
  </head>
  <body>

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
        </div>
      <div style="clear:both;"></div>
    </div>
    <!-- Header End -->

    <div class="newsletter">
      <div class="newsletter-content"> get <span style="color: #FFC700; font-size: 50px;">50% </span>off & <span style="color: #FFC700; font-size: 50px;"> delivery free </span> for first <span style="color: #FFC700; font-size: 50px;"> Three </span>purchases </div>
    </div>

    <div class="success_comment_wrapper">
      <?php
        echo "<span class='success_comment'>" . $success_comment . "</span>";
      ?>
    </div>

    <div class="success_comment_wrapper">
      <?php
        echo "<span class='success_comment'>" . $error . "</span>";
      ?>
    </div>

    <form action="product_detail.php" class="product_detail" name="" method="POST">
      <div class="product_detail_content">
        <div class="select_option">
        <!--
          <select id="product_detail" name="product_detail" class="product_detail" size="10"
          style="
          width:200px;
          padding: 20px 0;
          text-align: center;
          font-size: 20px;
          border:none;
          border-radius: 10px;
          ">
            <?php
            /*
              $sql = "SELECT F_ID,F_NAME FROM furniture ORDER BY F_NAME ASC";
              $result = mysqli_query($connect,$sql);

              while($rows=mysqli_fetch_array($result))
              {
                ?>
                <option value="<?php echo $rows['F_ID']; ?>" name="f_id" id="f_id"
                  style="
                    padding:20px 0;
                    border-radius: 5px;
                    text-transform: uppercase;
                  " onmouseover="this.style.color='red'" onmouseout="this.style.color='black'"
                  >
                  <?php echo $rows['F_NAME']; ?>
                </option>
                <?php
              }
              */
            ?>
          </select>
          <input class="btn_submit" type="submit" id="btn_submit" name="btn_submit" value="Select"/>
    -->
          <a href="product_detail.php" class="select_hyperlink show_all_categories"> All categories </a>
          <?php
            $query = "SELECT F_ID,F_NAME FROM furniture ORDER BY F_NAME ASC";
            $result = mysqli_query($connect,$query);

            while($rows=mysqli_fetch_array($result))
            {
                echo '<a href="product_detail.php?id='.$rows['F_ID'].'" class="select_hyperlink" name="hyperlink">' . $rows['F_NAME'] . '</a>';
            }
          ?>
        </div>

        <?php
          if(isset($_SESSION['log_in']))
          {
            ?>
            <div class="product_description_wrapper" id="product_description_wrapper" style="width:850px;">

              <div class="show_categories_wrapper"><a href="product_detail.php" class="show_categories"> << Show all categories </a></div>
              <?php
                  if(isset($_REQUEST['id']))
                  {
                    $id = $_REQUEST['id'];
                    $query = "SELECT * FROM furniture WHERE F_ID='$id'";
                    $result = mysqli_query($connect,$query);

                    echo "<div style='height:700px;width:1000px;'>";
                      while($rows=mysqli_fetch_array($result))
                        {
                          echo "<div class='image_transform'>";
                            ?>
                              <img src="<?php echo $rows['F_IMAGE']; ?>" style="float:left;width:30%;"/>
                            <?php
                          echo "</div>";
                          echo "<table class='product_description'
                          style=
                          '
                            margin-right:200px;
                          '
                          >";
                            echo "<tr style='display:none;'>";
                              echo "<td style='display:none;'> Furniture ID </td>";
                              echo "<td style='display:none;'><input type='text' name='f_id' value='".$rows['F_ID']."' readonly/></td>";
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Furniture Name </td>";
                              echo "<td><input type='text' name='f_name' value='" . $rows['F_NAME']. "' readonly/></td>" ;
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Price </td>";
                              echo "<td class='add-to-cart'><input type='text' name='f_price' value='" . $rows['F_PRICE'] . "' readonly/></td>";
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Descriptions </td>";
                              echo "<td><textarea name='f_desc' value='' style='font-family:arial;font-size:20px;' readonly>".$rows['F_DESC']." </textarea></td>";
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Avaliable Quantity </td>";
                              echo "<td><input type='text' name='' value='" . $rows['F_QUANTITY'] . "'readonly/></td>";
                            echo "</tr>";
                      }
                            echo "<tr>";
                              echo "<td> Desire Quantity </td>";
                              echo "<td><input type='text' name='f_qty' style='border:1px solid #000;'/></td>";
                            echo "</tr>";
                      echo "</table>";
                      echo "<div style='padding-left:450px;float:left'>";
                        echo "<input type='submit' name='add-to-cart' class='add-to-cart' value='Add to Cart' style='width:300px;'/></td>";
                      echo "</div>";

                      echo "<div style='clear:both;'></div>";

                      if(isset($_SESSION['log_in']))
                      {
                        echo "<div style='display:none;'> Comment ID: <input type='text' name='txt_comment_id' value='$comment_id' readonly/></div> <br/>";
                        echo "<div style='display:none;'> Furniture ID: <input type='text' name='txt_furniture_id' value='".$_REQUEST['id']."'/></div> <br/>";

                        echo "<label> Write a comment </label><br/>";
                        echo "<textarea name='txt_comment' placeholder='Write something' style='width: 800px;'></textarea><br/>";
                        echo "<div style='text-align:center;margin-left:-100px;'><input type='submit' name='txt_comment_submit' value='Submit'/></div><br/>";


                        $p_id = $_REQUEST['id'];
                        $sql = "SELECT * from review WHERE F_ID='$p_id'";
                        $result = mysqli_query($connect,$sql);
                        $rows_comment = mysqli_fetch_array($result);

                        $_SESSION['comment'] = $rows_comment;
                        $session_comment = $_SESSION['comment'];

                        if(empty($session_comment))
                        {
                          echo "<div class='no_comment'> No review for this item yet </div>";
                        }
                        else
                        {
                          $query = "SELECT * FROM review WHERE F_ID='$p_id'";
                          $result = mysqli_query($connect,$query);

                          while($rows=mysqli_fetch_array($result))
                          {
                            echo "<div class='comment_wrapper'>";
                              echo "<div class='name'>" . $rows['C_NAME'] . "'s Review :</div><br/>";
                              echo "<div class='comment'>" . $rows['COMMENT'] . "</div><br/><br/>";
                            echo "</div>";
                          }
                        }
                      }
                    echo "</div>";
                  }
                  else if(isset($_REQUEST['pdetail']))
                  {
                    $pdetail = $_REQUEST['pdetail'];

                    $query = "SELECT * FROM furniture WHERE F_ID='$pdetail'";
                    $result = mysqli_query($connect,$query);

                    echo "<div class='' style='height:700px;width:900px;'>";
                      while($rows=mysqli_fetch_array($result))
                        {
                          echo "<div>";
                            ?>
                              <img src="<?php echo $rows['F_IMAGE']; ?>" style="float:left;width:40%;"/>
                            <?php
                          echo "</div>";
                          echo "<table class='product_description'
                          style='
                          width:500px;
                          height:500px;
                          font-size: 20px;
                          line-height: 50px;
                          float:right;
                          padding: 30px;
                          background-color:white;
                          '
                          >";
                            echo "<tr style='display:none;'>";
                              echo "<td style='display:none;'> Furniture ID </td>";
                              echo "<td style='display:none;'><input type='text' name='f_id' value='".$rows['F_ID']."' readonly/></td>";
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Furniture Name </td>";
                              echo "<td><input type='text' name='f_name' value='" . $rows['F_NAME']. "' readonly/></td>" ;
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Price </td>";
                              echo "<td class='add-to-cart'><input type='text' name='f_price' value='" . $rows['F_PRICE'] . "' readonly/></td>";
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Descriptions </td>";
                              echo "<td><textarea name='f_desc' value='' style='font-family:arial;font-size:20px;' readonly>".$rows['F_DESC']." </textarea></td>";
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Avaliable Quantity </td>";
                              echo "<td><input type='text' name='' value='" . $rows['F_QUANTITY'] . "'readonly/></td>";
                            echo "</tr>";
                      }
                            echo "<tr>";
                              echo "<td> Desire Quantity </td>";
                              echo "<td><input type='text' name='f_qty' style='border:1px solid #000;'/></td>";
                            echo "</tr>";
                      echo "</table>";
                      echo "<div style='padding-left:500px;float:left;' class='add-to-cart'>";
                        echo "<input type='submit' name='add-to-cart' class='add-to-cart' value='Add to Cart' style='width:300px;'/></td>";
                      echo "</div>";

                      echo "<div style='clear:both;'></div>";

                      if(isset($_SESSION['log_in']))
                      {
                        echo "<div style='display:none;'> Comment ID: <input type='text' name='txt_comment_id' value='$comment_id' readonly/></div> <br/>";
                        echo "<div style='display:none;'> Furniture ID: <input type='text' name='txt_furniture_id' value='".$_REQUEST['pdetail']."'/></div> <br/>";

                        echo "<label> Write a comment </label><br/>";
                        echo "<textarea name='txt_comment' placeholder='Write something' style='width: 800px;'></textarea><br/>";

                        $_SESSION['pdetail'] = $_REQUEST['pdetail'];
                        $p_detail = $_SESSION['pdetail'];
                        echo "<div style='text-align:center;margin-left:-100px;'><input type='submit' name='txt_comment_submit' value='Submit'/></div><br/>";


                        $sql = "SELECT * from review WHERE F_ID='$p_detail'";
                        $result = mysqli_query($connect,$sql);
                        $rows_comment = mysqli_fetch_array($result);

                        $_SESSION['comment'] = $rows_comment;
                        $session_comment = $_SESSION['comment'];

                        if(empty($session_comment))
                        {
                          echo "<div class='no_comment'> No review for this item yet </div>";
                        }
                        else
                        {
                          $query = "SELECT * FROM review WHERE F_ID='$p_detail'";
                          $result = mysqli_query($connect,$query);

                          while($rows=mysqli_fetch_array($result))
                          {
                            echo "<div class='comment_wrapper'>";
                              echo "<div class='name'>" . $rows['C_NAME'] . "'s Review :</div><br/>";
                              echo "<div class='comment'>" . $rows['COMMENT'] . "</div><br/><br/>";
                            echo "</div>";
                          }
                        }
                      }
                    echo "</div>";
                  }
                  else
                  {
                    ?>
                    <div class="gridview" style="height:500px;">
                      <?php
                        $query = $db_control->runQuery("SELECT * FROM furniture ORDER BY F_ID DESC");
                        if (!empty($query)) {
                            foreach ($query as $key => $value) {
                                ?>
                                <div class="image">
                                  <img src="<?php echo $query[$key]["F_IMAGE"] ; ?>"/>
                                  <div class="product-info">
                                    <div class="product-title"><?php echo $query[$key]["F_NAME"] ; ?></div>

                                  </div>
                                      <div class="add-to-cart">
                                        <div style="padding-bottom: 20px;"><?php echo $query[$key]["F_PRICE"] ; ?> USD</div>
                                          <a href="product_detail.php?pdetail=<?php echo $query[$key]['F_ID']; ?>" class="see_more"> See More </a>
                                          <a href="product_detail.php?pdetail=<?php echo $query[$key]['F_ID']; ?>" class="see_more"> Add to Cart </a>
                                      </div>
                                  </div>
                                  <?php
                                  }
                                }
                              ?>
                      </div>
                      <?php
                  }
              ?>
            </div>
            <?php
          }
          else
          {
            ?>
            <div class="product_description_wrapper" id="product_description_wrapper" style="width:850px;">

              <div class="show_categories_wrapper"><a href="product_detail.php" class="show_categories"> << Show all categories </a></div>
              <?php
                  if(isset($_REQUEST['id']))
                  {
                    $id = $_REQUEST['id'];
                    $query = "SELECT * FROM furniture WHERE F_ID='$id'";
                    $result = mysqli_query($connect,$query);

                    echo "<div style='height:700px;width:1000px;'>";
                      while($rows=mysqli_fetch_array($result))
                        {
                          echo "<div class='image_transform'>";
                            ?>
                              <img src="<?php echo $rows['F_IMAGE']; ?>" style="float:left;width:30%;"/>
                            <?php
                          echo "</div>";
                          echo "<table class='product_description'
                          style=
                          '
                            margin-right:200px;
                          '
                          >";
                            echo "<tr style='display:none;'>";
                              echo "<td style='display:none;'> Furniture ID </td>";
                              echo "<td style='display:none;'><input type='text' name='f_id' value='".$rows['F_ID']."' readonly/></td>";
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Furniture Name </td>";
                              echo "<td><input type='text' name='f_name' value='" . $rows['F_NAME']. "' readonly/></td>" ;
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Price </td>";
                              echo "<td class='add-to-cart'><input type='text' name='f_price' value='" . $rows['F_PRICE'] . "' readonly/></td>";
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Descriptions </td>";
                              echo "<td><textarea name='f_desc' value='' style='font-family:arial;font-size:20px;' readonly>".$rows['F_DESC']." </textarea></td>";
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Avaliable Quantity </td>";
                              echo "<td><input type='text' name='' value='" . $rows['F_QUANTITY'] . "'readonly/></td>";
                            echo "</tr>";
                      }
                            echo "<tr>";
                              echo "<td> Desire Quantity </td>";
                              echo "<td><input type='text' name='f_qty' style='border:1px solid #000;'/></td>";
                            echo "</tr>";
                      echo "</table>";
                      echo "<div style='padding-left:450px;float:left'>";
                        echo "<input type='submit' name='add-to-cart' class='add-to-cart' value='Add to Cart' style='width:300px;'/></td>";
                      echo "</div>";

                      echo "<div style='clear:both;'></div>";

                      if(!isset($_SESSION['log_in']))
                      {
                        echo "<div style='display:none;'> Comment ID: <input type='text' name='txt_comment_id' value='$comment_id' readonly/></div> <br/>";
                        echo "<div style='display:none;'> Furniture ID: <input type='text' name='txt_furniture_id' value='".$_REQUEST['id']."'/></div> <br/>";

                        echo "<div style='text-align:center;font-weight:bold;font-size:20px;background-color:#eee;padding:20px 0;margin-bottom:30px;color:red;width:850px;'><label'> Please log in first to write a comment </label></div>";
                        /*
                        echo "<textarea name='txt_comment' placeholder='Write something' style='width: 800px;'></textarea><br/>";
                        echo "<div style='text-align:center;'><input type='submit' name='txt_comment_submit' value='Submit'/></div><br/>";
                        */

                        $p_id = $_REQUEST['id'];
                        $sql = "SELECT * from review WHERE F_ID='$p_id'";
                        $result = mysqli_query($connect,$sql);
                        $rows_comment = mysqli_fetch_array($result);

                        $_SESSION['comment'] = $rows_comment;
                        $session_comment = $_SESSION['comment'];

                        if(empty($session_comment))
                        {
                          echo "<div class='no_comment'> No review for this item yet </div>";
                        }
                        else
                        {
                          $query = "SELECT * FROM review WHERE F_ID='$p_id'";
                          $result = mysqli_query($connect,$query);

                          while($rows=mysqli_fetch_array($result))
                          {
                            echo "<div class='comment_wrapper'>";
                              echo "<div class='name'>" . $rows['C_NAME'] . "'s Review :</div><br/>";
                              echo "<div class='comment'>" . $rows['COMMENT'] . "</div><br/><br/>";
                            echo "</div>";
                          }
                        }
                      }
                    echo "</div>";
                  }
                  else if(isset($_REQUEST['pdetail']))
                  {
                    $pdetail = $_REQUEST['pdetail'];

                    $query = "SELECT * FROM furniture WHERE F_ID='$pdetail'";
                    $result = mysqli_query($connect,$query);

                    echo "<div class='' style='height:700px;width:900px;'>";
                      while($rows=mysqli_fetch_array($result))
                        {
                          echo "<div>";
                            ?>
                              <img src="<?php echo $rows['F_IMAGE']; ?>" style="float:left;width:40%;"/>
                            <?php
                          echo "</div>";
                          echo "<table class='product_description'
                          style='
                          width:500px;
                          height:500px;
                          font-size: 20px;
                          line-height: 50px;
                          float:right;
                          padding: 30px;
                          background-color:white;
                          '
                          >";
                            echo "<tr style='display:none;'>";
                              echo "<td style='display:none;'> Furniture ID </td>";
                              echo "<td style='display:none;'><input type='text' name='f_id' value='".$rows['F_ID']."' readonly/></td>";
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Furniture Name </td>";
                              echo "<td><input type='text' name='f_name' value='" . $rows['F_NAME']. "' readonly/></td>" ;
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Price </td>";
                              echo "<td class='add-to-cart'><input type='text' name='f_price' value='" . $rows['F_PRICE'] . "' readonly/></td>";
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Descriptions </td>";
                              echo "<td><textarea name='f_desc' value='' style='font-family:arial;font-size:20px;' readonly>".$rows['F_DESC']." </textarea></td>";
                            echo "</tr>";
                            echo "<tr>";
                              echo "<td> Avaliable Quantity </td>";
                              echo "<td><input type='text' name='' value='" . $rows['F_QUANTITY'] . "'readonly/></td>";
                            echo "</tr>";
                      }
                            echo "<tr>";
                              echo "<td> Desire Quantity </td>";
                              echo "<td><input type='text' name='f_qty' style='border:1px solid #000;'/></td>";
                            echo "</tr>";
                      echo "</table>";
                      echo "<div style='padding-left:500px;float:left;' class='add-to-cart'>";
                        echo "<input type='submit' name='add-to-cart' class='add-to-cart' value='Add to Cart' style='width:300px;'/></td>";
                      echo "</div>";

                      echo "<div style='clear:both;'></div>";

                      if(!isset($_SESSION['log_in']))
                      {
                        echo "<div style='display:none;'> Comment ID: <input type='text' name='txt_comment_id' value='$comment_id' readonly/></div> <br/>";
                        echo "<div style='display:none;'> Furniture ID: <input type='text' name='txt_furniture_id' value='".$_REQUEST['pdetail']."'/></div> <br/>";

                        echo "<div style='text-align:center;font-weight:bold;font-size:20px;background-color:#eee;margin-bottom:30px;padding:20px 0;color:red;width:850px;'><label'> Please log in first to write a comment </label></div>";
                        /*
                        echo "<textarea name='txt_comment' placeholder='Write something' style='width: 800px;'></textarea><br/>";
                        echo "<div style='text-align:center;'><input type='submit' name='txt_comment_submit' value='Submit'/></div><br/>";
                        */

                        $p_detail = $_REQUEST['pdetail'];
                        $sql = "SELECT * from review WHERE F_ID='$p_detail'";
                        $result = mysqli_query($connect,$sql);
                        $rows_comment = mysqli_fetch_array($result);

                        $_SESSION['comment'] = $rows_comment;
                        $session_comment = $_SESSION['comment'];

                        if(empty($session_comment))
                        {
                          echo "<div class='no_comment'> No review for this item yet </div>";
                        }
                        else
                        {
                          $query = "SELECT * FROM review WHERE F_ID='$p_detail'";
                          $result = mysqli_query($connect,$query);

                          while($rows=mysqli_fetch_array($result))
                          {
                            echo "<div class='comment_wrapper'>";
                              echo "<div class='name'>" . $rows['C_NAME'] . "'s Review :</div><br/>";
                              echo "<div class='comment'>" . $rows['COMMENT'] . "</div><br/><br/>";
                            echo "</div>";
                          }
                        }
                      }
                    echo "</div>";
                  }
                  else
                  {
                    ?>
                    <div class="gridview" style="height:500px;">
                      <?php
                        $query = $db_control->runQuery("SELECT * FROM furniture ORDER BY F_ID DESC");
                        if (!empty($query)) {
                            foreach ($query as $key => $value) {
                                ?>
                                <div class="image">
                                  <img src="<?php echo $query[$key]["F_IMAGE"] ; ?>"/>
                                  <div class="product-info">
                                    <div class="product-title"><?php echo $query[$key]["F_NAME"] ; ?></div>

                                  </div>
                                      <div class="add-to-cart">
                                        <div style="padding-bottom: 20px;"><?php echo $query[$key]["F_PRICE"] ; ?> USD</div>
                                          <a href="product_detail.php?pdetail=<?php echo $query[$key]['F_ID']; ?>" class="see_more"> See More </a>
                                          <a href="product_detail.php?pdetail=<?php echo $query[$key]['F_ID']; ?>" class="see_more"> Add to Cart </a>
                                      </div>
                                  </div>
                                  <?php
                                  }
                                }
                              ?>
                      </div>
                      <?php
                  }
              ?>
            </div>
            <?php
          }
        ?>
      </div>

      <div style="clear:both;"></div>


      <div class="php_form" id="php-form">
      <?php
      if(isset($_SESSION['user_purchase']))
      {
        $count = count($_SESSION['user_purchase']);
      ?>
        <table border="1" class="cart_table">
          <tr>
            <th style="display:none;"> Furniture ID </th>
            <th> Furniture Name </th>
            <th> Quantity </th>
            <th> Price </th>
            <th> Amount </th>
            <td style="display:none;"></td>
          </tr>

          <?php
            for($i=0; $i<$count; $i++)
            {
              ?>
                <tr>
                  <td style="display:none;"><?php echo $_SESSION['user_purchase'][$i]['id']; ?></td>
                  <td><?php echo $_SESSION['user_purchase'][$i]['name']; ?></td>
                  <td><?php echo $_SESSION['user_purchase'][$i]['qty']; ?></td>
                  <td><?php echo $_SESSION['user_purchase'][$i]['price']; ?></td>
                  <td><?php echo $_SESSION['user_purchase'][$i]['amt']; ?></td>
                  <td style="border-top:0.1px solid #fff;border-right:0.1px solid #fff;border-bottom:0.1px solid #fff;">
                    <?php
                      echo '<a href="product_detail.php?row='.$i.'"
                      class="remove_button_table">'?><img src="./image/remove_btn.png" style="width:30px;"/><?php echo '</a>';
                    ?>
                  </td>
                </tr>
              <?php
            }
          ?>

        </table>
        <div style="text-align:center;">
          <input type="submit" name="btn_checkout" value="CheckOut"/>
        </div>
      <?php
      }
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
        </div>
      </div>
    <!-- Footer End -->

    </form>
  </body>
</html>

<script type="text/javascript" src="./js/jQuery.js"></script>

<script type="text/javascript">
  $(document).ready(function(e)
  {
    $("#product_detail").change(function()
    {

    });
  });
</script>
