<?php

   
	include 'connect.php';
    $sessionUser = '';
	
	if (isset($_SESSION['Username'])) {
		$sessionUser = $_SESSION['Username'];
	}
	

function getTitle() {

		global $pageTitle;

		if (isset($pageTitle)) {

			echo $pageTitle;

		} else {

			echo 'Default';

		}
	}

	// Include 

	//include 'includes/functions/functions.php';

	include  'includes/header.php';
	

	

	