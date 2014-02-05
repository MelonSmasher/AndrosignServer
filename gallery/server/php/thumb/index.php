<?php
include_once '/var/www/includes/db_connect.php';
include_once '/var/www/includes/functions.php';
sec_session_start();
// are we logged in?
if (login_check($mysqli) == true) {
	//if so get username.
	$user = $_SESSION['username'];
	if (is_dir($user)) {
		//photo dir does exist go to it.
		header("refresh:0;url=$user");
	} else {
		//Your photo dir does not exist go to the index.
		header("refresh:0;url=../index.php");
	}
} else {
	//We are not logged in, go to login page.
	header("refresh:0;url=../login.php");
}
?>