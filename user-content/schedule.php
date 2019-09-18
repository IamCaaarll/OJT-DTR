<?php
include ("../database/connection.php");/*Database Connection*/
session_start();
$schedule = "";
$schedule .= '
<div class="container-fluid">
<div class="row">
    <h2 class="page-title">My Schedule
    </h2>
</div>
              <div class="row">
                        <div class="box box-success">
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                  <th>DATE</th>
                                                  <th>DAY</th>
                                                  <th>TIME IN</th>
                                                  <th>TIME OUT</th>
                                                </tr>
                                            </thead>
                                            <tbody>';


                                              $result = mysqli_query($conn,"SELECT * FROM schedule WHERE id = '".$_SESSION["u_ID"]."' ORDER BY schedule_date DESC");/*Select Query of OJT*/

                                                    while($row = mysqli_fetch_array($result))  /*retrieving Data from*/
                                                    {
                                  $schedule .= "    <tr role='row' class='odd'>
                                                      <td>".date("F d, Y", strtotime($row['schedule_date']))."</td>
                                                      <td>".date('l',strtotime($row['schedule_date']))."</td>
                                                      <td>".$row['schedule_time_in']."</td>
                                                      <td>".$row['schedule_time_out']."</td>
                                                    </tr>";
                                                    }
                                            $schedule .= '
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
                      <script type="text/javascript">

                    $(document).ready(function() {

                      $("#dataTables-example").DataTable({
                                responsive: true,
                                pageLength: 10,
                                lengthChange: false,
                                searching: true,
                                sorting: false,
                            });

                              });

                        </script>

                    ';

echo $schedule;
 ?>
