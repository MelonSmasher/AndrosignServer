<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
if (login_check($mysqli) == true) {
	$page = "index.php";
	header("refresh:3;url=/");
} else {
	$page = "login.php";
	header("refresh:3;url=login.php");
}
?>

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
		<title>Registration Success</title>
	</head>
	<body>

		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="/">Androsign CMS</a>
				</div>
			</div>
		</div>

		<div class="container">
			<h1 class="text-center" >Registration successful! <small>Refresh in three seconds.</small></h1>
		</div>
		<script src="/assets/js/jquery.js"></script>
		<script src="/assets/js/bootstrap.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
	</body>
</html>