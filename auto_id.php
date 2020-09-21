<?php
  function autoID($table,$columnname,$prefix,$numberofzero,$startid)
  {
    $connect = mysqli_connect("localhost","root","","mtk");
    $sql = "SELECT * FROM $table ORDER BY $columnname DESC";
    $result = mysqli_query($connect,$sql);

    if(mysqli_num_rows($result)>0)
    {
      $data = mysqli_fetch_array($result);
      $id = $data["$columnname"];
      $id = str_replace($prefix,"",$id);
      $id = (int)$id;
      $id = $id+1;
      $id = str_pad($id,$numberofzero,"0", STR_PAD_LEFT);
      $id = $prefix.$id;
      return $id;
    }
    else {
      return $startid;
    }
  }
?>
