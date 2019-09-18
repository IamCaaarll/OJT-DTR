<?php
include ("../database/connection.php");
session_start();
$tz = 'Asia/Manila';/*Timezone*/
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp

if($_SESSION["u_ID"] != $_POST["id"] )
{
  echo "Invalid";
}
else
{
  $selectsched = mysqli_query($conn,"SELECT * FROM log WHERE id = '".$_POST["id"]."' AND status IN ('ON TIME','LATE','PENDING') AND time_out IS NULL AND hours IS NULL");/*Select query for the Identify the user*/
  if(mysqli_num_rows($selectsched) == 0)
  {
      echo "You dont have a Time In today !";
  }
  else
  {
              $select_log = mysqli_query($conn,"SELECT * FROM log WHERE id = '".$_POST["id"]."' AND hours IS null");/*Select query for the Identify the user*/
              while($row=mysqli_fetch_array($select_log))
                {
                  if($row["status"] == "PENDING")
                  {
                    $select_rowid = mysqli_query($conn,"SELECT * FROM log WHERE id = '".$_POST["id"]."' AND status = 'PENDING' AND time_out IS null");/*Select query for the Identify the user*/
                    while($row_id=mysqli_fetch_array($select_rowid))
                    {
                      mysqli_query($conn,"UPDATE log SET time_out = '".$dt->format("Y-m-d H:i:s")."' where id = '".$_POST["id"]."' AND rowid = '".$row_id["rowid"]."'"); /*Insert into Time out of user*/
                    }
                  }
                  else
                  {

                    mysqli_query($conn,"UPDATE log SET time_out = '".$dt->format("Y-m-d H:i:s")."' where id = '".$_POST["id"]."' AND hours IS null AND status IN ('ON TIME','LATE')"); /*Insert into Time out of user*/
                    $select = mysqli_query($conn,"SELECT * FROM log WHERE id = '".$_POST["id"]."' AND hours IS null AND status IN ('ON TIME','LATE')");/*Select query for the Identify the user*/
                    while($row=mysqli_fetch_array($select))
                      {
                        $timeout =$row["time_out"];
                        $timin = $row["time_in"];
                            /*output of the difference in the TIME IN and TIME OUT*/
                            $t1 = StrToTime (date($timeout));
                            $t2 = StrToTime (date($timin));
                            $diff = $t1 - $t2;
                            $hours = $diff / ( 60 * 60 );

                            if($hours > 11)
                            {
                                $hours = 11 - 1;
                            }
                            else
                            {
                              if($hours > 5)
                              {
                                $hours = $hours - 1;
                              }
                            }
                            mysqli_query($conn,"UPDATE log SET hours = '".$hours."' where id = '".$_POST["id"]."' AND hours IS null AND status IN ('ON TIME','LATE')");  /*Update the Nohours of the user*/
                                $res = mysqli_query($conn,"SELECT sum(hours) FROM log WHERE id ='".$_POST["id"]."' AND status IN ('ON TIME','LATE')");
                                $row = mysqli_fetch_row($res);
                                $sum = $row[0];
                                mysqli_query($conn,"UPDATE user SET render_hours = '".$sum."' where id = '".$_POST["id"]."'");


                    }
                  }
                }
                echo "Success";
}
}

 ?>
