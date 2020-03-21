<?php 
	session_start();
	$_SESSION['username'] = "";

	session_unset();
 ?>

 <script language="javascript">
 	document.location="index.php";
 </script>