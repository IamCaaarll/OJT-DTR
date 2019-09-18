<?php
include ("../database/connection.php");/*Database Connection*/
	$query = "DELETE FROM log WHERE rowid = '".$_POST["rowid"]."'";
	if(mysqli_query($conn, $query))
	{
		echo 'Ojt Attendance has been deleted!';
	}
	$res = mysqli_query($conn,"SELECT sum(hours) FROM log WHERE id = '".$_POST["id"]."'");
	$row = mysqli_fetch_row($res);
	$sum = $row[0];
 mysqli_query($conn,"UPDATE user SET render_hours = '".$sum."' where id = '".$_POST["id"]."'");
 ?>
