<?php
include ("../database/connection.php");/*Database Connection*/
session_start();

 $profile = "";
$result = mysqli_query($conn,"SELECT * FROM user WHERE id = '".$_SESSION["u_ID"]."'");/*Select Query of OJT*/
 while($row = mysqli_fetch_array($result))  /*retrieving Data from*/
 {
 $name = $row['name'];
 $designation = $row['designation'];
 $type = $row['type'];
 }


 $profile .= '
 <script>
 function Validate(event) {
        var regex = new RegExp("^[0-9-!@#$%*?]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    }

 </script>
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-title">Update User</h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-success">
                                <div class="box-content">

                                    <form class="ui form" method="post" accept-charset="utf-8">
                                    <div class="field">
                                        <label>ID Number</label>
                                        <input type="text" name="name" id ="profile_id" onkeypress="return Validate(event);" value="'.$_SESSION['u_ID'].'" class="uppercase notempty">
                                    </div>
                                        <div class="field">
                                            <label>Name</label>
                                            <input type="text" name="name" id="profile_name" value="'.$name.'" class="uppercase notempty">
                                        </div>
                                        <div class="field">
                                                <label for="">Designation</label>
                                                <select id="profile_designation" class="ui dropdown uppercase" name="role_id">';
                                                if($designation == "SUPPORT")
                                                {
                                                  $profile .= '  <option value="SUPPORT" selected="selected">SUPPORT</option>
                                                                 <option value="DEVELOPER">DEVELOPER</option>';
                                                }
                                                else
                                                {
                                                  $profile .= '  <option value="SUPPORT" >SUPPORT</option>
                                                                 <option value="DEVELOPER" selected="selected">DEVELOPER</option>';
                                                }


                                              $profile .= '</select>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer">
                                    <button class="ui positive button" type="submit" name="submit" id ="btn_updateprofile"">
                                        <i class="ui checkmark icon" ></i> Update</button>
                                    <a class="ui grey button" id = "btn_cancelupdate">
                                        <i class="ui times icon"></i> Cancel</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                ';
                echo $profile;
 ?>
