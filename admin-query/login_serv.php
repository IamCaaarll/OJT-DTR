<?php
include ("../database/connection.php");/*Database Connection*/

session_start();
$_SESSION['u_ID'] = $_POST['login_ID'];
$query = mysqli_query($conn,"SELECT type FROM user WHERE id = '".$_POST['login_ID']."' AND password = '".$_POST['login_pass']."'");/*Select Query*/
if(mysqli_num_rows($query) == 0)
{
  echo "Invalid";
}
else
{
  while($row = mysqli_fetch_array($query))
  {
      if($row['type'] == "ADMIN")
      {
        $_SESSION['session_page'] = "1";
        echo "1";
      }
      else
      {
        $_SESSION['session_page'] = "2";
          echo "2";
      }
    }
}


 ?>
