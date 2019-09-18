<?php
include ("../database/connection.php");/*Database Connection*/
$schedule = "";
$schedule .= '
<div class="container-fluid">
<div class="row">
    <h2 class="page-title">Schedule
    <button id = "btn_addsched"class="ui positive button mini offsettop5 btn-add float-right">
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
                                                    <th>Time</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>';

                                            $result_schedule = mysqli_query($conn,"SELECT s.id,u.name,s.schedule_time_in,s.schedule_time_out,s.schedule_date
                                                                          FROM schedule s
                                                                          LEFT JOIN user u ON u.id = s.id ORDER BY s.schedule_date DESC");/*Select Query of OJT*/

                                                    while($row = mysqli_fetch_array($result_schedule))  /*retrieving Data from*/
                                                    {
                                  $schedule .= '    <tr role="row" class="odd">
                                                    <td>'.$row['id'].'</td>
                                                    <td>'.date("F d, Y", strtotime($row['schedule_date'])).'</td>
                                                    <td>'.$row['name'].'</td>
                                                    <td>'.date("h:i:s A", strtotime($row['schedule_time_in'])) .' - '. date("h:i:s A", strtotime($row['schedule_time_out'])).'</td>
                                                    <td>
                                                        <a class="ui blue icon mini basic button" id = "btn_editsched" data-id2="'.$row["schedule_date"].'" data-id1="'.$row["id"].'" data-id3="'.$row["schedule_time_in"].'" data-id4="'.$row["schedule_time_out"].'">
                                                            <i class="edit icon"></i> Edit</a>

                                                        <a class="ui red icon mini basic button" id = "btn_deletesched" data-id2="'.$row['schedule_date'].'" data-id1="'.$row['id'].'">
                                                            <i class="trash icon"></i> Delete</a>
                                                    </td>
                                                    </tr>';
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
