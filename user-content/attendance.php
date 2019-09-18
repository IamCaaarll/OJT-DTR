<?php
include ("../database/connection.php");/*Database Connection*/
session_start();
$schedule = "";
$schedule .= '
<div class="container-fluid">
<div class="row">
    <h2 class="page-title">My Attendance
    </h2>
</div>
              <div class="row">
                        <div class="box box-success">
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="ojt_log">
                                            <thead>
                                                <tr>
                                                  <th>DATE</th>
                                                  <th>DAY</th>
                                                  <th>TIME IN</th>
                                                  <th>TIME OUT</th>
                                                  <th>HOURS RENDERED</th>
                                                  <th>STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody>';


                                            $result = mysqli_query($conn,"SELECT l.id,u.name,l.time_in,l.time_out,l.status,l.hours FROM log l LEFT JOIN user u ON u.id = l.id WHERE l.id ='".$_SESSION["u_ID"]."' ORDER BY time_in DESC");/*Select Query of OJT*/
                                                    while($row = mysqli_fetch_array($result))  /*retrieving Data from*/
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

                                                      $schedule .= "
                                                        <tr>
                                                            <td data-sort='".$row['time_in']."'>".date("F d, Y", strtotime($row['time_in']))."</td>
                                                            <td>".date("l", strtotime($day[0]))."</td>
                                                            <td>".date("g:i A", strtotime($row['time_in']))."</td>
                                                            <td>".$time_outs."</td>
                                                            <td>".$row["hours"]."</td>";

                                                            if($row["status"] == "ON TIME")
                                                            {
                                                                $schedule .= ' <td class="text-left" style= "color:#10ac84; font-weight:bold;">'.$row["status"].'</td> </tr>';
                                                            }
                                                            else if($row["status"] == "LATE")
                                                            {
                                                              $schedule .= '  <td class="text-left" style= "color:red;font-weight:bold;">'.$row["status"].'</td> </tr>';
                                                            }
                                                            else
                                                            {
                                                              $schedule .= '  <td class="text-left" style= "color:orange; font-weight:bold;">'.$row["status"].'</td> </tr>';
                                                            }
                                                    }
                                            $schedule .='
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    <script src="libraries/jquery.dataTables.min.js"></script>
    <script src="libraries/dataTables.bootstrap.min.js"></script>
    <script src="libraries/dataTables.responsive.js"></script>
    <script src="libraries/dataTables.buttons.min.js"></script>
    <script src="libraries/buttons.flash.min.js"></script>
    <script src="libraries/jszip.min.js"></script>
    <script src="libraries/pdfmake.min.js"></script>
    <script src="libraries/vfs_fonts.js"></script>
    <script src="libraries/buttons.html5.min.js"></script>
    <script src="libraries/buttons.print.min.js"></script>
                      <script type="text/javascript">

                    $(document).ready(function() {

                      $("#ojt_log").DataTable({
                                dom: "Bfrtip",
                                buttons: [
                                "excel"
                                ]
                            });

                              });

                        </script>

                    ';

echo $schedule;
 ?>
