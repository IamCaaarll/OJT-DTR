<?php
include ("../database/connection.php");/*Database Connection*/

  $result = mysqli_query($conn,"SELECT * FROM user where type ='OJT' ORDER BY name");
  while($row = mysqli_fetch_array($result))  /*retrieving Data from*/
  {
    echo '<option value='.$row["id"].'>'.$row["name"].'</option>';
  }
?>
