<?php 
session_start();
if(isset($_SESSION['fname'])){
  header("Location:welcome.php");
}



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

	if ($conn->query($sql) == TRUE) {
		echo "<script>alert('New record created successfully')</script>";
	    echo "";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}	
} //end
// login code
if (isset($_POST['login'])) {
	$umail = purify_input($_POST['umail']);
	$upass = purify_input($_POST['upass']);
	$hUpass = $upass;

	$logSql = "SELECT * FROM `register` WHERE email='$umail' AND pwd='$hUpass'";
	$logResult = $conn->query($logSql);
	
	if ($logResult-> num_rows > 0) {
		$logrow = $logResult->fetch_assoc();
		$_SESSION['logid'] = $logrow['regid'];
		$_SESSION['logEmail'] = $_POST['umail'];
		$_SESSION['fname'] = $logrow['fname'];		
		$needPage = 'welcome.php';
		$host = $_SERVER['HTTP_HOST']; // localhost
		$url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

		header("location:http://$host$url/$needPage");
		exit();
	}else{
		echo "<script>alert('Invalid username or password')</script>";
	}
} // end

if (isset($_POST['forgetMail'])) {
	$femail = purify_input($_POST['femail']);
	$fmailSQL = "SELECT email, password FROM register WHERE email = '$femail'";
	$result = $conn->query($fmailSQL);
	$rowf = $result->fetch_assoc();
	if ($rowf > 0) {
		$sent = $rowf['email'];
		$sendpow = $row['pwd'];
		$sub = "This this about your password";
		$sms = "Your password is : ". $sendpow;
		mail($sent,$sub,$sms, "From: $sent");
		echo "<script>alart('Your passowrd has been sent. Check your email');</script>";
	}else{
		echo "<script>alart('this mail not registered. register first');</script>";
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
					<form method="post" action="" enctype="multipart/form-data">
						<div class="form-group">
							<label for="email">Email address:</label>
							<input type="email" name="femail" class="form-control" placeholder="Enter your registered email" id="email">
						</div>
						<button type="submit" name="forgetMail" class="btn btn-primary">Send Email</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
require "include/footer.php";
?>