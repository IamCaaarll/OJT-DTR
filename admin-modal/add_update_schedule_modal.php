<?php
include ("../database/connection.php");/*Database Connection*/

if($_POST['id'] == "NONE")
{
echo "<script>
$(function() {
  $('#sched_in_out').daterangepicker({
    timePicker: true,
    locale: {
      format: 'Y-MM-DD HH:mm'
    }
  });
});

</script>
<div class='ui form add-user'>
            <div class='field'>
                  <label>Name</label>
                  <select class='ui search dropdown getid uppercase' name='employee' id ='ojt_names_sched'>
                  </select>
              </div>
    <div class='field'>
        <label>Schedule Time In & Time Out: </label>
        <input type='text' name='datetimes' id ='sched_in_out' autocomplete='off'/>
    </div>
    <div class='actions'>
        <button id='btn_saveupdate_user' class='save' type='button'>
            <i class='ui checkmark icon'></i> Save</button>

        <button class='ui grey cancel small button' type='button'>
            <i class='ui times icon'></i> Cancel</button>
    </div>

</div>
";
}
else
{
  $result = mysqli_query($conn,"SELECT * FROM schedule WHERE id = '".$_POST["id"]."' AND schedule_date ='".$_POST["date"]."'AND schedule_time_in ='".$_POST["time_in"]."'AND schedule_time_out ='".$_POST["time_out"]."'");/*Select Query of OJT*/
  while($row = mysqli_fetch_array($result))  /*retrieving Data from*/
  {
  $id = $row['id'];
  $sched_date = $row['schedule_date'];
  $sched_in= $row['schedule_time_in'];
  $sched_out = $row['schedule_time_out'];
  }

  $select = mysqli_query($conn,"SELECT * FROM user WHERE id = '".$id."'");/*Select Query of OJT*/
  while($row = mysqli_fetch_array($select))  /*retrieving Data from*/
  {
  $name = $row['name'];
  }

    $sched_in_out = date("Y-m-d H:i",strtotime($sched_in)) ." - ". date("Y-m-d H:i",strtotime($sched_out)) ;
    $date = date("m/d/Y",strtotime($sched_date));

$update_output ="";
  $update_output .=  "<script>
  $(function() {
    $('#sched_in_out').daterangepicker({
      timePicker: true,
      locale: {
        format: 'Y-MM-DD HH:mm'
      }
    });
  });

  </script>
  <div class='ui form add-user'>
              <div class='field'>
                    <label>Name</label>
                    <label id ='ojt_names_sched'>".$name."</label>
                </div>
      <div class='field'>
          <label>Schedule Time In & Time Out: </label>
          <input type='text' name='datetimes' id ='sched_in_out' autocomplete='off' value ='".$sched_in_out."'/>
      </div>
      <div class='actions'>
          <button id='btn_saveupdate_user' class='save' type='button'>
              <i class='ui checkmark icon'></i> Save</button>

          <button class='ui grey cancel small button' type='button'>
              <i class='ui times icon'></i> Cancel</button>
      </div>

  </div>";
echo $update_output;
}
 ?>
