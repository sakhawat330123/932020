<?php 
session_start();
if (!isset($_SESSION['username'])) {
  header("location:index.php");
}


include 'include/fun.php';
include 'dbconnection.php';

if (isset($_POST['changePassBtn'])) {
	$oldpass = $_POST['oldpass'];
	$cSql = "SELECT password FROM admin WHERE password='$oldpass'";
	$cResult = $conn->query($cSql);
	$cRow = $cResult->fetch_assoc();
	if ($cRow > 0) {
		$adminid = $_SESSION['admin_id'];
		$newpass = $_POST['newpass'];
		$updatePass = "UPDATE `admin` SET `password`='$newpass' WHERE admin_id='$adminid'";
		$updateFire= $conn->query($updatePass);
		if ($updatePass) {
			$_SESSION['cangePass']= "password changeed successfully";
		}else{
			$_SESSION['cangePass']= "oldpass not match";
			echo "Error updating record: " . $conn->error;
		}
	}
}
?>

<script language="javascript" type="text/javascript">
	function verify(){
		if (document.cangePassFrom.oldpass.value=="") {
			alert("old password form empty !!");
			document.cangePassFrom.oldpass.focus();
			return false;
		}
		else if(document.cangePassFrom.newpass.value=="")
		{
			alert("New passord need !!!");
			document.cangePassFrom.newpass.focus();
			return false;
		}
		else if(document.cangePassFrom.confirmpassword.value=="")
		{
			alert("Confirm password is empty !!!");
			document.cangePassFrom.confirmpassword.focus();
			return false;
		}
		else if (document.cangePassFrom.newpass.value.length<6)
		{
			alert("need minimam 6");
			document.cangePassFrom.newpass.focus();
			return false;
		}
		else if (document.cangePassFrom.confirmpassword.value.length<6)
		{
			alert("need nimimum 6");
			document.cangePassFrom.confirmpassword.focus();
			return false;
		}
		else if (document.cangePassFrom.newpass.value != document.cangePassFrom.confirmpassword.value)
		{
			alert("newpass & confirm password not same");
			document.cangePassFrom.newpass.focus();
			return false;
		}
		return true;
	}
</script>


<?php 
require "include/header.php";
?>


<?php require "include/navbar.php"; ?>



<div class="container">

		<h3>Cahnge password</h3><span>
			<?php echo$_SESSION['cangePass']; ?>
			<?php echo$_SESSION['cangePass'] = ""; ?>
		</span>
		<form name="cangePassFrom" method="post" accept="" onSubmit="return verify();">
			<div class="col-sm-4">		    
			    <label>Current Password</label>
			    <div class="form-group pass_show"> 
	                <input type="password" value="" name="oldpass" class="form-control" placeholder="Current Password"> 
	            </div> 
			       <label>New Password</label>
	            <div class="form-group pass_show"> 
	                <input type="password" value="" name="newpass" class="form-control" placeholder="New Password"> 
	            </div> 
			       <label>Confirm Password</label>
	            <div class="form-group pass_show"> 
	                <input type="password" value="" name="confirmpassword" class="form-control" placeholder="Confirm Password"> 
	            </div> 
	            <div class="form-group">
	              <button type="submit" class="btn btn-primary" name="changePassBtn">SUBMIT</button>
	            </div>
			</div>
		</form>  

</div>




























<?php 
require "include/footer.php";
?>