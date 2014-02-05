<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
$user = $_SESSION['username'];
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
		<title>Androsign CMS</title>
	</head>
	<body>
		<?php
		if (login_check($mysqli) == true) :
		?>
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
						<li class="active">
							<a href="/">Home</a>
						</li>
						<li>
							<a href="createConfig.php">Create</a>
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

		<div class="container" id="savedConfigsDiv">
			<div class="custom">
				<?php
				$query = 'SELECT * FROM `configurations` WHERE `user`="' . $user . '"';
				$result = mysqli_query($mysqli, $query);
				$num = $result -> num_rows;
				if ($num == 0) {
					echo '
				<div class="table-responsive">
				<table class="table well well-small span6 table-hover table-condensed">
						<tr>
						<td>Configuration Name</td>
						<td>RSS feed URL</td>
						<td>Watermark URL</td>
						<td>Web Content URL</td>
						<td>Display Weather</td>
						<td>Display Clock</td>
						<td>Set Rotation</td>
						<td>Transition Time</td>
						<td>Edit</td>
						<td>Delete</td>
						</tr>
						<table>
						</div>';
					echo '<h4 class="text-center" >Nothing here! <small>Create a configuration.</small></h4>';
				} else {
					$rows = array();
					if ($result = $mysqli -> query($query)) {
						echo '
					<div class="table-responsive">
					<table class="table well well-small span6 table-hover table-condensed">
						<tr>
						<td>Configuration Name</td>
						<td>RSS feed URL</td>
						<td>Watermark URL</td>
						<td>Web Content URL</td>
						<td>Display Weather</td>
						<td>Display Clock</td>
						<td>Set Rotation</td>
						<td>Transition Time</td>
						<td>Edit</td>
						<td>Delete</td>
						</tr>';
						while ($r = mysqli_fetch_assoc($result)) {
							$rows[] = $r;
							echo '<tr>
							<td> ' . $r['name'] . ' </td>';
							//decode urls if they are urls
							if ($r['rss'] != 'false') {
								echo '<td>true</td>';
							} else {
								echo '<td> ' . $r['rss'] . ' </td>';
							}
							if ($r['watermark'] != 'false') {
								echo '<td>true</td>';
							} else {
								echo '<td> ' . $r['watermark'] . ' </td>';
							}
							if ($r['web_content'] != 'false') {
								echo '<td>true</td>';
							} else {
								echo '<td> ' . $r['web_content'] . ' </td>';
							}
							//end deocde
							echo '<td> ' . $r['weather'] . ' </td>';
							echo '<td> ' . $r['clock'] . ' </td>';
							echo '<td> ' . $r['rotation'] . '&deg; </td>';
							echo '<td> ' . $r['transition'] . '</td>';
							echo '<td><button id="edit' . $r['id'] . '" onclick="editConfig(' . $r['id'] . ')" type="button" class="btn btn-warning edit"><i class="glyphicon glyphicon-edit"></i><span> Edit</span></button></td>';
							echo '<td><button id="del' . $r['id'] . '" onclick="delConfig(' . $r['id'] . ')" type="button" class="btn btn-danger delete"><i class="glyphicon glyphicon-trash"></i><span> Delete</span></button></td>';
							echo '</tr>';
						}
						echo '</table>
							</div>';
					}
				}
				?>
			</div>
			<div class="row-fluid">
				<iframe class="well well-small span6" id='local-iframe' width='1' height='1' frameborder='0'
				src="/gallery/"></iframe>
			</div>
		</div>
		<script src="/assets/js/functions.js"></script>
		<script src="/assets/js/jquery.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
		<script src="/assets/js/bootstrap.js"></script>
		<?php else :
			header("refresh:0;url=login.php");
			endif;
		?>
	</body>
</html>