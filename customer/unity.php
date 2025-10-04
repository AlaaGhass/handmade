<?php

	// Error Reporting

	

	include 'connect.php';
    $sessionUser = '';
	
	if (isset($_SESSION['UserName'])) {
		$sessionUser = $_SESSION['UserName'];
	}

	// Routes


	// Include The Important Files

	//include  'includes/functions.php';

function getTitle() {

		global $pageTitle;

		if (isset($pageTitle)) {

			echo $pageTitle;

		} else {

			echo 'Default';

		}
	}
	

	include  'includes/header.php';
	
	

	