<?php
echo '
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="page-title">Update Password</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="box box-success">
                                    <div class="box-content">

                                        <form action="" class="ui form" method="post" accept-charset="utf-8">
                                            <div class="field">
                                                <label>Current Password</label>
                                                <input type="password" name="currentpassword" id="currentpassword" value="" placeholder="Enter Current Password">
                                            </div>

                                            <div class="field">
                                                <label for="">New Password</label>
                                                <input type="password" name="newpassword" id="newpassword" value="" placeholder="Enter Password">
                                            </div>
                                            <div class="field">
                                                <label for="">Confirm Password</label>
                                                <input type="password" name="confirmpassword" id="confirmpassword" value="" placeholder="Enter Password Confirmation">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="box-footer">
                                        <button class="ui positive button" type="submit" name="submit" id ="update_pass">
                                            <i class="ui checkmark icon"></i> Update</button>
                                        <a class="ui grey button" id ="cancel_pass">
                                            <i class="ui times icon"></i> Cancel</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>';
 ?>
