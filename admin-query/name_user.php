<?php
include ("../database/connection.php");/*Database Connection*/
session_start();
$query = mysqli_query($conn,"SELECT * FROM user WHERE id = '".$_SESSION["u_ID"]."'");/*Select Query*/
while($row = mysqli_fetch_array($query))
{
$name = $row['name'];
}
echo $name;
 ?>
