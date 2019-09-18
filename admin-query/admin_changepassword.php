<?php
include ("../database/connection.php");/*Database Connection*/
session_start();
$check_pass = mysqli_query($conn,"SELECT * FROM user WHERE id ='".$_SESSION["u_ID"]."'");
while($row = mysqli_fetch_array($check_pass))
{
      if($_POST['currentpass'] != $row['password'])
      {
        echo "Current password does not match.";
      }
      else
      {
        if($_POST['pass'] != $_POST['confirmpass'])
        {
          echo "New password does not match.";
        }
        else
        {
          mysqli_query($conn,"UPDATE user SET password = '".$_POST['pass']."' where id = '".$_SESSION['u_ID']."'");
          echo "User password has been updated!";
        }
      }
}



 ?>
