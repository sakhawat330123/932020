<?php
session_start();
// databace connection
require_once 'dbconnection.php';

// function call 
include 'include/fun.php';

// regestration process 
if (isset($_POST['reg'])) {
	$fname = purify_input($_POST['fname']);
	$lname = purify_input($_POST['lname']);
	$email = purify_input($_POST['email']);
	$pwd = purify_input($_POST['pwd']);
	$contract = purify_input($_POST['contract']);
	$enc_password = $pwd;

	$sql = "INSERT INTO `register`(`fname`, `lname`, `email`, `pwd`, `contract`)
						 VALUES ('$fname', '$lname', '$email', '$enc_password', '$contract')";

	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('New record created successfully')</script>";
	    echo "";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}	
} //end

if (isset($_POST['login'])) {
	$umail = purify_input($_POST['umail']);
	$upass = purify_input($_POST['upass']);
	$hUpass = $upass;

	$logSql = "SELECT * FROM `register` WHERE 'email'= '$umail' AND 'pwd'= '$hUpass'";
	$row = $conn->query($logSql); 
	if ($row > 0) {
		$_SESSION['logId'] = $_POST['regid'];
		$_SESSION['logEmail'] = $_POST['umail'];
		$needPage = 'welcome.php';
		$host = $_SERVER['HTTP_HOST']; // localhost
		$url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

		header("location:http://$host$url/$needPage");
		exit();
	}else{
		echo "<script>alert('Invalid username or password')</script>";
	}
}





 ?>


 



<?php
require "include/header.php";
?>
<div class="container">
	<div class="card">
		<div class="card-body">
			<h2>Registration and Logig system</h2>
			<br>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#register">Register</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#menu1">Log In</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#menu2">Forget</a>
				</li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div id="register" class="container tab-pane active"><br>
					<form method="post" action="" enctype="multipart/form-data">
						<div class="form-group">
							<label for="text">First Name</label>
							<input type="text" name="fname" class="form-control" placeholder="" id="fname" required>
						</div>
						<div class="form-group">
							<label for="text">Last Name</label>
							<input type="text" name="lname" class="form-control" placeholder="" id="lname" required>
						</div>
						<div class="form-group">
							<label for="email">Email address</label>
							<input type="email" name="email" class="form-control" placeholder="" id="email" required>
						</div>
						<div class="form-group">
							<label for="pwd">Password</label>
							<input type="password" name="pwd" class="form-control" placeholder="" id="pwd" required>
						</div>
						<div class="form-group">
							<label for="text">Contact No.</label>
							<input type="text" name="contract" class="form-control" placeholder="" id="contract" required>
						</div>
						<button type="submit" name="reg" class="btn btn-primary">Sign Up</button>
					</form>
				</div>
				<div id="menu1" class="container tab-pane fade"><br>
					<form method="post" action="" enctype="multipart/form-data">
						<div class="form-group">
							<label for="email">Email address:</label>
							<input type="email" name="umail" class="form-control" placeholder="Enter your registered email" id="email">
						</div>
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" name="upass" class="form-control" placeholder="Enter valid password" id="pwd">
						</div>
						<button type="submit" name="login" class="btn btn-primary">LOG IN</button>
					</form>
				</div>
				<div id="menu2" class="container tab-pane fade"><br>
					<form action="/action_page.php">
						<div class="form-group">
							<label for="email">Email address:</label>
							<input type="email" class="form-control" placeholder="Enter your registered email" id="email">
						</div>
						<button type="submit" class="btn btn-primary">Send Email</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
require "include/footer.php";
?>