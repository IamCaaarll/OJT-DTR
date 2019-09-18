<?php
include ("../database/connection.php");/*Database Connection*/
$attendance = "";
$attendance .= '

<div class="container-fluid">
<div class="row">
    <h2 class="page-title">Attendance
    <button id = "btn_addattendance"class="ui positive button mini offsettop5 btn-add float-right">
          <i class="ui icon plus"></i>Add</button>
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
                                                    <th>ID #</th>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Time In</th>
                                                    <th>Time Out</th>
                                                    <th>Hours Rendered</th>
                                                    <th>Status (In / Out)</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            $result_attendance = mysqli_query($conn,"SELECT l.rowid,l.id,u.name,l.time_in,l.time_out,l.status,l.hours
                                                                          FROM log l
                                                                          LEFT JOIN user u ON u.id = l.id ORDER BY time_in DESC");/*Select Query of OJT*/

                                              while($row = mysqli_fetch_array($result_attendance))  /*retrieving Data from*/
                                              {
                                                if($row["time_out"] == NULL)
                                                {
                                                  $timeout = "";
                                                }
                                                else
                                                {
                                                  $timeout = date("g:i A", strtotime($row["time_out"]));
                                                }

                                  $attendance .= '<tr role="row" class="odd">
                                                    <td>'.$row['id'].'</td>
                                                    <td>'.date("F d, Y", strtotime($row['time_in'])).'</td>
                                                    <td>'.$row['name'].'</td>
                                                    <td class="text-left">'.date("g:i A", strtotime($row["time_in"])).'</td>
                                                    <td class="text-left">'.$timeout.'</td>
                                                    <td class="align-right">'.$row['hours'].'</td>';

                                                    if($row["status"] == "ON TIME")
                                                    {
                                                        $attendance .= '  <td style= "color:lightgreen;">'.$row["status"].'</td>';
                                                    }
                                                    else if($row["status"] == "LATE")
                                                    {
                                                      $attendance .= '  <td style= "color:red;">'.$row["status"].'</td>';
                                                    }
                                                    else
                                                    {
                                                      $attendance .= ' <td style= "color:orange;">'.$row["status"].'</td>';
                                                    }

                                                    $attendance .= '
                                                    <td>
                                                        <a class="ui blue icon mini basic button" data-id1="'. $row['rowid'].'" id = "btn_editattendance">
                                                            <i class="edit icon"></i> Edit</a>

                                                        <a class="ui red icon mini basic button" data-id1="'. $row['rowid'].'" data-id2="'. $row['id'].'" id ="btn_deleteattendance">
                                                            <i class="trash icon"></i> Delete</a>
                                                    </td>
                                                </tr>';
                                                    }
                                            $attendance .= '
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
                                lengthMenu: [[10, 25, 50]],
                                lengthChange: false,
                                searching: true,
                                sorting: false,
                            });

                              });

                        </script>

                    ';

echo $attendance;
 ?>
