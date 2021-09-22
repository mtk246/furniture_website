<?php
  session_start();
  $connect = mysqli_connect("localhost","root","","mtk");

  $report = "";
  $error = "";

  if(isset($_SESSION['log_in_admin']))
  {
    $log_in_admin = $_SESSION['log_in_admin'];
  }
  else
  {
    header("location: admin_login.php");
  }

  if(isset($_REQUEST['submit']))
  {
    if(isset($_REQUEST['report']))
    {
      $report = $_REQUEST['report'];
    }
    else
    {
      $error = "Please choose first !!!";
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    <link href="./css/report.css" type="text/css" rel="stylesheet"/>

    <style type="text/css">

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

    <form action='report.php' method='post'>
      <div class="error_msg"><?php echo $error; ?></div>
      <table class="report_form">
        <tr style="display:none;">
          <td></td>
          <td><input type="text" name="report_type" value="<?php echo $report; ?>"/></td>
        </tr>
        <tr>
          <td> Report type </td>
          <td>
            <select name="report" class="report" required>
              <option selected='selected' disabled> Choose report type </option>
              <option name="purchase_history" value="purchase_history"> Purchase history </option>
              <option name="order_history" value="order_history"> Order history </option>
              <option name="total_sales" value="total_sales"> Total Sales </option>
            </select>
          </td>
        </tr>
        <tr>
          <td> Start Date </td>
          <td> <input type="date" name="start_date"/> </td>
        </tr>
        <tr>
          <td> End Date </td>
          <td> <input type="date" name="end_date"/> </td>
        </tr>
      </table>
      <div>
        <div class="txt_search"><input type="text" class="search" name="search"/></div>
        <div class="btn_submit"><input type="submit" name="submit" value="Search"/></div>
      </div>
    </form>

    <div>
      <?php
        if(isset($_REQUEST['submit']))
        {
          $start_date = $_REQUEST['start_date'];
          $end_date = $_REQUEST['end_date'];
          $search = $_REQUEST['search'];

          if($report=="purchase_history")
          {
            if(empty($search) && empty($start_date) && empty($end_date))
            {
              $query = "SELECT * FROM purchase_detail ORDER BY P_DATE";
              $result = mysqli_query($connect,$query);
              ?>
              <table border="1" class="table_list">
                <tr>
                  <th> Date </th>
                  <th> Furniture ID </th>
                  <th> Quantity </th>
                  <th> Price </th>
                </tr>

                <tr>
                  <?php
                    while($rows=mysqli_fetch_array($result))
                    {
                      echo "<td>" .$rows['P_DATE']. "</td>";
                      echo "<td>" .$rows['F_ID']. "</td>";
                      echo "<td>" .$rows['QUANTITY']. "</td>";
                      echo "<td>" .$rows['PRICE']. "</td>";
                      echo "</tr>";
                    }
                  ?>
              </table>
              <?php
            }
            else if(empty($search))
            {
              $query = "SELECT * FROM purchase_detail WHERE P_DATE BETWEEN '$start_date' AND '$end_date' ORDER BY P_DATE";
              $result = mysqli_query($connect,$query);

              ?>
              <table border="1" class="table_list">
                <tr>
                  <th> Date </th>
                  <th> Furniture ID </th>
                  <th> Quantity </th>
                  <th> Price </th>
                </tr>

                <tr>
                  <?php
                    while($rows=mysqli_fetch_array($result))
                    {
                      echo "<td>" .$rows['P_DATE']. "</td>";
                      echo "<td>" .$rows['F_ID']. "</td>";
                      echo "<td>" .$rows['QUANTITY']. "</td>";
                      echo "<td>" .$rows['PRICE']. "</td>";
                      echo "</tr>";
                    }
                  ?>
              </table>
              <?php
            }
            else if(empty($start_date) && empty($end_date))
            {
              $query = "SELECT * FROM purchase_detail WHERE F_ID='$search' ORDER BY P_DATE";
              $result = mysqli_query($connect,$query);

              ?>
              <table border="1" class="table_list">
                <tr>
                  <th> Date </th>
                  <th> Furniture ID </th>
                  <th> Quantity </th>
                  <th> Price </th>
                </tr>

                <tr>
                  <?php
                    while($rows=mysqli_fetch_array($result))
                    {
                      echo "<td>" .$rows['P_DATE']. "</td>";
                      echo "<td>" .$rows['F_ID']. "</td>";
                      echo "<td>" .$rows['QUANTITY']. "</td>";
                      echo "<td>" .$rows['PRICE']. "</td>";
                      echo "</tr>";
                    }
                  ?>
              </table>
              <?php
            }
            else
            {
              $query = "SELECT * FROM purchase_detail WHERE (P_DATE BETWEEN '$start_date' AND '$end_date') AND (P_ID='$search' OR S_ID='$search' OR P_DATE='$search' OR F_ID='$search') ORDER BY P_DATE";
              $result = mysqli_query($connect,$query);

              ?>
              <table border="1" class="table_list">
                <tr>
                  <th> Date </th>
                  <th> Furniture ID </th>
                  <th> Quantity </th>
                  <th> Price </th>
                </tr>

                <tr>
                  <?php
                    while($rows=mysqli_fetch_array($result))
                    {
                      echo "<td>" .$rows['P_DATE']. "</td>";
                      echo "<td>" .$rows['F_ID']. "</td>";
                      echo "<td>" .$rows['QUANTITY']. "</td>";
                      echo "<td>" .$rows['PRICE']. "</td>";
                      echo "</tr>";
                    }
                  ?>
              </table>
              <?php
            }
          }
          elseif($report=="order_history")
          {
            if(empty($search) && empty($start_date) && empty($end_date))
            {
              $query = "SELECT * FROM user_final_purchase ORDER BY P_DATE,F_ID";
              $result = mysqli_query($connect,$query);
              ?>
              <table border="1" class="table_list">
                <tr>
                  <td> Date </td>
                  <td> Furniture ID </td>
                  <td> Quantity </td>
                  <td> Price </td>
                  <td> Status </td>
                </tr>

                <tr>
                  <?php
                    while($rows=mysqli_fetch_array($result))
                    {
                      echo "<td>" .$rows['P_DATE']. "</td>";
                      echo "<td>" .$rows['F_ID']. "</td>";
                      echo "<td>" .$rows['QUANTITY']. "</td>";
                      echo "<td>" .$rows['F_PRICE']. "</td>";
                      echo "<td>" .$rows['STATUS']. "</td>";
                      echo "</tr>";
                    }
                  ?>
              </table>
              <?php
            }
            else if(empty($search))
            {
              $query = "SELECT * FROM user_final_purchase WHERE P_DATE BETWEEN '$start_date' AND '$end_date' ORDER BY P_DATE,F_ID";
              $result = mysqli_query($connect,$query);

              ?>
              <table border="1" class="table_list">
                <tr>
                  <td> Date </td>
                  <td> Furniture ID </td>
                  <td> Quantity </td>
                  <td> Price </td>
                  <td> Status </td>
                </tr>

                <tr>
                  <?php
                    while($rows=mysqli_fetch_array($result))
                    {
                      echo "<td>" .$rows['P_DATE']. "</td>";
                      echo "<td>" .$rows['F_ID']. "</td>";
                      echo "<td>" .$rows['QUANTITY']. "</td>";
                      echo "<td>" .$rows['F_PRICE']. "</td>";
                      echo "<td>" .$rows['STATUS']. "</td>";
                      echo "</tr>";
                    }
                  ?>
              </table>
              <?php
            }
            else if(empty($start_date) && empty($end_date))
            {
              $query = "SELECT * FROM user_final_purchase WHERE F_ID='$search' ORDER BY P_DATE,F_ID";
              $result = mysqli_query($connect,$query);

              ?>
              <table border="1" class="table_list">
                <tr>
                  <th> Date </th>
                  <th> Furniture ID </th>
                  <th> Quantity </th>
                  <th> Price </th>
                </tr>

                <tr>
                  <?php
                    while($rows=mysqli_fetch_array($result))
                    {
                      echo "<td>" .$rows['P_DATE']. "</td>";
                      echo "<td>" .$rows['F_ID']. "</td>";
                      echo "<td>" .$rows['QUANTITY']. "</td>";
                      echo "<td>" .$rows['F_PRICE']. "</td>";
                      echo "</tr>";
                    }
                  ?>
              </table>
              <?php
            }
            else
            {
              $query = "SELECT * FROM user_final_purchase WHERE (P_DATE BETWEEN '$start_date' AND '$end_date') AND (F_ID='$search' OR C_ID='$search' OR P_DATE='$search') ORDER BY P_DATE,F_ID";
              $result = mysqli_query($connect,$query);

              ?>
              <table border="1" class="table_list">
                <tr>
                  <th> Date </th>
                  <th> Furniture ID </th>
                  <th> Quantity </th>
                  <th> Price </th>
                </tr>

                <tr>
                  <?php
                    while($rows=mysqli_fetch_array($result))
                    {
                      echo "<td>" .$rows['P_DATE']. "</td>";
                      echo "<td>" .$rows['F_ID']. "</td>";
                      echo "<td>" .$rows['QUANTITY']. "</td>";
                      echo "<td>" .$rows['F_PRICE']. "</td>";
                      echo "</tr>";
                    }
                  ?>
              </table>
              <?php
            }
          }
          elseif($report=="total_sales")
          {
            if(empty($search) && empty($start_date) && empty($end_date))
            {
              $sql_group = "SELECT F_ID,date_format(P_DATE,'%M') AS MONTH,SUM(QUANTITY) AS TOTAL_QUANTITY,SUM(F_PRICE*QUANTITY) AS TOTAL_AMOUNT FROM user_final_purchase
              GROUP BY F_ID,MONTH
              ORDER BY MONTH";
              $sql_group_result = mysqli_query($connect,$sql_group);
              ?>
              <table border="1" class="table_list">
                <tr>
                  <th> Month </th>
                  <th> Furniture ID </th>
                  <th> Furniture Name </th>
                  <th> Quantity </th>
                  <th> Amount </th>
                </tr>

                <tr>
                  <?php
                    while($sql_group_rows=mysqli_fetch_array($sql_group_result))
                    {
                      $sql_fid = $sql_group_rows['F_ID'];
                      $sql_amount = $sql_group_rows['TOTAL_AMOUNT'];
                      $sql_quantity = $sql_group_rows['TOTAL_QUANTITY'];
                      $sql_month = $sql_group_rows['MONTH'];

                      $query = "SELECT * FROM furniture WHERE F_ID='$sql_fid'";
                      $result = mysqli_query($connect,$query);

                      while($rows=mysqli_fetch_array($result))
                      {
                        $f_name = $rows['F_NAME'];
                      }

                      echo "<td>" .$sql_month. "</td>";
                      echo "<td>" .$sql_fid. "</td>";
                      echo "<td>" .$f_name. "</td>";
                      echo "<td>" .$sql_quantity. "</td>";
                      echo "<td>" .$sql_amount. "</td>";
                      echo "</tr>";
                    }
                  ?>
              </table>
              <?php
            }
            else if(empty($search))
            {
              $query = "SELECT F_ID,date_format(P_DATE,'%M') AS MONTH,SUM(QUANTITY*F_PRICE) AS TOTAL_AMOUNT,SUM(QUANTITY) AS TOTAL_QUANTITY FROM user_final_purchase WHERE P_DATE BETWEEN '$start_date' AND '$end_date' GROUP BY F_ID,MONTH ORDER BY MONTH";
              $result = mysqli_query($connect,$query);

              ?>
              <table border="1" class="table_list">
                <tr>
                  <th> Month </th>
                  <th> Furniture ID </th>
                  <th> Furniture Name </th>
                  <th> Quantity </th>
                  <th> Amount </th>
                </tr>

                <tr>
                  <?php
                    while($rows=mysqli_fetch_array($result))
                    {
                      $sql_fid = $rows['F_ID'];
                      $sql_amount = $rows['TOTAL_AMOUNT'];
                      $sql_quantity = $rows['TOTAL_QUANTITY'];
                      $sql_month = $rows['MONTH'];

                      $sql2 = "SELECT * FROM furniture WHERE F_ID='$sql_fid'";
                      $sql_result = mysqli_query($connect,$sql2);

                      while($sql_rows=mysqli_fetch_array($sql_result))
                      {
                        $f_name = $sql_rows['F_NAME'];
                      }

                      echo "<td>" . $sql_month. "</td>";
                      echo "<td>" .$sql_fid. "</td>";
                      echo "<td>" .$f_name. "</td>";
                      echo "<td>" .$sql_quantity. "</td>";
                      echo "<td>" .$sql_amount. "</td>";
                      echo "</tr>";
                    }
                  ?>
              </table>
              <?php
            }
            else if(empty($start_date) && empty($end_date))
            {
              $query = "SELECT F_ID,date_format(P_DATE,'%M') AS MONTH,SUM(QUANTITY) AS TOTAL_QUANTITY,SUM(F_PRICE*QUANTITY) AS TOTAL_AMOUNT FROM user_final_purchase WHERE F_ID='$search' GROUP BY F_ID,MONTH ORDER BY MONTH";
              $result = mysqli_query($connect,$query);

              ?>
              <table border="1" class="table_list">
                <tr>
                  <th> Month </th>
                  <th> Furniture ID </th>
                  <th> Furniture Name </th>
                  <th> Quantity </th>
                  <th> Price </th>
                </tr>

                <tr>
                  <?php
                  while($rows=mysqli_fetch_array($result))
                  {
                    $sql_fid = $rows['F_ID'];
                    $sql_amount = $rows['TOTAL_AMOUNT'];
                    $sql_quantity = $rows['TOTAL_QUANTITY'];
                    $sql_month = $rows['MONTH'];

                    $sql2 = "SELECT * FROM furniture WHERE F_ID='$sql_fid'";
                    $sql_result = mysqli_query($connect,$sql2);

                    while($sql_rows=mysqli_fetch_array($sql_result))
                    {
                      $f_name = $sql_rows['F_NAME'];
                    }

                    echo "<td>" . $sql_month. "</td>";
                    echo "<td>" .$sql_fid. "</td>";
                    echo "<td>" .$f_name. "</td>";
                    echo "<td>" .$sql_quantity. "</td>";
                    echo "<td>" .$sql_amount. "</td>";
                    echo "</tr>";
                  }
                  ?>
              </table>
              <?php
            }
            else
            {
              $query = "SELECT F_ID,date_format(P_DATE,'%M') AS MONTH,SUM(QUANTITY) AS TOTAL_QUANTITY,SUM(F_PRICE*QUANTITY) AS TOTAL_AMOUNT FROM user_final_purchase
              WHERE (P_DATE BETWEEN '$start_date' AND '$end_date') AND (F_ID='$search')
              GROUP BY F_ID,MONTH
              ORDER BY MONTH";
              $result = mysqli_query($connect,$query);

              ?>
              <table border="1" class="table_list">
                <tr>
                  <th> Date </th>
                  <th> Furniture ID </th>
                  <th> Furniture Name </th>
                  <th> Quantity </th>
                  <th> Price </th>
                </tr>

                <tr>
                  <?php
                  while($rows=mysqli_fetch_array($result))
                  {
                    $sql_fid = $rows['F_ID'];
                    $sql_amount = $rows['TOTAL_AMOUNT'];
                    $sql_quantity = $rows['TOTAL_QUANTITY'];
                    $sql_month = $rows['MONTH'];

                    $sql2 = "SELECT * FROM furniture WHERE F_ID='$sql_fid'";
                    $sql_result = mysqli_query($connect,$sql2);

                    while($sql_rows=mysqli_fetch_array($sql_result))
                    {
                      $f_name = $sql_rows['F_NAME'];
                    }

                    echo "<td>" . $sql_month. "</td>";
                    echo "<td>" .$sql_fid. "</td>";
                    echo "<td>" .$f_name. "</td>";
                    echo "<td>" .$sql_quantity. "</td>";
                    echo "<td>" .$sql_amount. "</td>";
                    echo "</tr>";
                  }
                  ?>
              </table>
              <?php
            }
          }
        }
      ?>
    </div>
  </body>
</html>
