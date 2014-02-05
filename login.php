<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
if(login_check($mysqli)==true) {
header("refresh:0;url=/");
	
}else{
	$file = file_get_contents('assets/html/login.txt', true);
	echo $file;
}
if(isset($_GET['error'])) {
echo '<h3 class="text-center">Try again <small>wong username or password.<small></h3>';
}
?>
