<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
sec_session_start();
if(login_check($mysqli)==true) {
	
$file=file_get_contents('../assets/html/gallery.txt',true);
echo $file;
} else {
header("refresh:0;url=../login.php");
}
?>
