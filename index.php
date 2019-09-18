<html lang="en" class="fullscreen-bg">

<head>
		<title>OJT</title>

	<link href="libraries/semantic.min.css" rel="stylesheet" type="text/css">
	<link href="libraries/login.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="libraries/bootstrap.min.v4.1.3.css">
</head>

<body class="login_body" >
	<div id="wrapper">

		<div class="vertical-align-wrap">
			<div class="vertical-align-middle" >
				<div class="auth-box">
					<div class="content">
						<div class="header">
							<div class="logo align-center">
								<img src="libraries/GICF.png" style="width:250px;">
							</div>
							<p class="lead">Sign in to your account</p>
						</div>
						<div class="form-auth-small ui form">

							<div class="fields">
								<div class="sixteen wide field">
									<label for="email" class="color-black">Username</label>
									<input type="text" class="" name="email" id = "user_ID" placeholder="Enter ID Numbber" autocomplete="off"  onkeypress="return Validate(event);"  required autofocus>
								</div>
							</div>
							<div class="fields">
								<div class="sixteen wide field">
									<label for="password" class="color-black">Password</label>
									<input id="password" type="password" class="" name="password" placeholder="Enter Password" required>
								</div>
							</div>

							<div class="fields">
								<div class="sixteen wide field">
									<<button type="submit" id = "submit" class="ui green button large fluid">SIGN IN</button>
								</div>
							</div>
								<div class="pcontainer">
									<p class = "alert">Invalid Credentials !</p>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<script src="libraries/jquery-3.3.1.min.js"></script>
	<script src="libraries/semantic.min.js"></script>
  <script src="libraries/bootstrap-notify.js"></script>

	<script>
	  $(document).ready(function() {
		$(".pcontainer").hide();
});
			$(document).on('keypress','#user_ID', function(event) {
					if (event.keyCode == 13) {
						 $("#submit").click();
					}
			});

			$(document).on('keypress','#password', function(event) {
					if (event.keyCode == 13) {
						 $("#submit").click();
					}
			});

			function Validate(event) {
						 var regex = new RegExp("^[0-9-!@#$%*?]");
						 var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
						 if (!regex.test(key)) {
								 event.preventDefault();
								 return false;
						 }
				 }

				 function notif_promt()
				 {
				 	setTimeout(function()
				 	{
				 	$(".pcontainer").hide();
				 	},1000);
				 }

			$(document).on('click','#submit',function()/*If Admin click the Login Button*/
	{
	/*If the Admin Login Success*/
	var login_ID = $('#user_ID').val();
	var login_pass = $('#password').val();
	$.ajax({
		url:"admin-query/login_serv.php",
		method:'POST',
		data:{login_ID:login_ID,login_pass:login_pass},
		success:function(response)
		{
			if(response == "1")
			{
				window.location.href = "admin.php";
			}
			else if (response == "2")
			{
	window.location.href = "user.php";
			}
			else
			{
			$(".pcontainer").show();
			notif_promt();
			}
		}
	})
	});

	</script>
</body>

</html>
