<?php 
	session_start();
	$_SESSION['fname'] = "";

	session_unset();
?>
<script language="javascript">
	document.location="index.php";
</script>