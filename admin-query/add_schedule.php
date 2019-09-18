<?php
include ("../database/connection.php");/*Database Connection*/
  $scheddate = $_POST['user_IN_OUT'];
  $timedate = explode(" - ", $scheddate);
   $date = explode(" ", $timedate[0]);
    $select_row = mysqli_query($conn,"SELECT rowid FROM log WHERE id = '".$_POST["log_name"]."' AND time_in like '".$date[0]."%'");/*CHECK*/
    if(mysqli_num_rows($select_row) == 0)
    {
      $check_sched = mysqli_query($conn,"SELECT schedule_date from schedule where id ='".$_POST["log_name"]."' and schedule_date ='".$date[0]."'");
        if(mysqli_num_rows($check_sched) == 0)
        {
          mysqli_query($conn,"INSERT INTO schedule(id,schedule_date,schedule_time_in,schedule_time_out)
          VALUES('".$_POST["log_name"]."','".$date[0]."','".$timedate[0]."','".$timedate[1]."')");

            echo "New Schedule has been added.";
        }
        else
        {
            echo "This Schedule already exist";
        }
    }
    else
    {
      $select_row_id = mysqli_query($conn,"SELECT rowid FROM log WHERE id = '".$_POST["log_name"]."' AND time_in like '".$date[0]."%'");/*Select the RowID in Logs*/
      while($row_select = mysqli_fetch_array($select_row_id))
      {

        $rowid = $row_select["rowid"];/*Get the RowID*/
        $select_log = mysqli_query($conn,"SELECT * FROM log WHERE rowid = '".$rowid."'");/*Select * Logs*/
        while($row_log = mysqli_fetch_array($select_log))
        {
            $log_time_out = $row_log["time_out"];
            $log_time_in = $row_log["time_in"];

            $sched_time = $_POST["user_IN_OUT"]; /*New User Schedule*/
            $sched_time = explode(" - ", $sched_time); /*Get the New Schedule Time IN*/

            $time = strtotime($log_time_in);
            $time = $time - (10 * 60);
            $date = date("Y-m-d H:i:s", $time);

          if($log_time_out == null)
          {
            if(strtotime($date) > strtotime($sched_time[0]))
            {

              mysqli_query($conn,"UPDATE log SET status = 'LATE' where rowid = '".$rowid."'");
            }
            else
            {
               mysqli_query($conn,"UPDATE log SET status = 'ON TIME' where rowid = '".$rowid."'");
            }
          }
          else
          {
            if(strtotime($date) > strtotime($sched_time[0]))/*If the old TIme in is Greater than or equal to new Schedule*/
            {
                  mysqli_query($conn,"UPDATE log SET status = 'LATE' WHERE rowid = '".$rowid."'"); /*UPDATE Hours in Log*/
            }
            else
            {
                 mysqli_query($conn,"UPDATE log SET status = 'ON TIME' WHERE rowid = '".$rowid."'"); /*UPDATE Hours in Log*/
            }

            $t1 = StrToTime (date($log_time_out));
            $t2 = StrToTime (date($log_time_in));
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
             mysqli_query($conn,"UPDATE log SET hours = '".$hours."' WHERE rowid = '".$rowid."'"); /*UPDATE Hours in Log*/
            $res = mysqli_query($conn,"SELECT sum(hours) FROM log WHERE id ='".$_POST["log_name"]."' AND status IN ('ON TIME','LATE')");
            $row = mysqli_fetch_row($res);
            $sum = $row[0];
            mysqli_query($conn,"UPDATE user SET render_hours = '".$sum."' where id = '".$_POST["log_name"]."'");
          }
      }
    }
      $scheddate = $_POST['user_IN_OUT'];
      $timedate = explode(" - ", $scheddate);
       $date = explode(" ", $timedate[0]);
      mysqli_query($conn,"INSERT INTO schedule(id,schedule_date,schedule_time_in,schedule_time_out)
      VALUES('".$_POST["log_name"]."','".$date[0]."','".$timedate[0]."','".$timedate[1]."')");

        echo "New Schedule has been added.";
    }
?>
