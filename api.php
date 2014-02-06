<?php
function showConfigs() {
	include_once 'includes/db_connect.php';
	$rows = array();
	$query = 'SELECT `id`, `user`, `name`, `rss`, `watermark`, `web_content`, `weather`, `clock`, `rotation`, `transition` FROM `configurations` WHERE 1';
	if ($result = $mysqli -> query($query)) {

		while ($r = mysqli_fetch_assoc($result)) {
			$rows[] = $r;
		}

		$data = array('Configs' => $rows);
		echo json_encode($data);
	}
}

function windDir($winddir) {
	// Given the wind direction, return the text label
	// for that value.  16 point compass
	if (!isset($winddir)) {
		return "---";
	}
	$windlabel = array("N", "NNE", "NE", "ENE", "E", "ESE", "SE", "SSE", "S", "SSW", "SW", "WSW", "W", "WNW", "NW", "NNW");
	$dir = $windlabel[fmod((($winddir + 11) / 22.5), 16)];
	return "$dir";
}

function showPictures($user) {
	$dir = "upload/" . "$user" . "/";
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			$images = array();

			$id = 0;
			while (($file = readdir($dh)) !== false) {
				if (!is_dir($dir . $file)) {
					$images[$id++];
					$images["$id"]["file"] = $file;
				}
			}

			closedir($dh);
			$list = array();
			$list["Images"] = $images;
			echo json_encode($list);
		}
	}
}

if ($_GET['kind'] == 'photo') {
	if ($_GET['user']) {
		showPictures($_GET['user']);
	} else {
		include_once 'includes/db_connect.php';
		include_once 'includes/functions.php';
		sec_session_start();
		if ($_SESSION['username']) {
			showPictures($_SESSION['username']);
		} else {
			header("refresh:0;url=login.php");
		}

	}
} else if ($_GET['kind'] == 'wind') {
	$deg = $_GET['deg'];
	$dir['Direction'] = array(windDir($deg));
	echo json_encode($dir);

} else {
	showConfigs();
}
?>
