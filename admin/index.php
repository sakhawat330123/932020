<?php 
	session_start();
	if (isset($_SESSION['username'])) {
		header("location:welcome.php");
	}

	include 'include/fun.php';
	include 'dbconnection.php';

	if (isset($_POST['adminLog'])) {
		$name = purify_input($_POST['username']);
		$password = purify_input($_POST['password']);
		$pssd = $password;

		$uSQL = "SELECT * FROM admin WHERE name = '$name' AND password = '$pssd'";
		$uresult = $conn->query($uSQL);
		if ($uresult-> num_rows > 0) {
			$urow = $uresult->fetch_assoc();
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['admin_id'] = $urow['admin_id'];
			$page = "welcome.php";
			// $host = $_SERVER['HTTP_HOST'];
			// $url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			// header('location:http://$host$url/$page');
			echo "<script>window.location.href='".$page."'</script>";
			exit();
		}else{
			$_SESSION['action1'] = "invalid username OR password";
			$redic = "index.php";
			echo "<script>window.location.href='".$redic."'</script>";
			exit();
		}

	}

 ?>


<?php 
  require "include/header.php";
 ?>



 <div class="container">
   <h2>Form control: input</h2>
   <p><?php echo $_SESSION['action1']; ?> <?php echo $_SESSION['action1'] = ""; ?> </p>
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post">
     <div class="form-group">
       <label for="username">Name:</label>
       <input type="text" class="form-control" id="username" name="username" required>
     </div>
     <div class="form-group">
       <label for="password">Password:</label>
       <input type="password" class="form-control" id="password" name="password" required>
     </div>
     <button type="submit" name="adminLog" class="btn btn-primary">GO</button>
   </form>
 </div>











<?php 
  require "include/footer.php";
 ?>