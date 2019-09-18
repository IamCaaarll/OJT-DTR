<?php
echo '
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

     <link rel="stylesheet" type="text/css" href="libraries/bootstrap.min.v4.1.3.css">
     <link rel="stylesheet" type="text/css" href="libraries/semantic.min.css">
     <link rel="stylesheet" type="text/css" href="libraries/clock.css">

<div class="container-fluid" style="padding-top:50px;">

    <div class="fixedcenter">
        <div class="clockwrapper">
            <div class="clockinout">
                <button id ="time_in" class="btnclock timein active" data-type="timein">Time In</button>
                <button id = "time_out" class="btnclock timeout" data-type="timeout">Time Out</button>
            </div>
        </div>
          <div class="clockwrapper">
              <div class="timeclock" id="clockcolor">
                  <span id="daytoday" class="clock-text"></span>
                  <span id="timetoday" class="clock-time"></span>
                  <span id="datetoday" class="clock-day"></span>
              </div>
        </div>


        <div class="clockwrapper">
            <div class="userinput">
                <form action="" method="get" accept-charset="utf-8" class="ui form">
                    <div class="inline field">
                        <label class="small">ID :</label>
                        <input class="small" id ="idclock" autocomplete="off" name="idno" type="text" onkeypress="return Validate(event);" placeholder="Your ID Number" required>
                        <button id="btnclockin" type="button" name="submit" class="ui positive small button">Confirm</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="message-after">
            <p>
                <span id="greetings">Welcome!</span>
                <span id="fullname"></span>
            </p>
            <p id="messagewrap">
                <span id="type"></span>
                <span id="message"></span>
                <span id="time"></span>
            </p>
        </div>
    </div>

</div>
<script src="libraries/jquery-3.3.1.min.js"></script>
    <script src="libraries/bootstrap.min.v4.1.3.js"></script>
    <script src="libraries/semantic.min.js"></script>
<script>
window.onload = day_today("daytoday");
window.onload = date_time("timetoday");
window.onload = date_today("datetoday");
</script>';


 ?>
