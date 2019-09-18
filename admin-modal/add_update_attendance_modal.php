<?php
include ("../database/connection.php");/*Database Connection*/

if($_POST['id'] == "NONE")
{
echo "<script>
$(function() {
  $('#attend_in_out').daterangepicker({
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
                  <select class='ui search dropdown getid uppercase' name='employee' id ='ojt_names'>
                  </select>
              </div>
    <div class='field'>
        <label>Time In & Time Out: </label>
        <input type='text' name='datetimes' id ='attend_in_out' autocomplete='off'/>
    </div>
    <div class='fields'>
        <div class='sixteen wide field role'>
            <label>Status</label>
            <select id='status' class='ui dropdown uppercase' name='role_id'>
                <option value='ON TIME'>ON TIME</option>
                <option value='LATE'>LATE</option>
            </select>
        </div>
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

  $result = mysqli_query($conn,"SELECT l.rowid,l.id,u.name,l.time_in,l.time_out,l.status,l.hours
                                FROM log l
                                LEFT JOIN user u ON u.id = l.id
                                WHERE l.rowid = '".$_POST["id"]."'");/*Select Query of OJT*/

   while($row = mysqli_fetch_array($result))  /*retrieving Data from*/
   {
   $name = $row['name'];
   $sched_in= $row['time_in'];
   $sched_out = $row['time_out'];
   $status = $row['status'];
   }
       $sched_in_out = date("Y-m-d H:i",strtotime($sched_in)) ." - ". date("Y-m-d H:i",strtotime($sched_out)) ;

$update_output ="";
  $update_output .=  "<script>
  $(function() {
    $('#attend_in_out').daterangepicker({
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
                    <label id ='ojt_names'>".$name."</label>
                </div>
      <div class='field'>
          <label>Schedule Time In & Time Out: </label>
          <input type='text' name='datetimes' id ='attend_in_out' autocomplete='off' value ='".$sched_in_out."'/>
      </div>
      <div class='fields'>
          <div class='sixteen wide field role'>
              <label>Status</label>
              <select id='status' class='ui dropdown uppercase' name='role_id'>";

              if($status == "ON TIME")
              {
                $update_output .="<option value='ON TIME' selected='selected'>ON TIME</option>
                                  <option value='LATE'>LATE</option>";
              }
              else
              {
                $update_output .="<option value='ON TIME'>ON TIME</option>
                                  <option value='LATE' selected='selected'>LATE</option>";
              }
            $update_output .="  </select>
          </div>
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
