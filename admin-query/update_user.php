<?php
include ("../database/connection.php");/*Database Connection*/
session_start();
mysqli_query($conn,"UPDATE user set id = '".$_POST["id"]."',
                                    name = '".$_POST["name"]."',
                                    password = '".$_POST["password"]."',
                                    school='".$_POST["school"]."',
                                    type='".$_POST["type"]."',
                                    designation='".$_POST["designation"]."',
                                    required_hours='".$_POST["total_hours"]."' WHERE id = '".$_POST["prev_id"]."'");
echo "User Account has been updated!";
?>
