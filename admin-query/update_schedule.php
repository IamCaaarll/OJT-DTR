<?php
include ("../database/connection.php");/*Database Connection*/
  $old_time_in = $_POST['time_in']; /*OLD TIME IN*/
  $old_time_in = explode(" ", $old_time_in);/*Get the Date of Time In*/

  $select_row = mysqli_query($conn,"SELECT rowid FROM log WHERE id = (SELECT id FROM user WHERE name = '".$_POST["user_name"]."' ) AND time_in like '".$old_time_in[0]."%'");/*CHECK*/
  if(mysqli_num_rows($select_row) == 0)/*If the user is not exist in logs table */
  {
    $new_time_sched = $_POST["user_schedule"]; /*OLD TIME IN*/
    $new_time_sched = explode(" - ", $new_time_sched);/*Get the Date of Time In*/
    $date = explode(" ", $new_time_sched[0]);

    mysqli_query($conn,"UPDATE schedule set
                                        schedule_date = '".$date[0]."',
                                        schedule_time_in = '".$new_time_sched[0]."',
                                        schedule_time_out = '".$new_time_sched[1]."'
                                        WHERE id =(SELECT id FROM user WHERE name = '".$_POST["user_name"]."') AND schedule_date = '".$old_time_in[0]."'");
                                        echo "Schedule Updated";
  }
  else
  {

    $select_row_id = mysqli_query($conn,"SELECT rowid FROM log WHERE id = (SELECT id FROM user WHERE name = '".$_POST["user_name"]."' ) AND time_in like '".$old_time_in[0]."%'");/*Select the RowID in Logs*/
    while($row_select = mysqli_fetch_array($select_row_id))
    {
      $rowid = $row_select["rowid"];/*Get the RowID*/
      $select_log = mysqli_query($conn,"SELECT * FROM log WHERE rowid = '".$rowid."'");/*Select * Logs*/
      while($row_log = mysqli_fetch_array($select_log))
      {
        $new_sched_time = $_POST["user_schedule"]; /*New User Schedule*/
        $new_sched_time = explode(" - ", $new_sched_time); /*Get the New Schedule Time IN*/

        $old_time_out = $row_log["time_out"]; /*Get The Old TIme Out*/
        $old_time_in = $row_log["time_in"];/*Get The Old TIme In*/

        $time = strtotime($old_time_in);
        $time = $time - (10 * 60);
        $date = date("Y-m-d H:i:s", $time);

        if($old_time_out == null)
        {
          if(strtotime($date) > strtotime($new_sched_time[0]))
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
          /*Check if the User IS LATE or ON TIME*/
        if(strtotime($date) > strtotime($new_sched_time[0]))/*If the old TIme in is Greater than or equal to new Schedule*/
        {
          mysqli_query($conn,"UPDATE log SET status ='LATE' WHERE rowid = '".$rowid."'"); /*UPDATE Hours in Log*/
        }
        else
        {
        mysqli_query($conn,"UPDATE log SET status ='ON TIME' WHERE rowid = '".$rowid."'"); /*UPDATE Hours in Log*/
        }
        $t1 = StrToTime (date($old_time_out));
        $t2 = StrToTime (date($old_time_in));
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
        mysqli_query($conn,"UPDATE log SET hours = '".$hours."' WHERE rowid = '".$rowid."'");
        $res = mysqli_query($conn,"SELECT sum(hours) FROM log WHERE id =  (SELECT id FROM user WHERE name = '".$_POST["user_name"]."' )");/*Get the Total sum of Rendered Hours of User*/
        $row = mysqli_fetch_row($res);/*Fetch the Total*/
        $sum = $row[0];/*Pass the total to variable*/
        mysqli_query($conn,"UPDATE user SET render_hours = '".$sum."' WHERE id =  (SELECT id FROM user WHERE name = '".$_POST["user_name"]."' )");/*UPDATE Total Hours of User*/
      }

        $new_time_sched = $_POST["user_schedule"]; /*OLD TIME IN*/
        $new_time_sched = explode(" - ", $new_time_sched);/*Get the Date of Time In*/
        $date = explode(" ", $new_time_sched[0]);
        mysqli_query($conn,"UPDATE schedule set
                                            schedule_date = '".$date[0]."',
                                            schedule_time_in = '".$new_time_sched[0]."',
                                            schedule_time_out = '".$new_time_sched[1]."'
                                            WHERE id =  (SELECT id FROM user WHERE name = '".$_POST["user_name"]."' ) AND schedule_date LIKE '".$date[0]."%'");

      }
      echo "Schedule Updated";
    }
  }

?>
