<?php
  session_start();
  include "auto_id.php";
  $connect = mysqli_connect("localhost","root","","mtk");

  $p_id = autoID("purchase","P_ID","P_",10,"P_0000000001");
  $supplier = "";
  $date = date("Y-m-d");
  $amt = 0;

  if(isset($_SESSION['log_in_admin']))
  {
    $log_in_admin = $_SESSION['log_in_admin'];
  }
  else
  {
    header("location: admin_login.php");
  }

  $new_id = "";
  $new_name = "";
  $new_qty = "";
  $new_price = "";

  $alert_true = "";
  $alert_false = "";
  $alert_update = "";
  $alert_save = "";
  $error = "";

  if(isset($_REQUEST['btn_save']))
  {
    $id = $_REQUEST['txt_id'];
    $supplier = $_REQUEST['txt_supplier'];
    $date = $_REQUEST['dateofpurchase'];
    $amt = $_REQUEST['amt'];

    $query = "INSERT INTO purchase VALUES('$id','$supplier','$date','$amt')";
    mysqli_query($connect,$query);

    if(isset($_SESSION['purchase']))
    {
      $count = count($_SESSION['purchase']);

      for($i=0; $i<$count; $i++)
      {
        $p_id = $_SESSION['purchase'][$i]['id'];
        $p_qty = $_SESSION['purchase'][$i]['qty'];
        $p_price = $_SESSION['purchase'][$i]['price'];
        $query = "INSERT INTO purchase_detail VALUES('$id','$supplier','$date','$p_id','$p_qty','$p_price')";
        mysqli_query($connect,$query);

        $product_quantity = "UPDATE furniture SET F_QUANTITY = F_QUANTITY + '$p_qty' WHERE F_ID = '$p_id'";
        mysqli_query($connect,$product_quantity);
      }
      $alert_save = "Saved Successfully";
    }
      unset($_SESSION['purchase']);
  }

  if(isset($_REQUEST['btn_add']))
  {
    $id = $_REQUEST['f_id'];
    $name = $_REQUEST['f_name'];
    $qty = $_REQUEST['f_qty'];
    $price = $_REQUEST['f_price'];
    $amt = $qty*$price;

    if(empty($id) || empty($name) || empty($qty) || empty($price))
    {
      $alert_false = "Please fill the missing form";
    }
    else
    {
      $alert_true = "Successfully Filled";
    }

    if(!isset($_SESSION['purchase']))
    {
      $_SESSION['purchase'][0]['id'] = $id;
      $_SESSION['purchase'][0]['name'] = $name;
      $_SESSION['purchase'][0]['qty'] = $qty;
      $_SESSION['purchase'][0]['price'] = $price;
      $_SESSION['purchase'][0]['amt'] = $amt;
    }
    else
    {
      $check = true;
      $count = count($_SESSION['purchase']);

      for($j=0; $j<$count; $j++)
      {
        if($id==$_SESSION['purchase'][$j]['id'])
        {
          $check = false;
          $_SESSION['purchase'][$j]['qty'] = $_SESSION['purchase'][$j]['qty'] + $qty;
          $_SESSION['purchase'][$j]['amt'] = $_SESSION['purchase'][$j]['qty'] * $_SESSION['purchase'][$j]['price'];
        }
      }

      if($check == true)
      {
        $_SESSION['purchase'][$count]['id'] = $id;
        $_SESSION['purchase'][$count]['name'] = $name;
        $_SESSION['purchase'][$count]['qty'] = $qty;
        $_SESSION['purchase'][$count]['price'] = $price;
        $_SESSION['purchase'][$count]['amt'] = $amt;
      }
    }
  }

  if(isset($_REQUEST['row']))
  {
    $row = $_REQUEST['row'];

    unset($_SESSION['purchase'][$row]);
    $_SESSION['purchase'] = array_values($_SESSION['purchase']);
  }

  if(isset($_REQUEST['edit']))
  {
    $edit = $_REQUEST['edit'];

    $new_id = $_SESSION['purchase'][$edit]['id'];
    $new_name = $_SESSION['purchase'][$edit]['name'];
    $new_qty = $_SESSION['purchase'][$edit]['qty'];
    $new_price = $_SESSION['purchase'][$edit]['price'];
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="./css/main.css" type="text/css"/>
    <link rel="stylesheet" href="./css/purchase.css" type="text/css"/>
    <link rel="shortcut icon" href="./image/furniture_icon.ico" type="image/x-icon"/>
    <style type="text/css">
    .form_purchase
    {
      width: 100%;
      border-collapse: collapse;
      text-align: center;
      text-transform: uppercase;
      line-height: 50px;
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

    <form action="purchase.php" class="form-purchase" method="post" style="padding-left: 50px;">
        <h1> Purchase </h1>
        <hr style="width: auto;"/>
        <div class="table1">
          <table class="table-content table-content-1">
            <tr>
              <td style="color: green; font-size: 20px;"> <?php echo $alert_save; ?> </td>
            </tr>
            <tr>
              <td style="color: red; font-size: 20px;"> <?php echo $error; ?> </td>
            </tr>
            <tr>
              <td> PurchaseID </td>
              <td> <input type="text" name="txt_id" value="<?php echo $p_id; ?>" readonly/> </td>
            </tr>
            <tr>
              <td> SupplierName </td>
              <td>
                <select id="supplier" class="supplier" name="txt_supplier" style="width: 210px;height: 40px;padding-left:5px;border-radius: 10px;border: 0.5px solid #000;">
                  <option value="" selected="selected"> Choose Supplier Name </option>
                  <?php
                    $sql = "SELECT S_ID,S_NAME FROM supplier";
                    $result = mysqli_query($connect,$sql);

                    while($rows=mysqli_fetch_array($result))
                    {
                      ?>
                      <option value="<?php echo $rows["S_ID"]; ?>">
                        <?php echo $rows["S_NAME"]; ?>
                      </option>
                      <?php
                    }
                      ?>
                </select>
              </td>
            </tr>
            <tr>
              <td> PurchaseDate </td>
              <td> <input type="text" name="dateofpurchase" value="<?php echo $date; ?>" readonly/></td>
            </tr>
            <tr>
              <td> Total Amount </td>
              <td>
                <input type="text" name="amt"
                value=
                "<?php
                  $total = 0;
                  if(isset($_SESSION['purchase']))
                  {
                    $count = count($_SESSION['purchase']);

                    for($i=0; $i<$count; $i++)
                    {
                      $total = $total + $_SESSION['purchase'][$i]['amt'];
                    }
                  }
                  echo $total;
                ?>" readonly/>
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <input type="submit" name="btn_save" value="Save Data"/>
                <input type="reset" name="btn_cancel" value="Cancel"/>
            </tr>
          </table>
        </div>
        <div class="table2">
          <h3> Furniture Information </h3>
          <div class="select" style="padding-right:30px;">
            Name <br/>
            <select id="furniture" size="20" style="width: 240px;height:400px;padding: 10px; border-radius: 10px;border:1px solid #000;font-size:13px;text-transform:uppercase;">
              <option value="" selected="selected" style="padding:10px 20px;"> Choose Furniture Type </option>
              <?php
                $sql = "SELECT F_ID,F_NAME,F_PRICE FROM furniture";
                $result = mysqli_query($connect,$sql);

                while($rows=mysqli_fetch_array($result))
                {
                  ?>
                  <option value="<?php echo $rows["F_ID"];?>&<?php  echo $rows["F_NAME"];?>&<?php echo $rows['F_PRICE']; ?>" style="padding:10px 20px;">
                    <?php echo $rows["F_NAME"]; ?>
                  </option>
                  <?php
                }
                  ?>
            </select>
          </div>
          <div class="furniture-information" onclick="furniture-information">
            <table class="table-content table-content-2" style="text-transform:uppercase;">
              <tr class="alert_box">
                <td class="alert_text" style="color: red;text-align:center;"><?php echo $alert_false;?></td>
              </tr>
              <tr class="alert_box">
                <td class="alert_text" style="color: green;text-align:center;"><?php echo $alert_true; ?></td>
              </tr>
              <tr class="alert_box">
                <td class="alert_text" style="color: blue;text-align:center"><?php echo $alert_update; ?></td>
              </tr>
              <tr>
                <td>
                  FurnitureID <br/>
                  <input type="text" name="f_id" id='furnitureid' value="<?php echo $new_id; ?>" readonly/>
                </td>
              </tr>
              <tr>
                <td>
                  Furniture <br/>
                  <input type="text" name="f_name" id='furniturename' style="text-transform: uppercase;" value="<?php echo $new_name; ?>" readonly;/>
                </td>
              </tr>
              <tr>
                <td>
                   Quantity <br/>
                   <input type="number" name="f_qty" value="<?php echo $new_qty; ?>"/>
                 </td>
              </tr>
              <tr>
                <td>
                  Price Per 1 <br/>
                  <input type="text" name="f_price" id="furnitureprice" value="<?php echo $new_price; ?>" readonly/>
                </td>
              </tr>
              <tr>
                <td><input type="submit" name="btn_add" id="btn_add" value="Add"/></td>
              </tr>
            </table>
          </div>

          <div class="php-form" id="php-form" style="padding:50px 0;">
            <?php
              if(isset($_SESSION['purchase']))
              {
                $count = count($_SESSION['purchase']);
                 echo "<table border='1' class='form_purchase'>";
                   echo "<tr>";
                   echo "<th> Furniture ID </th>";
                   echo "<th> Furniture Name </th>";
                   echo "<th> Quantity </th>";
                   echo "<th> Price </th>";
                   echo "<th> Amount </th>";
                   echo "<td style='display:none;'></td>";
                   echo "<td style='display:none;'></td>";
                   echo  "</tr>";

                   for($i=0; $i<$count; $i++)
                   {
                     echo "<tr>";
                       echo "<td>" . $_SESSION['purchase'][$i]['id'] . "</td>";
                       echo "<td>" . $_SESSION['purchase'][$i]['name'] . "</td>";
                       echo "<td>" . $_SESSION['purchase'][$i]['qty'] . "</td>";
                       echo "<td>" . $_SESSION['purchase'][$i]['price'] . "</td>";
                       echo "<td>" . $_SESSION['purchase'][$i]['amt'] . "</td>";
                       echo "<td style='border-top:0.1px solid #fff;border-right:0.1px solid #fff;border-bottom:0.1px solid #fff;'>";
                         echo '<a href="purchase.php?edit='.$i.'">'?> <img src="./image/edit_icon.png" style="width:30px;"/><?php echo '</a>';
                       echo "</td>";
                       echo "<td style='border-top:0.1px solid #fff;border-right:0.1px solid #fff;border-bottom:0.1px solid #fff;'>";
                         echo '<a href="purchase.php?row='.$i.'">'?> <img src="./image/remove_icon.png" style="width:30px;"/><?php echo '</a>';
                       echo "</td>";
                     echo "</tr>";
                     }
                 echo "</table>";
               }
               ?>
            </div>
      </form>

      <div style="clear:both;"></div>

  </body>
</html>


<script type="text/javascript" src="./js/jQuery.js"></script>

<script type="text/javascript">
  $(document).ready(function(e)
{
  $("#furniture").click(function()
  {
    var data=$("#furniture").val();
    var tmp=data.split("&");
    $('#furnitureid').val(tmp[0]);
    $('#furniturename').val(tmp[1]);
    $('#furnitureprice').val(tmp[2]);
  });
//
//   $("#btn_add").click(function()
//   {
//     $.ajax({
//         type:'POST',
//         url:'ajax_for_purchase.php',
//         data:'btn=btn',
//         success:function(msg)
//         {
//           $("#php-form").html(msg);
//         }
//       });
//   });
});
</script>
