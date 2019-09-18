<?php
include ("../database/connection.php");/*Database Connection*/
$user_output ="";
$user_output .='<div class="container-fluid">
                    <div class="row">
                        <h2 class="page-title">Users
                        <button id = "btn_adduser"class="ui positive button mini offsettop5 btn-add float-right">
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
                                                    <th>Name</th>
                                                    <th>School</th>
                                                    <th>Type</th>
                                                    <th>Designation</th>
                                                    <th>Require Hours</th>
                                                    <th>Rendered Hours</th>
                                                    <th>Remaining Hours</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            $user_result = mysqli_query($conn,"SELECT * FROM user WHERE type = 'OJT' ORDER BY name" );/*Select Query of OJT*/

                                            while($row = mysqli_fetch_array($user_result))  /*retrieving Data from*/
                                            {
                                              $hours = $row['required_hours'] - $row['render_hours'];
                                              if($hours <= 0)
                                              {
                                                $hours = "0";
                                              }

                                              $user_output .='
                                                <tr role="row" class="odd">
                                                    <td>'.$row['id'].'</td>
                                                    <td>'.$row['name'].'</td>
                                                    <td>'.$row['school'].'</td>
                                                    <td>'.$row['type'].'</td>
                                                    <td>'.$row['designation'].'</td>
                                                    <td>'.$row['required_hours'].'</td>
                                                    <td>'.$row['render_hours'].'</td>
                                                    <td>'.$hours.'</td>
                                                    <td >
                                                        <a data-id1="'.$row['id'].'" class="ui blue icon mini basic button" id = "btn_edituser">
                                                            <i class="edit icon"></i> Edit</a>
                                                        <a data-id1="'.$row['id'].'"  class="ui red icon mini basic button" id="btn_deleteuser">
                                                            <i class="trash icon"></i> Delete</a>
                                                    </td>
                                                </tr>';
                                            }
                                            $user_output .='
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
echo $user_output;

 ?>
