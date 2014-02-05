<?php
include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start();
// Our custom secure way of starting a PHP session.
echo '<title>Androsign CMS</title>';
if (isset($_POST['email'], $_POST['p'])) {
	$email = $_POST['email'];
	$password = $_POST['p'];
	// The hashed password.

	if (login($email, $password, $mysqli) == true) {
		// Login success
		header('Location: ../');
	} else {
		// Login failed
		header('Location: ../login.php?error=1');
	}
} else {
	// The correct POST variables were not sent to this page.
	
	echo '<h1 class="alert-error" >Invalid Request!</h1>';
	
	header("refresh:2;url=/");
}
?>