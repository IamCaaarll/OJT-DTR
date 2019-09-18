<?php
include ("../database/connection.php");/*Database Connection*/
	mysqli_query($conn,"DELETE FROM user WHERE id = '".$_POST["id"]."'");
	mysqli_query($conn,"DELETE FROM schedule WHERE id = '".$_POST["id"]."'");
	mysqli_query($conn,"DELETE FROM log WHERE id = '".$_POST["id"]."'");
	echo "Ojt information has been deleted!";
	?>
