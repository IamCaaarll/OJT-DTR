<?php
include ("../database/connection.php");/*Database Connection*/

$time_in_out = $sched_date = $_POST['user_IN_OUT'];
$time_in_out = explode(" - ", $time_in_out);
$date = explode(" ", $time_in_out[0]);
$check_attendance = mysqli_query($conn,"SELECT * FROM log WHERE id ='".$_POST["log_name"]."' AND time_in LIKE '".$date[0]."%' ");

        if(mysqli_num_rows($check_attendance) == 0)
        {
          $t1 = StrToTime (date($time_in_out[1]));
          $t2 = StrToTime (date($time_in_out[0]));
          $diff = $t1 - $t2;
          $hours = $diff / ( 60 * 60 );

          if($hours > 11)
          {
              $hours = 11 - 1;
          }
          else
          {
            if($hours > 5)
            {
              $hours = $hours - 1;
            }
          }

          $insert_log = mysqli_query($conn,"INSERT INTO log(id,time_in,time_out,hours,status)
                                            VALUES('".$_POST["log_name"]."',
                                                   '".$time_in_out[0]."',
                                                   '".$time_in_out[1]."',
                                                   '".$hours."',
                                                   '".$_POST["log_status"]."')");

          $res = mysqli_query($conn,"SELECT sum(hours) FROM log WHERE id = '".$_POST["log_name"]."'");/*Get the Total sum of Rendered Hours of User*/
          $row = mysqli_fetch_row($res);/*Fetch the Total*/
          $sum = $row[0];/*Pass the total to variable*/
          mysqli_query($conn,"UPDATE user SET render_hours = '".$sum."' WHERE id = '".$_POST["log_name"]."'");/*UPDATE Total Hours of User*/

          echo "New Attendance has been added.";
        }
        else
        {
          echo "This Attendance already exist";
        }

?>
