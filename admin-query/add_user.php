<?php
include ("../database/connection.php");/*Database Connection*/

$check_userid = mysqli_query($conn,"SELECT * from user where id ='".$_POST["id"]."'");
        if(mysqli_num_rows($check_userid) == 0)
        {
          mysqli_query($conn,"INSERT INTO user(id,name,password,school,type,designation,required_hours) VALUES('".$_POST["id"]."','".$_POST["name"]."','user@123','".$_POST["school"]."','".$_POST["type"]."','".$_POST["designation"]."','".$_POST["total_hours"]."')");
          echo "New User has been added.";
        }
        else
        {
          echo "This user already exist";
        }
?>
