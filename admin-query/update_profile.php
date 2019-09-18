<?php
include ("../database/connection.php");/*Database Connection*/
session_start();
mysqli_query($conn,"UPDATE user set id =  '".$_POST["id"]."',
                                    name = '".$_POST["name"]."',
                                    designation='".$_POST["designation"]."'
                                    WHERE id = '".$_SESSION["u_ID"]."'");
$_SESSION["u_ID"] = $_POST["id"];
echo "User Account has been updated!";
?>
