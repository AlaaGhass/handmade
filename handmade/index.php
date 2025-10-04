<?php

	ob_start();
	session_start();
	$pageTitle = $_SESSION['userHand'];
	//include("session.php");


    include 'unity.php';
	

?>
	 

<?php

	include 'includes/footer.php';
	ob_end_flush();
//	}else{
	header('Location:login.php');

?>