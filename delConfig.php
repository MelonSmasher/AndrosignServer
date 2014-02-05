<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/psl-config.php';
sec_session_start();
if (login_check($mysqli) == true) {
	$user = $_SESSION['username'];
	$id = $_GET["id"];
	$host = HOST;
	$dbUser = USER;
	$db = DATABASE;
	$p = PASSWORD;
	$mysql = mysql_connect($host, $dbUser, $p);
	mysql_select_db($db, $mysql);
	$id = mysql_real_escape_string($id);
	$sql = "DELETE FROM configurations WHERE id = '$id' AND user = '$user'";
	$insert = mysql_query($sql) or die(mysql_error());
	mysql_close($mysql);
	header("refresh:0;url=/");

} else {
	$page = "login.php";
	header("refresh:0;url=login.php");
}
?>