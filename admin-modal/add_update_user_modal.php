<?php
include ("../database/connection.php");/*Database Connection*/
if($_POST["id"] == "NONE")
{
echo '<div class="ui form add-user">
    <div class="field">
        <label>ID Number</label>
        <input id="number_id" type="text" name="text"  value="">
    </div>

    <div class="field">
        <label>Name</label>
        <input id="name" type="text" name="text"  value="">
    </div>
    <div class="field">
        <label>School</label>
        <input id="school" type="text" name="text"  value="">
    </div>

    <div class="grouped fields opt-radio">
        <label class="">Account Type :</label>
        <div class="field">
            <div class="ui radio checkbox">
                <input type="radio" name="acc_type" value="OJT" checked>
                <label>OJT</label>
            </div>
        </div>
        <div class="field" style="padding:0px!important">
            <div class="ui radio checkbox">
                <input type="radio" name="acc_type" value="ADMIN">
                <label>ADMIN</label>
            </div>
        </div>
    </div>

    <div class="fields">
        <div class="sixteen wide field role">
            <label for="">Designation</label>
            <select id="designation" class="ui dropdown uppercase" name="role_id">
                <option value="SUPPORT">SUPPORT</option>
                <option value="DEVELOPER">DEVELOPER</option>
            </select>
        </div>
    </div>
    <div class="field">
        <label>Required Hours</label>
        <input id="required_hours" type="text" name="text"  value="">
    </div>
    <div class="actions">
        <button id="btn_saveupdate_user" class="save" type="button">
            <i class="ui checkmark icon"></i> Save</button>
        <button class="ui grey cancel small button" type="button">
            <i class="ui times icon"></i> Cancel</button>
    </div>
</div> ';
}
else
{

$result = mysqli_query($conn,"SELECT * FROM user WHERE id = '".$_POST["id"]."'" );/*Select Query of OJT*/
while($row = mysqli_fetch_array($result))  /*retrieving Data from*/
{
$id = $row['id'];
$name = $row['name'];
$password = $row['password'];
$school = $row['school'];
$type = $row['type'];
$designation = $row['designation'];
$required_hours = $row['required_hours'];
}
$update_output = "";

$update_output .= '<div class="ui form add-user">
      <div class="field">
          <label>ID Number</label>
          <input type="text" id="number_id" name="text"  value="'.$id.'">
      </div>

      <div class="field">
          <label>Name</label>
          <input type="text" id="name" name="text"  value="'.$name.'">
      </div>

      <div class="field">
          <label>School</label>
          <input id="school" type="text" name="text" value="'.$school.'">
      </div>';

      if($type == "OJT")
      {
        $update_output .= '
        <div class="grouped fields opt-radio">
            <label class="">Account Type :</label>
            <div class="field">
                <div class="ui radio checkbox">
                    <input type="radio" name="acc_type" value="OJT" checked>
                    <label>OJT</label>
                </div>
            </div>
            <div class="field" style="padding:0px!important">
                <div class="ui radio checkbox">
                    <input type="radio" name="acc_type" value="ADMIN">
                    <label>ADMIN</label>
                </div>
            </div>
        </div>';
      }
      else
      {
        $update_output .= '
        <div class="fields">
            <div class="sixteen wide field role">
                <label for="">Designation</label>
                <select id="type" class="ui dropdown uppercase" name="role_id">
                    <option value="">- Select Designation -</option>';
                    if($designation == "SUPPORT")
                    {
                      $update_output .= '
                        <option value="OJT" selected="selected">OJT</option>
                        <option value="ADMIN">ADMIN</option>';
                    }
                    else
                    {
                      $update_output .= '
                      <option value="OJT">SUPPORT</option>
                      <option value="ADMIN" selected="selected">DEVELOPER</option>';
                    }
      }

$update_output .= '
      <div class="fields">
          <div class="sixteen wide field role">
              <label for="">Designation</label>
              <select id="designation" class="ui dropdown uppercase" name="role_id">
                  <option value="">- Select Designation -</option>';
                  if($designation == "SUPPORT")
                  {
                    $update_output .= '
                      <option value="SUPPORT" selected="selected">SUPPORT</option>
                      <option value="DEVELOPER">DEVELOPER</option>';
                  }
                  else
                  {
                    $update_output .= '
                    <option value="SUPPORT">SUPPORT</option>
                    <option value="DEVELOPER" selected="selected">DEVELOPER</option>';
                  }
$update_output .= '
              </select>
          </div>
      </div>
      <div class="field">
          <label>Required Hours</label>
          <input id="required_hours" type="text" name="text"  value="'.$required_hours.'">
      </div>
      <div class="two fields">
          <div class="field">
          <label for="">Password</label>
          <div class="ui icon input">
          <input  id = "password" value="'.$password.'" type="password" name="password"">
          <i class="eye slash link icon" id ="eye_password"></i>
            </div>
          </div>

          <div class="field">
          <label for="">Confirm Password</label>
          <div class="ui icon input">
          <input  id = "cpassword" value="'.$password.'" type="password" type="password" name="password_confirmation" ">
          <i class="eye slash link icon" id ="eye_confirmpassword"></i>
          </div>
          </div>


      </div>
      <div class="actions">
          <button id="btn_saveupdate_user" class="save" type="button">
              <i class="ui checkmark icon"></i> Save</button>
          <button class="ui grey cancel small button" type="button">
              <i class="ui times icon"></i> Cancel</button>
      </div>
  </div> ';

  echo $update_output;
}

 ?>
