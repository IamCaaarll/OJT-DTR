<?php
include ("../database/connection.php");

$tz = 'Asia/Manila';/*Timezone*/
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp

$ontime_count = mysqli_query($conn,"SELECT count(status) as ot_count FROM log WHERE status = 'ON TIME' AND time_in LIKE '".$dt->format("Y-m-d")."%'");/*Select Query of OJT*/
$count_ontime=mysqli_fetch_assoc($ontime_count);

$late_count = mysqli_query($conn,"SELECT count(status) as l_count FROM log WHERE status = 'LATE' AND time_in LIKE '".$dt->format("Y-m-d")."%'");/*Select Query of OJT*/
$count_late=mysqli_fetch_assoc($late_count);

$pending_count = mysqli_query($conn,"SELECT count(status) as p_count FROM log WHERE status = 'PENDING' AND time_in LIKE '".$dt->format("Y-m-d")."%'");/*Select Query of OJT*/
$count_pending=mysqli_fetch_assoc($pending_count);

$attendance_table = "";
$attendance_table .= '<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-title">Dashboard</h2>
        </div>
    </div>
    <div class="row">

                              <div class="info-box">
                                  <span class="info-box-icon bg-aqua">
                                      <i class="ui icon user circle"></i>
                                  </span>

                                  <div class="info-box-content">
                                      <div class="progress-group">
                                          <div class="stats_d">
                                              <table class="table responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="text-left">ON TIME</th>
                                                        <th class="text-left">LATE</th>
                                                        <th class="text-left">PENDING</th>
                                                    </tr>
                                                </thead>
                                                  <tbody>
                                                      <tr>
                                                        <td class="text-left">'.$count_ontime["ot_count"].'</td>
                                                        <td class="text-left">'.$count_late["l_count"].' </td>
                                                        <td class="text-left">'.$count_pending["p_count"].'</td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

    <div class="row">

        <div style="width:100%;">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">ATTENDANCE (Today)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';
                    // WHERE time_out IS null ORDER BY time_in
                    $attendance = mysqli_query($conn,"SELECT l.id,u.name,l.time_in,l.time_out,l.status FROM log l LEFT JOIN user u ON u.id = l.id WHERE time_out IS NULL ORDER BY time_in");/*Select Query of OJT*/
                    while($row = mysqli_fetch_array($attendance))  /*retrieving Data from*/
                    {
                      if($row["time_out"] == NULL)
                      {
                        $timeout = "";
                      }
                      else
                      {
                        $timeout = date("g:i A", strtotime($row["time_out"]));
                      }

                      $attendance_table .= '
                        <tr>
                            <td class="text-left">'.$row["name"].'</td>
                            <td class="text-left">'.date("g:i A", strtotime($row["time_in"])).'</td>
                            <td class="text-left">'.$timeout.'</td>';
                            if($row["status"] == "ON TIME")
                            {
                                $attendance_table .= '  <td class="text-left" style= "color:#10ac84; font-weight:bold;">'.$row["status"].'</td> </tr>';
                            }
                            else if($row["status"] == "LATE")
                            {
                              $attendance_table .= '  <td class="text-left" style= "color:red;font-weight:bold;">'.$row["status"].'</td> </tr>';
                            }
                            else
                            {
                              $attendance_table .= '  <td class="text-left" style= "color:orange; font-weight:bold;">'.$row["status"].'</td> </tr>';
                            }

                      }
                        $attendance_table .= '
                    </tbody>
                </table>
                </div>
            </div>
        </div>

    </div>



    <div class="row">

        <div style="width:100%;">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">SCHEDULE (Today)</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                  <table class="table responsive">
                        <thead>

                            <tr>
                                <th class="text-left">Name</th>
                                <th class="text-left">Schedule Time In</th>
                                <th class="text-left">Schedule Time Out</th>
                            </tr>
                        </thead>
                        <tbody>';
                        // WHERE time_out IS null ORDER BY time_in
                        $schedule = mysqli_query($conn,"SELECT s.schedule_time_in,s.schedule_time_out,u.name FROM schedule s LEFT JOIN user u ON u.id = s.id WHERE schedule_date LIKE '".$dt->format("Y-m-d")."%' ORDER BY schedule_date");/*Select Query of OJT*/
                        while($row_schedule = mysqli_fetch_array($schedule))  /*retrieving Data from*/
                        {

                          $attendance_table .= '
                            <tr>
                                <td class="text-left">'.$row_schedule["name"].'</td>
                                <td class="text-left">'.date("g:i A", strtotime($row_schedule["schedule_time_in"])).'</td>
                                <td class="text-left">'.date("g:i A", strtotime($row_schedule["schedule_time_out"])).'</td>';
                          }
                            $attendance_table .= '
                          </tr></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    </div>



</div>
';

echo $attendance_table;

 ?>
