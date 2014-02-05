<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
include_once 'includes/psl-config.php';
sec_session_start();
if (login_check($mysqli) == true) {
	$id = $_GET["id"];
	$user = $_SESSION['username'];
	$id = mysqli_real_escape_string($mysqli, "$id");
	$query = 'SELECT `id`, `user`, `name`, `rss`, `watermark`, `web_content`, `weather`, `clock`, `transition`, `rotation` FROM `configurations` WHERE `id`=' . "$id";
	$result = mysqli_query($mysqli, $query);
	$num = $result -> num_rows;
	if ($num == 0) {
		header("refresh:0;url=/");
	} else {
		$rows = array();
		if ($result = $mysqli -> query($query)) {
			while ($r = mysqli_fetch_assoc($result)) {
				$rows[] = $r;
			}
			if ($user != $rows[0]['user']) {
				header("refresh:0;url=/");
			}
			$confName = $rows[0]['name'];
			$rss = $rows[0]['rss'];
			$watermark = $rows[0]['watermark'];
			$webContent = $rows[0]['web_content'];
			$clock = $rows[0]['clock'];
			$weather = $rows[0]['weather'];
			$transition = $rows[0]['transition'];
			$rotation = $rows[0]['rotation'];
			$weatherStatus = '';
			$clockStatus = '';

			$first = '';
			$second = '';
			$third = '';
			$fourth = '';

			$trans1 = '';
			$trans2 = '';
			$trans3 = '';
			$trans4 = '';
			$trans5 = '';
			$trans6 = '';
			$trans7 = '';

			if ($rss != 'false') {
				$rss = urldecode($rss);
			}
			if ($watermark != 'false') {
				$watermark = urldecode($watermark);
			}
			if ($webContent != 'false') {
				$webContent = urldecode($webContent);
			}
			if ($weather == 'true') {
				$weatherStatus = 'checked';
			}
			if ($clock == 'true') {
				$clockStatus = 'checked';
			}

			switch($transition) {
				case '5' :
					$trans1 = 'selected';
					break;
				case '10' :
					$trans2 = 'selected';
					break;
				case '15' :
					$trans3 = 'selected';
					break;
				case '20' :
					$trans4 = 'selected';
					break;
				case '25' :
					$trans5 = 'selected';
					break;
				case '30' :
					$trans6 = 'selected';
					break;
				case '60' :
					$trans7 = 'selected';
					break;
			}

			switch($rotation) {
				case '0' :
					$first = 'selected';
					break;
				case '90' :
					$second = 'selected';
					break;
				case '180' :
					$third = 'selected';
					break;
				case '270' :
					$fourth = 'selected';
					break;
			}

			echo '
			<!DOCTYPE html>
			<html>
			<head>
				<meta charset="UTF-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link href="/assets/css/bootstrap.css" rel="stylesheet">
				<link href="/assets/css/custom.css" rel="stylesheet">
				<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
				<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
				<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
				<![endif]-->
				<title>Edit: ' . $confName . '</title>
				</head>
				<body>
				
				<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Androsign CMS</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="/">Home</a>
						</li>
						<li class="active">
							<a href="editConfig.php?id=' . "$id" . '">Edit</a>
						</li>
						<li>
							<a href="api.php">API</a>
						</li>
						<li>
							<a href="logout.php">Logout</a>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
				
				
				<div class="container" id="editConfig">
				<form class="form-signin" id="editConfigForm" method="post" name="editConfigForm">
				<h3 class="form-signin-heading">Edit Configuration</h3>
				<label for="configName">Configuration name</label>
					<input id="configName" type="text" placeholder="it_dept_config" name="configName" value="' . $confName . '">
					<br>
				<label for="rssURL">RSS feed URL</label>
					<input type="text" id="rssURL" placeholder="http://dir.yahoo.com/rss/dir/getrss.php?reg_us" name="rssURL" value="' . $rss . '">
					<br>
				<label for="watermarkURL">URL for watermark image</label>
					<input type="text" id="watermarkURL" placeholder="http://flickr.com/img124.jpg" name="wmURL" value="' . $watermark . '">
					<br>
				<label for="webcontentURL">URL for web view</label>
					<input type="text" id="webcontentURL" placeholder="http://slideshow.sage.edu/demo/www/demo.html" name="webContentURL" value="' . $webContent . '">
					<br>
				<label for="weatherCB">Display weather</label>
					<input type="checkbox" id="weatherCB" name="options" value="weather"' . $weatherStatus . '>
					<br>
				<label for="clockCB">Display clock</label>
					<input type="checkbox" id="clockCB" name="options" value="clock"' . $clockStatus . '>
					<br>
				<label for="rotation">App rotation</label>
					<select class="form-control" id="rotation" name="rotation">
						<option value="0" ' . $first . '>0&deg;</option>
						<option value="90" ' . $second . '>90&deg;</option>
						<option value="180" ' . $third . '>180&deg;</option>
						<option value="270" ' . $fourth . '>270&deg;</option>
					</select>
					<br>
				<label for="trans">Background Transition Time</label>
					<select class="form-control" id="trans" name="trans">
						<option value="5" ' . $trans1 . '>5</option>
						<option value="10" ' . $trans2 . '>10</option>
						<option value="15" ' . $trans3 . '>15</option>
						<option value="20" ' . $trans4 . '>20</option>
						<option value="25" ' . $trans5 . '>25</option>
						<option value="30" ' . $trans6 . '>30</option>
						<option value="60" ' . $trans7 . '>60</option>
					</select>
					<br>
				<input class="btn btn-medium btn-secondary" id="cancelConfButt" type="button" value="Cancel" onclick="returnIndex()" />
				<input class="btn btn-medium btn-primary" id="saveConfButt" type="button" value="Save" onclick="replaceConfig(';
			echo "'" . "$id" . "', 'configName', 'rssURL', 'watermarkURL', 'webcontentURL', 'weatherCB', 'clockCB', 'trans', 'rotation'";
			echo ')" />
			</form>
			</div>
			
		<script src="/assets/js/functions.js"></script>
		<script src="/assets/js/jquery.js"></script>
		<script src="/assets/js/bootstrap.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
			
			</body>
			</html>';
		}
	}
} else {
	$page = "login.php";
	header("refresh:0;url=login.php");
}
?>