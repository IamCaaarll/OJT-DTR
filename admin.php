<?php
  require ("admin-query/login_check.php");
  require ("admin-query/login_check_user.php");
?>
 <html lang="en" dir="ltr">
  <head>
    <title>DTR</title>
    <link rel="stylesheet" type="text/css" href="libraries/bootstrap.min.v4.1.3.css">
    <link rel="stylesheet" type="text/css" href="libraries/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="libraries/style.css">
  <link rel="stylesheet" type="text/css" href="libraries/daterangepicker.css" />
  <link rel="stylesheet" href="libraries/font-awesome.min.css">
    <link href="libraries/dataTables.bootstrap.css" rel="stylesheet">
    <link href="libraries/dataTables.responsive.css" rel="stylesheet">
</head>

<body>
  <div class="ui modal medium add" id ="myModal">
        <div class="header" id ="modal-title">Add New User</div>
        <div class="content" id= "modal-content">

        </div>
    </div>

    <div class="wrapper">

        <nav id="sidebar" class="active">
            <div class="sidebar-header bg-lightgreen  ">
                <div class="logo">
                    <a class="simple-text">
                        <img src="libraries/GICFlogo.png">
                    </a>
                </div>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a  id="dashboard" style="cursor:pointer;">
                        <i class="ui icon sliders horizontal"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li>
                    <a id="attendance" style="cursor:pointer;">
                        <i class="ui icon calendar plus outline"></i>
                        <p>Attendance</p>
                    </a>
                </li>

                <li>
                    <a id="schedules" style="cursor:pointer;">
                        <i class="ui icon calendar alternate outline"></i>
                        <p>Schedules</p>
                    </a>
                </li>

                <li>
                    <a id="user" style="cursor:pointer;">
                        <i class="ui icon user circle outline"></i>
                        <p>Users</p>
                    </a>
                </li>

            </ul>
        </nav>

        <div id="body" class="active">
            <nav class="navbar navbar-expand-lg navbar-light bg-lightgreen">
                <div class="container-fluid">

                    <button type="button" id="slidesidebar" class="ui icon button btn-light-outline">
                        <i class="ui icon bars"></i> Menu
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto navmenu">
                            <li class="nav-item" id = "aaa" >
                              <div class="ui pointing link dropdown item" tabindex="">
                                <i class="bell icon" id ="notificon" ></i> Notification
                                    <i class="dropdown icon"></i>
                                    <div class="menu" tabindex="-1" id = "message" style = "height:200px; overflow-y: auto;" >

                                   </div>
                              </div>
                            </li>

                            <li class="nav-item">
                                <div class="ui pointing link dropdown item" tabindex="0" >
                                    <i class="ui icon user outline"></i><label style = "cursor:pointer;" id ="name_user"></label>
                                    <i class="dropdown icon"></i>
                                    <div class="menu" tabindex="-1">
                                        <a class="item" id="user_update">
                                            <i class="ui icon user"></i> Update User</a>
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
            <div class="content" id="content">

            </div>

        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="libraries/jquery-3.3.1.min.js"></script>
    <script src="libraries/bootstrap.min.v4.1.3.js"></script>
    <script src="libraries/semantic.min.js"></script>
    <script type="text/javascript" src="libraries/moment.min.js"></script>
    <script type="text/javascript" src="libraries/daterangepicker.min.js"></script>
    <script src="libraries/bootstrap-notify.js"></script>

    <script type="text/javascript">
      var dashboard;
      var prev_id;
      var row_id;
      var row_id_attend;
      var time_in;
      var time_out;
      var notif;
      var notifs;
    $(document).ready(function() {
            refresh_dashboard();

            refresh_notif();
            $('#name_user').load('admin-query/name_user.php');
            $("#dashboard").prop( "disabled", true );
            $("#dashboard").css('color', 'gray');
            $('#content').load('admin-content/dashboard.php');

                });
            $('#slidesidebar').on('click', function()
            {
            $('#sidebar').toggleClass('active');
            $('#body').toggleClass('active');
        });

        function blink_notif()
        {
        notif =  setTimeout(function()
          {
            $("#notificon").css("color", "red");
              $('#notificon').delay(0).fadeTo(100,1).delay(0).fadeTo(100,1, blink);
          },1000);

          notifs = setTimeout(function()
           {
               $('#notificon').delay(0).fadeTo(100,0.5).delay(0).fadeTo(100,1, blink);
           },1000);
        }


        function refresh_notif()
        {
         setTimeout(function()
          {
            $.ajax({
                    url: 'admin-query/notif.php',
                    success:function(response)
                    {
                      if(response == "none")
                      {
                        $('#message').load('admin-query/notif.php');
                        $("#notificon").css("color","white");
                        $('#notificon').delay(0).fadeTo(100,1).delay(0).fadeTo(100,1, blink);
                        clearTimeout(notif);
                        clearTimeout(notifs);
                      }
                      else
                      {
                        blink_notif();
                        $('#message').load('admin-query/notif.php');
                      }
                    }
                  })
            refresh_notif();
          },1000);
        }

                  $(document).on('click','#btn_updateprofile',function()
                  {
                    if($('#profile_id').val() == "" || $('#profile_name').val() == "")
                    {
                      alert("Please fill the form completely!");
                    }
                    else
                    {
                        $.ajax({
                                url: 'admin-query/update_profile.php',
                                method:"POST",
                                data:{
                                      id:$('#profile_id').val(),
                                      name:$('#profile_name').val(),
                                      type:$('#role').val(),
                                      designation:$('#profile_designation').val()},
                                success:function(data)
                                {
                                  $.notify({
                                            icon: 'ui icon check',
                                            message: data},
                                            {type: 'success',timer: 400}
                                          );
                                  /*Disable the button*/
                                $("#dashboard").prop( "disabled", true );
                                $("#attendance").prop( "disabled", false );
                                $("#schedules").prop( "disabled", false );
                                $("#user").prop( "disabled", false );
                                /*change the text color of button*/
                                $("#dashboard").css('color', 'gray');
                                $("#attendance").css('color', 'white');
                                $("#schedules").css('color', 'white');
                                $("#user").css('color', 'white');

                                refresh_dashboard();
                                $('#content').load('admin-content/dashboard.php');
                                }
                              })

                    }
                  });

          /*function for Attendance*/
          $(document).on('click', '#btn_deleteattendance', function(){
              var rowid=$(this).data("id1");
              var id=$(this).data("id2");
              if(confirm("Are you sure you want to delete this?"))
              {
                $.ajax({
                  url: 'admin-query/delete_attendance.php',
                  method: 'POST',
                  data: {id:id,rowid:rowid},
                  success:function(data)
                  {
                    $.notify({
                              icon: 'ui icon check',
                              message: data},
                              {type: 'success',timer: 400}
                            );
                    $('#content').load('admin-content/attendance.php');
                  }
                })
              }
          });

          $(document).on('click', '#user_update', function(){
              clearTimeout(dashboard);
            $('#content').load('admin-content/update_profile.php');
          });

          var eye_pass = "hide";
          $(document).on('click', '#eye_password', function(){
            if(eye_pass == "hide")
            {
              $('#password').attr('type','text');
              eye_pass = "show";
              $("#eye_password").removeClass("eye slash link icon");
              $("#eye_password").addClass("eye link icon");
            }
            else
            {
              $('#password').attr('type','password');
              eye_pass = "hide";
              $("#eye_password").removeClass("eye link icon");
              $("#eye_password").addClass("eye slash link icon");
            }
          });

          var eye_cpass = "hide";
          $(document).on('click', '#eye_confirmpassword', function(){

            if(eye_cpass == "hide")
            {
              $('#cpassword').attr('type','text');
              eye_cpass = "show";
              $("#eye_confirmpassword").removeClass("eye slash link icon");
              $("#eye_confirmpassword").addClass("eye link icon");
            }
            else
            {
              $('#cpassword').attr('type','password');
              eye_cpass = "hide";
              $("#eye_confirmpassword").removeClass("eye link icon");
              $("#eye_confirmpassword").addClass("eye slash link icon");
            }
          });

          if( $(this).hasClass('show'))
          {
            $('input[name="login[password]"]').attr('type','text');
          }
          else
          {
            $('input[name="login[password]"]').attr('type','text');
            $('input[name="login[password]"]').attr('type','password');
            $(this).addClass('show');
          }

          $(document).on('click','#btn_editattendance',function()
          {
            row_id_attend = $(this).data("id1");

            $.ajax({
              url: 'admin-modal/add_update_attendance_modal.php',
              method:"POST",
              data:{id:row_id_attend},
              success:function(data)
              {
                  $('#modal-content').html(data);
                  $('#myModal').modal('show');
                  $("#modal-title").html('Update Attendance');
                  $("#btn_saveupdate_user").html('Update');
              }
            })

          });
          $(document).on('click','#btn_addattendance',function()
          {
            var id="NONE";
            $.ajax({
              url: 'admin-modal/add_update_attendance_modal.php',
              method:"POST",
              data:{id:id},
              success:function(data)
              {
                  $('#modal-content').html(data);
                  $('#myModal').modal('show');
                  $("#modal-title").html('Add New Attendance');
                  $("#btn_saveupdate_user").html('Save');
                  $('#ojt_names').load('admin-query/username.php');

              }
            })
          });

        /*End of function for Attendance*/

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
                /*Disable the button*/
              $("#dashboard").prop( "disabled", true );
              $("#attendance").prop( "disabled", false );
              $("#schedules").prop( "disabled", false );
              $("#user").prop( "disabled", false );
              /*change the text color of button*/
              $("#dashboard").css('color', 'gray');
              $("#attendance").css('color', 'white');
              $("#schedules").css('color', 'white');
              $("#user").css('color', 'white');

              refresh_dashboard();
              $('#content').load('admin-content/dashboard.php');
            }
          }
          })
        });

        /*function for User*/

    $(document).on('click', '#btn_saveupdate_user', function(){

  switch ($("#modal-title").text()) {
    case 'Add New User':
    if($('#number_id').val() == "" || $('#name').val() == "" || $('#password').val() == "" || $('#school').val() == "" || $('#designation').val() == "" ||$('#required_hours').val() == ""  )
    {
      $.notify({
                icon: 'ui icon check',
                message: "Please fill the form completely!"},
                {type: 'success',timer: 200}
              );
    }
    else
    {
      if($('#password').val() != $('#cpassword').val())
      {
        $.notify({
                  icon: 'ui icon check',
                  message: "Password confirmation does not match!"},
                  {type: 'success',timer: 200}
                );
      }
      else
      {

        var radioValue = $("input[name='acc_type']:checked").val();

        $.ajax({
          url: 'admin-query/add_user.php',
          method:"POST",
          data:{id:$('#number_id').val(),
                name:$('#name').val(),
                school:$('#school').val(),
                type:radioValue,
                designation:$('#designation').val(),
                total_hours:$('#required_hours').val()},
          success:function(data)
          {
            $.notify({
                      icon: 'ui icon check',
                      message: data},
                      {type: 'success',timer: 200}
                    );
            $('#content').load('admin-content/user.php');
            $('#myModal').modal('hide');
          }
        })


      }
    }

      break;

      case 'Update User':
      if($('#number_id').val() == "" || $('#name').val() == "" || $('#password').val() == "" || $('#school').val() == "" || $('#designation').val() == "" ||$('#required_hours').val() == ""  )
      {
        $.notify({
                  icon: 'ui icon check',
                  message: "Please fill the form completely!"},
                  {type: 'success',timer: 200}
                );
      }
      else
      {
        if($('#password').val() != $('#cpassword').val())
        {
          $.notify({
                    icon: 'ui icon check',
                    message: "Password confirmation does not match!"},
                    {type: 'success',timer: 200}
                  );
        }
        else
        {

          var radioValue = $("input[name='acc_type']:checked").val();

                $.ajax({
                  url: 'admin-query/update_user.php',
                  method:"POST",
                  data:{prev_id:prev_id,
                        id:$('#number_id').val(),
                        name:$('#name').val(),
                        password:$('#password').val(),
                        school:$('#school').val(),
                        type:radioValue,
                        designation:$('#designation').val(),
                        total_hours:$('#required_hours').val()},
                  success:function(data)
                  {
                    $.notify({
                              icon: 'ui icon check',
                              message: data},
                              {type: 'success',timer: 200}
                            );
                    $('#content').load('admin-content/user.php');
                    $('#myModal').modal('hide');
                  }
                })

        }
      }

        break;

        case 'Add New Schedule':
        var log_name = $('#ojt_names_sched').val();
        var user_IN_OUT = $('#sched_in_out').val();

                  $.ajax({
                    url: 'admin-query/add_schedule.php',
                    method: 'POST',
                    data:{log_name:log_name,user_IN_OUT:user_IN_OUT},
                    success:function(data)
                    {
                      $.notify({
                                icon: 'ui icon check',
                                message: data},
                                {type: 'success',timer: 200}
                              );
                      $('#content').load('admin-content/schedule.php');
                    }
                  })
          break;

          case 'Update Schedule':

              var user_name = $('#ojt_names_sched').text();
              var user_schedule = $('#sched_in_out').val();
                $.ajax({
                  url: 'admin-query/update_schedule.php',
                  method: 'POST',
                  data:{user_name:user_name,time_in:time_in,user_schedule:user_schedule,time_out:time_out},
                  success:function(data){
                    $.notify({
                              icon: 'ui icon check',
                              message: data},
                              {type: 'success',timer: 200}
                            );
                    $('#myModal').modal('hide');
                    $('#content').load('admin-content/schedule.php');
                  }
                })

            break;

            case 'Add New Attendance':
            var log_name = $('#ojt_names').val();
            var user_IN_OUT = $('#attend_in_out').val();
            var log_status = $('#status').val();

                      $.ajax({
                        url: 'admin-query/add_attendance.php',
                        method: 'POST',
                        data:{log_name:log_name,user_IN_OUT:user_IN_OUT,log_status:log_status},
                        success:function(data)
                        {
                          $.notify({
                                    icon: 'ui icon check',
                                    message: data},
                                    {type: 'success',timer: 200}
                                  );
                          $('#content').load('admin-content/attendance.php');
                        }
                      })
              break;

              case 'Update Attendance':

              var log_name = $('#ojt_names').text();
              var user_IN_OUT = $('#attend_in_out').val();
              var log_status = $('#status').val();
                $.ajax({
                  url: 'admin-query/update_attendance.php',
                  method: 'POST',
                  data:{log_name:log_name,user_IN_OUT:user_IN_OUT,log_status:log_status,rowid:row_id_attend},
                  success:function(data){

                $('#content').load('admin-content/attendance.php');
                $('#myModal').modal('hide');
                $.notify({
                          icon: 'ui icon check',
                          message: data},
                          {type: 'success',timer: 200}
                        );
                  }
                })
                break;
    default:

  }
});

$(document).on('click', '#btn_deleteuser', function(){
    var id=$(this).data("id1");
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url: 'admin-query/delete_user.php',
        method: 'POST',
        data: {id:id},
        success:function(data)
        {
          $.notify({
                    icon: 'ui icon check',
                    message: data},
                    {type: 'success',timer: 200}
                  );
          $('#content').load('admin-content/user.php');
        }
      })
    }
});

$(document).on('click','#btn_adduser',function()
{
  var id="NONE";
  $.ajax({

    url: 'admin-modal/add_update_user_modal.php',
    method:"POST",
    data:{id:id},
    success:function(data)
    {
        $('#modal-content').html(data);
        $('#myModal').modal('show');
        $("#modal-title").html('Add New User');
        $("#btn_saveupdate_user").html('Save');
    }
  })

});

$(document).on('click','#btn_edituser',function()
{
  prev_id=$(this).data("id1");
  $.ajax({

    url: 'admin-modal/add_update_user_modal.php',
    method:"POST",
    data:{id:prev_id},
    success:function(data)
    {
        $('#modal-content').html(data);
        $('#myModal').modal('show');
        $("#modal-title").html('Update User');
        $("#btn_saveupdate_user").html('Update');
    }
  })

});

/*End function for User*/

/*function for Schedule*/


$(document).on('click','#btn_addsched',function()
{
  var id="NONE";
  $.ajax({
    url: 'admin-modal/add_update_schedule_modal.php',
    method:"POST",
    data:{id:id},
    success:function(data)
    {
        $('#modal-content').html(data);
        $('#myModal').modal('show');
        $("#modal-title").html('Add New Schedule');
        $("#btn_saveupdate_user").html('Save');
        $('#content').load('admin-content/schedule.php');
        $('#ojt_names_sched').load('admin-query/username.php');
    }
  })
});

$(document).on('click','#btn_editsched',function()
{
    var id=$(this).data("id1");
    var dates=$(this).data("id2");
    time_in=$(this).data("id3");
    time_out=$(this).data("id4");
  $.ajax({

    url: 'admin-modal/add_update_schedule_modal.php',
    method:"POST",
    data:{id:id,date:dates,time_in:time_in,time_out:time_out},
    success:function(data)
    {
        $('#modal-content').html(data);
        $('#myModal').modal('show');
        $("#modal-title").html('Update Schedule');
        $("#btn_saveupdate_user").html('Update');
    }
  })
});

$(document).on('click','#btn_deletesched',function()
{
  var id=$(this).data("id1");
    var date=$(this).data("id2");
    if(confirm("Are you sure you want to delete this?"))
    {

      $.ajax({
        url: 'admin-query/delete_schedule.php',
        method: 'POST',
        data: {id:id,date:date},
        success:function(data)
        {
          $.notify({
                    icon: 'ui icon check',
                    message: data},
                    {type: 'success',timer: 200}
                  );
          $('#content').load('admin-content/schedule.php');
        }
      })
    }
});

/*End function for Schedule*/

        $(document).on('click','#dashboard',function()
        {
          /*Disable the button*/
        $("#dashboard").prop( "disabled", true );
        $("#attendance").prop( "disabled", false );
        $("#schedules").prop( "disabled", false );
        $("#user").prop( "disabled", false );
        /*change the text color of button*/
        $("#dashboard").css('color', 'gray');
        $("#attendance").css('color', 'white');
        $("#schedules").css('color', 'white');
        $("#user").css('color', 'white');

        refresh_dashboard();
        $('#content').load('admin-content/dashboard.php');
        });

        $(document).on('click','#attendance',function()
        {
          /*Disable the button*/
        $("#dashboard").prop( "disabled", false );
        $("#attendance").prop( "disabled", true );
        $("#schedules").prop( "disabled", false );
        $("#user").prop( "disabled", false );
        /*change the text color of button*/
        $("#dashboard").css('color', 'white');
        $("#attendance").css('color', 'gray');
        $("#schedules").css('color', 'white');
        $("#user").css('color', 'white');

          clearTimeout(dashboard);
          $('#content').load('admin-content/attendance.php');

        });



        $(document).on('click','#change_pass',function()
        {
            clearTimeout(dashboard);
            /*Disable the button*/
          $("#dashboard").prop( "disabled", false );
          $("#attendance").prop( "disabled", false );
          $("#schedules").prop( "disabled", false );
          $("#user").prop( "disabled", false );
          /*change the text color of button*/
          $("#dashboard").css('color', 'white');
          $("#attendance").css('color', 'white');
          $("#schedules").css('color', 'white');
          $("#user").css('color', 'white');

            $('#content').load('admin-content/change-password.php');
        });

        $(document).on('click','#schedules',function()
        {
          /*Disable the button*/
        $("#dashboard").prop( "disabled", false );
        $("#attendance").prop( "disabled", false );
        $("#schedules").prop( "disabled", true );
        $("#user").prop( "disabled", false );
        /*change the text color of button*/
        $("#dashboard").css('color', 'white');
        $("#attendance").css('color', 'white');
        $("#schedules").css('color', 'gray');
        $("#user").css('color', 'white');

          clearTimeout(dashboard);
          $('#content').load('admin-content/schedule.php');

        });

        $(document).on('click','#user',function()
        {
          /*Disable the button*/
        $("#dashboard").prop( "disabled", false );
        $("#attendance").prop( "disabled", false );
        $("#schedules").prop( "disabled", false );
        $("#user").prop( "disabled", true );
        /*change the text color of button*/
        $("#dashboard").css('color', 'white');
        $("#attendance").css('color', 'white');
        $("#schedules").css('color', 'white');
        $("#user").css('color', 'gray');

          clearTimeout(dashboard);
          $('#content').load('admin-content/user.php');
        });

          function refresh_dashboard()
          {
            dashboard = setTimeout(function()
            {
              $('#content').load('admin-content/dashboard.php');/*Refresh the list of attendance*/
              refresh_dashboard();
            },1000);
          }

        $('.ui.dropdown.selection').each(function(index, el) {
            var dropdown = $(this).find('select').val();
            for (var i = 0; i < dropdown.length; i++) {
                $(this).addClass('notempty');
            };
        });

        $('.ui.selection.dropdown, .ui.search.dropdown').focusout(function(event) {
            var dropdown = $(this).find('select').val();
            if(dropdown !== '') {
                $(this).addClass('notempty');
            }
        });


    $(window).resize(function(){
        if($(window).width() <= 768){
            $('#sidebar, #body').addClass('active');
        }
    });

    $('.ui.dropdown').dropdown();
    $('.ui.checkbox').checkbox();
    $('.ui.radio.checkbox').checkbox();
    $('select.dropdown').dropdown();
    $('.ui.modal').modal();
    $('.ui.basic.modal').modal();

    </script>
</body>

</html>
