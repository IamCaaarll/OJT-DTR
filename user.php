<?php
  require ("admin-query/login_check.php");
  require ("admin-query/login_check_admin.php");
?>
<html lang="en" dir="ltr">
  <head>
    <title>DTR</title>
    <link rel="stylesheet" type="text/css" href="libraries/bootstrap.min.v4.1.3.css">
    <link rel="stylesheet" type="text/css" href="libraries/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="libraries/style.css">
    <link rel="stylesheet" type="text/css" href="libraries/clock.css">
    <link href="libraries/dataTables.bootstrap.css" rel="stylesheet">
    <link href="libraries/dataTables.responsive.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="libraries/buttons.dataTables.min.css">
</head>

<body>
    <div class="wrapper">

        <nav id="sidebar" class="active">
            <div class="sidebar-header bg-lightgreen">
                <div class="logo" >
                    <a class="simple-text">
                        <img src="libraries/GICFlogo.png">
                    </a>
                </div>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a  id="u_dashboard" style="cursor:pointer;">
                        <i class="ui icon sliders horizontal"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li>
                    <a id="u_attendance" style="cursor:pointer;">
                        <i class="ui icon calendar plus outline"></i>
                        <p>My Attendance</p>
                    </a>
                </li>

                <li>
                    <a id="u_schedules" style="cursor:pointer;">
                        <i class="ui icon calendar alternate outline"></i>
                        <p>My Schedules</p>
                    </a>
                </li>

                <li>
                    <a id="u_in_out" style="cursor:pointer;">
                        <i class="ui icon clock outline"></i>
                        <p>Clock In/Out</p>
                    </a>
                </li>
            </ul>
        </nav>

        <div id="body" class="active" >
            <nav class="navbar navbar-expand-lg navbar-light bg-lightgreen">
                <div class="container-fluid">

                    <button type="button" id="slidesidebar" class="ui icon button btn-light-outline">
                        <i class="ui icon bars"></i> Menu
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="nav navbar-nav ml-auto navmenu">
                          <li class="nav-item">
                              <div class="ui pointing link dropdown item" tabindex="0">
                                  <i class="ui icon user outline"></i><label style = "cursor:pointer;" id ="name_user"></label>
                                  <i class="dropdown icon"></i>
                                  <div class="menu" tabindex="-1">
                                      <a class="item" id = "change_pass">
                                          <i class="ui icon lock"></i> Change Password</a>
                                      <div class="divider"></div>
                                      <a class="item" id ="btn_logout" href="admin-query/session_logout.php">
                                          <i class="ui icon power"></i> Logout</a>
                                  </div>
                              </div>
                          </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content" id ="usercontent">
            </div>

        </div>
    </div>
    <script src="libraries/jquery-3.3.1.min.js"></script>
    <script src="libraries/bootstrap.min.v4.1.3.js"></script>
    <script src="libraries/semantic.min.js"></script>
    <script src="libraries/script.js"></script>
    <script src="libraries/bootstrap-notify.js"></script>

    <script type="text/javascript">
     var in_out = "TIME IN";
    $(document).ready(function() {



      $("#u_dashboard").css('color', 'gray');
      $("#u_dashboard").prop( "disabled", true );
      refresh_dashboard();
      $('#name_user').load('admin-query/name_user.php');
      $("#clockcolor").css('background-color', '#3498db');
    });


    function refresh_dashboard()
    {
      dashboard = setTimeout(function()
      {
      $('#usercontent').load('user-content/dashboard.php');/*Refresh the list of attendance*/
        refresh_dashboard();
      },1000);
    }

        $(document).on('click','#u_attendance',function()
        {
          /*Disable the button*/
        $("#u_dashboard").prop( "disabled", false );
        $("#u_attendance").prop( "disabled", true );
        $("#u_schedules").prop( "disabled", false );
        $("#u_in_out").prop( "disabled", false );
        /*change the text color of button*/
        $("#u_dashboard").css('color', 'white');
        $("#u_attendance").css('color', 'gray');
        $("#u_schedules").css('color', 'white');
        $("#u_in_out").css('color', 'white');

        $('#usercontent').load('user-content/attendance.php');
        clearTimeout(dashboard);
        });

        $(document).on('click','#u_schedules',function()
        {
          /*Disable the button*/
        $("#u_dashboard").prop( "disabled", false );
        $("#u_attendance").prop( "disabled", false );
        $("#u_schedules").prop( "disabled", true );
        $("#u_in_out").prop( "disabled", false );

        /*change the text color of button*/
        $("#u_dashboard").css('color', 'white');
        $("#u_attendance").css('color', 'white');
        $("#u_schedules").css('color', 'gray');
        $("#u_in_out").css('color', 'white');
        $('#usercontent').load('user-content/schedule.php');
        clearTimeout(dashboard);
        });

        $(document).on('click','#u_dashboard',function()
        {
          /*Disable the button*/
        $("#u_dashboard").prop( "disabled", true );
        $("#u_attendance").prop( "disabled", false );
        $("#u_schedules").prop( "disabled", false );
        $("#u_in_out").prop( "disabled", false );
        /*change the text color of button*/
        $("#u_dashboard").css('color', 'gray');
        $("#u_attendance").css('color', 'white');
        $("#u_schedules").css('color', 'white');
        $("#u_in_out").css('color', 'white');
          $('#usercontent').load('user-content/dashboard.php');
          refresh_dashboard();
        });

        $(document).on('click','#u_in_out',function()
        {

          /*Disable the button*/
        $("#u_dashboard").prop( "disabled", false );
        $("#u_attendance").prop( "disabled", false );
        $("#u_schedules").prop( "disabled", false );
        $("#u_in_out").prop( "disabled", true );
        /*change the text color of button*/
        $("#u_dashboard").css('color', 'white');
        $("#u_attendance").css('color', 'white');
        $("#u_schedules").css('color', 'white');
        $("#u_in_out").css('color', 'gray');

        $('#usercontent').load('user-content/clock.php');
        clearTimeout(dashboard);
        });

        $(document).on('click','#cancel_pass',function()
        {
          $('#usercontent').load('user-content/dashboard.php');
          refresh_dashboard();
          /*Disable the button*/
        $("#u_dashboard").prop( "disabled", true );
        $("#u_attendance").prop( "disabled", false );
        $("#u_schedules").prop( "disabled", false );
        $("#u_in_out").prop( "disabled", false );
        /*change the text color of button*/
        $("#u_dashboard").css('color', 'gray');
        $("#u_attendance").css('color', 'white');
        $("#u_schedules").css('color', 'white');
        $("#u_in_out").css('color', 'white');
        });


        $(document).on('click','#update_pass',function()
        {
         var currentpass = $('#currentpassword').val();
          var pass = $('#newpassword').val();
           var confirmpass = $('#confirmpassword').val();

          $.ajax({
            url: 'admin-query/admin_changepassword.php',
            method:"POST",
            data:{currentpass:currentpass,pass:pass,confirmpass:confirmpass},
            success:function(data)
            {
              if(data == "Current password does not match.")
              {
                $.notify({
                          icon: 'ui icon check',
                          message: "Current password does not match."},
                          {type: 'success',timer: 200}
                        );
              }
              else if (data == "New password does not match.")
              {
                $.notify({
                          icon: 'ui icon check',
                          message: "New password does not match."},
                          {type: 'success',timer: 200}
                        );
              }
              else
              {
                $.notify({
                          icon: 'ui icon check',
                          message: "User password has been updated!"},
                          {type: 'success',timer: 200}
                        );
                $("#u_dashboard").prop( "disabled", true );
                $("#u_attendance").prop( "disabled", false );
                $("#u_schedules").prop( "disabled", false );
                $("#u_user").prop( "disabled", false );
                /*change the text color of button*/
                $("#u_dashboard").css('color', 'gray');
                $("#u_attendance").css('color', 'white');
                $("#u_schedules").css('color', 'white');
                $("#u_user").css('color', 'white');

                $('#usercontent').load('user-content/dashboard.php');
                refresh_dashboard();
              }


            }
          })
        });

        $(document).on('click','#change_pass',function()
        {
          clearTimeout(dashboard);
            /*Disable the button*/
          $("#u_dashboard").prop( "disabled", false );
          $("#u_attendance").prop( "disabled", false );
          $("#u_schedules").prop( "disabled", false );
          $("#u_in_out").prop( "disabled", false );
          /*change the text color of button*/
          $("#u_dashboard").css('color', 'white');
          $("#u_attendance").css('color', 'white');
          $("#u_schedules").css('color', 'white');
          $("#u_in_out").css('color', 'white');

          $('#usercontent').load('user-content/change-password.php');
        });

        function promt()
        {
          setTimeout(function()
          {
              $('.message-after').hide();
          },2000);
        }

        $(document).on('click','#btnclockin',function(event)
        {
          if(in_out == "TIME IN")
          {
            var id = $("#idclock").val();
            $.ajax({
              url: 'user-content/timein.php',
              method:"POST",
              data:{id:id},
              success:function(response)
              {
                if(response == "Success")
                {
                  var type = $('.btnclock.active').text();
                  var idno = $('input[name="idno"]').val();
                  $('#type').text(type);

                  $('#fullname').text("Welcome " + ', ' +  $('#name_user').text());
                  $('#time').html('at ' + '<span id=clocktime>' + time('timenow') + '</span>' + '.' + '<span id=clockstatus> Success!</span>');
                  $('.message-after').addClass('ok').slideDown('200');
                  promt();

                }
                else if (response == "Invalid")
                {
                  var type = $('.btnclock.active').text();
                  var idno = $('input[name="idno"]').val();
                  $('#type').text(type);

                  $('#fullname').text($('#name_user').text());
                  $('#time').html('<span id=clockstatus>Failed, Invalid ID Number !</span>');
                  $('.message-after').addClass('ok').slideDown('200');
                  promt();
                }
                else
                {
                  var type = $('.btnclock.active').text();
                  var idno = $('input[name="idno"]').val();
                  $('#type').text(type);

                  $('#fullname').text($('#name_user').text());
                  $('#time').html('<span id=clockstatus>Failed, You already have a Time In today !</span>');
                  $('.message-after').addClass('ok').slideDown('200');
                  promt();
                }

                  $("#idclock").val("");
              }
            })
          }
          else
          {
            var id = $("#idclock").val();

            $.ajax({
              url: 'user-content/timeout.php',
              method:"POST",
              data:{id:id},
              success:function(response)
              {
                if(response == "Success")
                {
                  var type = $('.btnclock.active').text();
                  var idno = $('input[name="idno"]').val();
                  $('#type').text(type);

                  $('#fullname').text("Welcome " + ', ' +  $('#name_user').text());
                  $('#time').html('at ' + '<span id=clocktime>' + time('timenow') + '</span>' + '.' + '<span id=clockstatus> Success!</span>');
                  $('.message-after').addClass('ok').slideDown('200');
                  promt();
                }
                else if (response == "Invalid")
                {
                  var type = $('.btnclock.active').text();
                  var idno = $('input[name="idno"]').val();
                  $('#type').text(type);

                  $('#fullname').text($('#name_user').text());
                  $('#time').html('<span id=clockstatus>Failed, Invalid ID Number !</span>');
                  $('.message-after').addClass('ok').slideDown('200');
                }
                else
                {
                  var type = $('.btnclock.active').text();
                  var idno = $('input[name="idno"]').val();
                  $('#type').text(type);

                  $('#fullname').text($('#name_user').text());
                  $('#time').html('<span id=clockstatus>Failed, You already have a Time In today !</span>');
                  $('.message-after').addClass('ok').slideDown('200');
                  promt();
                }
                  $("#idclock").val("");
              }
            })
          }

        });

        $(document).on('keypress','#idclock', function(event) {
            if (event.keyCode == 13) {
               $("#btnclockin").click();
            }
        });
        $(document).on('click', '#time_in', function(){
          $("#clockcolor").css('background-color', '#3498db');
          in_out = "TIME IN";

          $("#time_in").addClass("btnclock timein active");

          $("#time_out").removeClass("btnclock timeout active");
          $("#time_out").addClass("btnclock timeout");

      });


        $(document).on('click', '#time_out', function(){
          $("#clockcolor").css('background-color', '#2ecc71');
          in_out = "TIME OUT";
          $("#time_in").removeClass("btnclock timein active");

          $("#time_in").addClass("btnclock timein");

          $("#time_out").addClass("btnclock timeout active");
      });


    </script>

</body>

</html>
