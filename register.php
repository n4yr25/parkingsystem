<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vehicle Parking System</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php
session_start();
error_reporting(0);
?>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		<center><h2><b>Vehicle Parking System</b></h2></center>
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Create Account</div>
				<div class="panel-body">
					<form method="POST">
					<?php if($msg)
						echo "<div class='alert bg-danger' role='alert'>
						<em class='fa fa-lg fa-warning'>&nbsp;</em> 
						$msg
						<a href='#' class='pull-right'>
						<em class='fa fa-lg fa-close'>
						</em></a></div>" ?> 
                        

						<fieldset>
							<div class="form-group">
                                <label for="">Username</label>
								<input class="form-control" name="username" type="text" require>
							</div>
							<div class="form-group">
                                <label for="">Password</label>
								<input class="form-control" name="password" type="password" value="" require>
							</div>
							<div class="form-group">
                                <label for="">Fullname</label>
								<input class="form-control" name="name" type="text" value="" require>
							</div>
                            <div class="form-group">
                                <label for="">Email</label>
								<input class="form-control" name="email" type="text" value="" require>
							</div>
							<div class="form-group">
                                <label for="">Mobile Number</label>
								<input class="form-control" name="number" type="number" value="" require>
							</div>
							<button class="btn btn-success" type="submit" name="register">Register</button></fieldset>
					</form>
				</div>
			</div>
			<a href="index.php">Login Account</a>
		</div>
	</div>
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
include('includes/dbconn.php');

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
	$fullname = $_POST['name'];
	$email = $_POST['email'];
	$mobnum = $_POST['number'];

	if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['number'])) {
		$sql = "INSERT INTO admin(AdminName, UserName, FullName, MobileNumber, Email, Password) VALUES('user','$username','$fullname','$mobnum','$email','$password');";
		$con->query($sql);
		if($con == TRUE) {
			echo "<script>
						Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'Account Created Succesfully',
						showConfirmButton: false,
						timer: 1500
					});
					</script>";
		}
	} else {
		echo "<script>
				Swal.fire({
					title: 'Please Fill All Information',
					icon: 'error'
				});
				</script>";
	}
  }
?>