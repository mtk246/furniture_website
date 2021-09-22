<?php
  session_start();

  $connect = mysqli_connect("localhost","root","","mtk");


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    <link href="./css/track_order.css" type="text/css" rel="stylesheet"/>
  </head>
  <body>
    <form action="track_order.php" method="post">
      <div class="table_wrapper">
        <table>
          <tr>
            <td> Enter Voucher ID </td>
            <td><input type="text" name="v_id" class="input_text"/></td>
          </tr>
        </table>
        <div><input type="submit" name="btn_submit" value="Check"/></div>
      </div>

      <div class="track_order_table_wrapper">
        <table>
          <tr>
            <td>
              <?php
                if(isset($_REQUEST['btn_submit']))
                {
                  if(isset($_REQUEST['v_id']))
                  {
                    $v_id = $_REQUEST['v_id'];
                    $query = "SELECT * FROM delivery_status WHERE V_ID='$v_id'";
                    $result = mysqli_query($connect,$query);

                    while($rows=mysqli_fetch_array($result))
                    {
                      echo $rows['V_ID'];
                      echo $rows['D_AGENT_ID'];
                    }
                  }
                }
              ?>
          </tr>
        </table>
      </div>
    </form>
  </body>
</html>
