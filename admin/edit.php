<?php 
session_start();
if (!isset($_SESSION['username'])) {
  header("location:index.php");
}

include 'include/fun.php';
include 'dbconnection.php';


if (isset($_POST['editFrom'])) {
	$fname = purify_input($_POST['fname']);
	$lname = purify_input($_POST['lname']);
	$contract = purify_input($_POST['contract']);
	$editid = intval($_GET['eid']);

	$eSql = "UPDATE `register` SET `fname`='$fname',`lname`='$lname',`contract`='$contract' WHERE regid = $editid";

	if ($conn->query($eSql) === TRUE) {
	    echo "Record updated successfully";
	} else {
	    echo "Error updating record: " . $conn->error;
	}
}



?>

<?php 
require "include/header.php";
?>


<?php require "include/navbar.php"; ?>

<?php 
	$sql = "SELECT * FROM `register` WHERE regid = '".$_GET['eid']."'";

	$result = $conn->query($sql);

	$row = $result->fetch_assoc();

	// print_r($row);
 ?>


<div class="container">
	<h4>
	</h4>
	<form method="post" action="" enctype="multipart/form-data">
		<div class="form-group">
			<label for="text">First Name</label>
			<input type="text" name="fname" value="<?php echo $row['fname']; ?>" class="form-control" placeholder="" id="fname" required>
		</div>
		<div class="form-group">
			<label for="text">Last Name</label>
			<input type="text" name="lname" value="<?php echo $row['lname']; ?>" class="form-control" placeholder="" id="lname" required>
		</div>
		<div class="form-group">
			<label for="email">Email address</label>
			<input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="" id="email" readonly>
		</div>
		<div class="form-group">
			<label for="text">Contact No.</label>
			<input type="text" name="contract" value="<?php echo $row['contract']; ?>" class="form-control" placeholder="" id="contract" required>
		</div>
		<div class="form-group">
			<label for="text">Register date</label>
			<input type="text" name="regid" value="<?php echo $row['register_date']; ?>" class="form-control" placeholder="" id="regid" readonly>
		</div> 
		<button type="submit" name="editFrom" class="btn btn-primary">Sign Up</button>
	</form>
</div>















<?php 
require "include/footer.php";
?>