<?php
include ("../database/connection.php");/*Database Connection*/
session_start();

$notif = mysqli_query($conn,"SELECT l.id,u.name,l.time_in,l.time_out,l.status FROM log l LEFT JOIN user u ON u.id = l.id WHERE status = 'PENDING' ORDER BY time_in DESC");/*Select Query of OJT*/

      if(mysqli_num_rows($notif) == 0)/*If the user is not exist in logs table */
         {
         echo 'none';
         }
         else
          {
            while($row = mysqli_fetch_array($notif))  /*retrieving Data from*/
            {
              echo '
                    <label class="item" style ="font-size:12px;"><i class="envelope icon"></i>
                    <label><b>'.$row["name"].'</b>, PENDING</label>
                    <br>
                    <label style="padding-left:30px;">'.date("F d, Y", strtotime($row['time_in'])).'.</label>
                    </label>
                    <div class="divider"></div>';
              }
         }

 ?>
