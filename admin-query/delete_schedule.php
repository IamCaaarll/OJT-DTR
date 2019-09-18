<?php
include ("../database/connection.php");/*Database Connection*/
	$query = "DELETE FROM schedule WHERE id = '".$_POST["id"]."' AND schedule_date ='".$_POST["date"]."'";
	if(mysqli_query($conn, $query))
	{
  	echo "Ojt Schedule has been deleted!";
	}

 ?>
