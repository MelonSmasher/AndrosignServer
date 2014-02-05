<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/psl-config.php';
sec_session_start();
if (login_check($mysqli) == true) {
	$user = $_SESSION['username'];
	$configName = $_GET["name"];
	$rssURL = $_GET["rss"];
	$watermarkURL = $_GET["watermark"];
	$webContentURL = $_GET["webcontent"];
	$weatherValue = $_GET["weather"];
	$clockValue = $_GET["clock"];
	$rotationValue = $_GET["rotation"];
	$transitionTime = $_GET["transition"];

	if ($rssURL != 'false') {
		if (filter_var($rssURL, FILTER_VALIDATE_URL)) {
			$rssURL = urlencode($rssURL);
		} else {
			echo 'The rss url is not valid. ';
			echo ' Redirecting in 3 seconds. ';
			echo "<a href=\"javascript:history.go(-1)\">Click to go back</a>.";
			header("refresh:3;url=/");
			die();
		}
	}
	if ($watermarkURL != 'false') {
		if (filter_var($watermarkURL, FILTER_VALIDATE_URL)) {
			$watermarkURL = urlencode($watermarkURL);
		} else {
			echo 'The watermark url is not valid. ';
			echo ' Redirecting in 3 seconds. ';
			echo "<a href=\"javascript:history.go(-1)\">Click to go back</a>.";
			header("refresh:3;url=/");
			die();
		}
	}
	if ($webContentURL != 'false') {
		if (filter_var($webContentURL, FILTER_VALIDATE_URL)) {
			$webContentURL = urlencode($webContentURL);
		} else {
			echo 'The web content url is not valid. ';
			echo ' Redirecting in 3 seconds. ';
			echo "<a href=\"javascript:history.go(-1)\">Click to go back</a>.";
			header("refresh:3;url=/");
			die();
		}
	}

	$host = HOST;
	$dbUser = USER;
	$db = DATABASE;
	$p = PASSWORD;

	$mysql = mysql_connect($host, $dbUser, $p);
	mysql_select_db($db, $mysql);

	$configName = mysql_real_escape_string($configName);
	$rssURL = mysql_real_escape_string($rssURL);
	$watermarkURL = mysql_real_escape_string($watermarkURL);
	$webContentURL = mysql_real_escape_string($webContentURL);
	$weatherValue = mysql_real_escape_string($weatherValue);
	$clockValue = mysql_real_escape_string($clockValue);
	$rotationValue = mysql_real_escape_string($rotationValue);
	$transitionTime = mysql_real_escape_string($transitionTime);

	$sql = "INSERT INTO configurations (user, name, rss, watermark, web_content, weather, clock, transition, rotation)  VALUES ('" . $user . "', '" . $configName . "', '" . $rssURL . "', '" . $watermarkURL . "', '" . $webContentURL . "', '" . $weatherValue . "', '" . $clockValue . "', '" . $transitionTime . "', '" . $rotationValue . "')";
	$insert = mysql_query($sql) or die(mysql_error());
	mysql_close($mysql);
	header("refresh:0;url=/");

} else {
	$page = "login.php";
	header("refresh:0;url=login.php");
}
?>