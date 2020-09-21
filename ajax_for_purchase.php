<?php
  session_start();
  if(isset($_REQUEST['btn']))
  {
    /*
    if(isset($_SESSION['purchase']))
    {
      $count = count($_SESSION['purchase']);
       echo "<table border='1'>";
         echo "<tr>";
         echo "<td></td>";
         echo "<td></td>";
         echo "<th> Furniture ID </th>";
         echo "<th> Furniture Name </th>";
         echo "<th> Quantity </th>";
         echo "<th> Price </th>";
         echo "<th> Amount </th>";
         echo "</tr>";

         for($i=0; $i<$count; $i++)
         {
           echo "<tr>";
             echo "<td>";
               echo '<a href="purchase.php?row='.$i.'"> Remove </a>';
             echo "</td>";
             echo "<td>";
               echo '<a href="purchase.php?edit='.$i.'"> Edit </a>';
             echo "</td>";
             echo "<td>" . $_SESSION['purchase'][$i]['id'] . "</td>";
             echo "<td>" . $_SESSION['purchase'][$i]['name'] . "</td>";
             echo "<td>" . $_SESSION['purchase'][$i]['qty'] . "</td>";
             echo "<td>" . $_SESSION['purchase'][$i]['price'] . "</td>";
             echo "<td>" . $_SESSION['purchase'][$i]['amt'] . "</td>";
           echo "</tr>";
          }
       echo "</table>";
    }
    */
    echo "Hello";
  }
?>
