<?php

    ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	include 'config.php';
    $sessionUser = '';
	
	if (isset($_SESSION['userHand'])) {
		$sessionUser = $_SESSION['userHand'];
	}
	

	// Include  Files

	function getTitle() {

		global $pageTitle;

		if (isset($pageTitle)) {

			echo $pageTitle;

		} else {

			echo 'Default';

		}
	}

	
	include 'includes/header.php';
include 'includes/footer.php';
	
	

	