<?php
include ("../database/connection.php");/*Database Connection*/
session_start();
$dashboard ="";

$information = mysqli_query($conn,"SELECT * FROM user WHERE id = '".$_SESSION["u_ID"]."'");
  while($row = mysqli_fetch_array($information))  /*retrieving Data from*/
  {

      $remaining_hours = $row['required_hours'] - $row['render_hours'];
      if($remaining_hours <= 0)
      {
        $remaining_hours = "0";
      }
      $required_hours = $row['required_hours'];
      $rendered_hours = $row['render_hours'];
  }

$dashboard .= '<div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-title">Dashboard</h2>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-lightgreen">
                                    <i class="hourglass start icon"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Required Hours</span>
                                    <div class="progress-group">
                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-lightgreen" style="width: 100%"></div>
                                        </div>
                                        <div class="stats_d">
                                          <p class = "hourscount">'.$required_hours.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-lightorange">
                                    <i class="hourglass half icon"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Remaining Hours</span>
                                    <div class="progress-group">
                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-lightorange" style="width: 100%"></div>
                                        </div>
                                        <div class="stats_d">
                                          <p class = "hourscount">'.$remaining_hours.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <span class="info-box-icon bg-lightblue">
                                    <i class="hourglass end icon"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Rendered Hours</span>
                                    <div class="progress-group">
                                        <div class="progress sm">
                                            <div class="progress-bar progress-bar-lightblue" style="width: 100%"></div>
                                        </div>
                                        <div class="stats_d">
                                          <p class = "hourscount">'.$rendered_hours.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Recent Attendance</h3>
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
                                                <th class="text-left">Date</th>
                                                <th class="text-left">Time In</th>
                                                <th class="text-left">Time Out</th>
                                                <th class="text-left">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                        $attendance = mysqli_query($conn,"SELECT * FROM log WHERE time_in BETWEEN DATE_ADD(CURDATE(), INTERVAL -5 DAY) and NOW() AND  id = '".$_SESSION["u_ID"]."' order by time_in Desc");/*Select Query of OJT*/
                                        while($row = mysqli_fetch_array($attendance))  /*retrieving Data from*/
                                        {
                                          $time_outs = "";
                                          $day = explode(" ",$row['time_in']);
                                          if($row['time_out'] == Null)
                                          {
                                              $time_outs ="";
                                          }
                                          else
                                          {
                                              $time_outs =date("g:i A", strtotime($row['time_out']));
                                          }

                                 $dashboard .= '<tr>
                                                <td class="text-left name-title" data-sort="'.$row['time_in'].'">'.date("M d, Y", strtotime($row['time_in'])).'</td>
                                                <td class="text-left name-title">'.date("g:i A", strtotime($row['time_in'])).'</td>
                                                <td class="text-left name-title">'.$time_outs.'</td>
                                                <td class="text-left name-title">'.$row['status'].'</td>
                                                </tr>';
                                              }
                                        $dashboard .= '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Schedule</h3>
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
                                            <th class="text-left">Date</th>
                                            <th class="text-left">Day</th>
                                            <th class="text-left">Time In</th>
                                            <th class="text-left">Time Out</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                        $schedules = mysqli_query($conn,"SELECT * FROM schedule WHERE schedule_date BETWEEN CURDATE() and DATE_ADD(CURDATE(), INTERVAL 5 DAY) AND  id = '".$_SESSION["u_ID"]."' order by schedule_date ASC");/*Select Query of OJT*/

                                        while($row_schedule = mysqli_fetch_array($schedules))  /*retrieving Data from*/
                                        {

                                 $dashboard .= '<tr>
                                                <td class="text-left name-title">'.date("M d, Y", strtotime($row_schedule['schedule_date'])).'</td>
                                                <td class="text-left name-title">'.date("l", strtotime($row_schedule['schedule_date'])).'</td>
                                                <td class="text-left name-title">'.date("g:i A", strtotime($row_schedule['schedule_time_in'])).'</td>
                                                <td class="text-left name-title">'.date("g:i A", strtotime($row_schedule['schedule_time_out'])).'</td>
                                                </tr>';
                                              }
                                        $dashboard .= '
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Pending Attendance</h3>
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
                                                <th class="text-left">Date</th>
                                                <th class="text-left">Time In</th>
                                                <th class="text-left">Time Out</th>
                                                <th class="text-left">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                        $P_attendance = mysqli_query($conn,"SELECT * FROM log WHERE status ='PENDING' AND  id = '".$_SESSION["u_ID"]."' order by time_in Desc");/*Select Query of OJT*/
                                        while($prow = mysqli_fetch_array($P_attendance))  /*retrieving Data from*/
                                        {
                                          $time_outs = "";
                                          $day = explode(" ",$prow['time_in']);
                                          if($prow['time_out'] == Null)
                                          {
                                              $time_outs ="";
                                          }
                                          else
                                          {
                                              $time_outs =date("g:i A", strtotime($prow['time_out']));
                                          }

                                 $dashboard .= '<tr>
                                                <td class="text-left name-title" data-sort="'.$prow['time_in'].'">'.date("M d, Y", strtotime($prow['time_in'])).'</td>
                                                <td class="text-left name-title">'.date("g:i A", strtotime($prow['time_in'])).'</td>
                                                <td class="text-left name-title">'.$time_outs.'</td>
                                                <td class="text-left name-title">'.$prow['status'].'</td>
                                                </tr>';
                                              }
                                        $dashboard .= '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';

                echo $dashboard;

 ?>
