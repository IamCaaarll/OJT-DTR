<?php
include ("../database/connection.php");
session_start();
$tz = 'Asia/Manila';/*Timezone*/
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp

if($_SESSION["u_ID"] != $_POST["id"] )
{
  echo "Invalid";
}
else
{
  $selectsched = mysqli_query($conn,"SELECT * FROM log WHERE id = '".$_POST["id"]."' AND time_out IS NULL");/*Select query for the Identify the user*/
  if(mysqli_num_rows($selectsched) != 0)
  {
      echo "already";
  }
  else
  {
      mysqli_query($conn,"INSERT INTO log(id) VALUES('".$_POST["id"]."')");

      $selectsched = mysqli_query($conn,"SELECT * FROM schedule WHERE id = '".$_POST["id"]."' AND schedule_date = '".$dt->format("Y-m-d")."'");/*Select query for the Identify the user*/
      if(mysqli_num_rows($selectsched) == 0)
      {
        mysqli_query($conn,"UPDATE log SET status = 'PENDING' where id = '".$_POST["id"]."' AND hours IS null");
      }
      else
      {
        while($row=mysqli_fetch_array($selectsched))
        {
          $time_in = $row["schedule_time_in"];
          $time = strtotime($dt->format("Y-m-d H:i:s"));
          $time = $time - (5 * 60);
          $date = date("Y-m-d H:i:s", $time);
          if(strtotime($time_in) < strtotime($date))
          {
            mysqli_query($conn,"UPDATE log SET status = 'LATE' where id = '".$_POST["id"]."' AND hours IS null");
          }
          else if(strtotime($time_in) > strtotime($date))
          {
              mysqli_query($conn,"UPDATE log SET status = 'ON TIME' where id = '".$_POST["id"]."' AND hours IS null");
          }
        }
      }
                echo "Success";
  }


}

 ?>
