<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
include_once '/var/www/includes/db_connect.php';
include_once '/var/www/includes/functions.php';
sec_session_start();

if (login_check($mysqli) == true) {
	error_reporting(E_ALL | E_STRICT);
	require ('UploadHandler.php');
	$upload_handler = new UploadHandler();
} else {
	header("refresh:0;url=../../../login.php");
}
?>