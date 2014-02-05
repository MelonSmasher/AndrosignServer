function showDiv(divID, showButton) {
	document.getElementById(divID).style.display = "block";
	document.getElementById(showButton).style.display = "none";
}

function hideDiv(divID, showButt) {
	document.getElementById(divID).style.display = "none";
	document.getElementById(showButt).style.display = "block";
}

function saveConfig(name, rssURL, wmURL, wcURL, weather, clock, trans, rotation) {
	// define variables
	var nameValue = document.getElementById(name).value;
	var rotationValue = document.getElementById(rotation).value;
	var transTime = document.getElementById(trans).value;
	var rssURLValue = document.getElementById(rssURL).value;
	var wmURLValue = document.getElementById(wmURL).value;
	var wcURLValue = document.getElementById(wcURL).value;
	var weatherValue = 'false';
	var clockValue = 'false';

	if (nameValue == '') {
		alert('You must give this configuration a name before saving it.');
		return false;
	}
	if (document.getElementById(weather).checked) {
		weatherValue = 'true';
	}
	if (document.getElementById(clock).checked) {
		clockValue = 'true';
	}
	if (rssURLValue == '') {
		rssURLValue = 'false';
	}
	if (wmURLValue == '') {
		wmURLValue = 'false';
	}
	if (wcURLValue == '') {
		wcURLValue = 'false';
	}
	window.location.href = "../newConfig.php?name=" + nameValue + "&rss=" + rssURLValue + "&watermark=" + wmURLValue + "&webcontent=" + wcURLValue + "&weather=" + weatherValue + "&clock=" + clockValue + "&transition=" + transTime + "&rotation=" + rotationValue;
	return true;
}

function replaceConfig(id, name, rssURL, wmURL, wcURL, weather, clock, trans, rotation) {
	var nameValue = document.getElementById(name).value;
	var rotationValue = document.getElementById(rotation).value;
	var rssURLValue = document.getElementById(rssURL).value;
	var wmURLValue = document.getElementById(wmURL).value;
	var transTime = document.getElementById(trans).value;
	var wcURLValue = document.getElementById(wcURL).value;
	var weatherValue = 'false';
	var clockValue = 'false';

	if (nameValue == '') {
		alert('You must give this configuration a name before saving it.');
		return false;
	}
	if (document.getElementById(weather).checked) {
		weatherValue = 'true';
	}
	if (document.getElementById(clock).checked) {
		clockValue = 'true';
	}
	if (rssURLValue == '') {
		rssURLValue = 'false';
	}
	if (wmURLValue == '') {
		wmURLValue = 'false';
	}
	if (wcURLValue == '') {
		wcURLValue = 'false';
	}
	window.location.href = "../replaceConfig.php?id=" + id + "&name=" + nameValue + "&rss=" + rssURLValue + "&watermark=" + wmURLValue + "&webcontent=" + wcURLValue + "&weather=" + weatherValue + "&clock=" + clockValue + "&transition=" + transTime + "&rotation=" + rotationValue;
	return true;
}

function delConfig(id) {
	var conf = window.confirm("Are you sure?");
	if (conf) {
		window.location.href = "../delConfig.php?id=" + id;
		return true;
	} else {
		return false;
	}
}

function editConfig(id) {
	window.location.href = "../editConfig.php?id=" + id;
	return true;
}

function returnIndex() {
	window.location.href = "/";
	return true;
}

function resizeIframe(height) {
	// "+60" is a general rule of thumb to allow for differences in
	// IE & and FF height reporting, can be adjusted as required
	document.getElementById('local-iframe').height = parseInt(height) + 60;
	document.getElementById('local-iframe').width = '100%';
}

// Tell the parent iframe what height the iframe needs to be
function parentIframeResize() {
	var height = getParam('height');
	// This works as our parent's parent is on our domain
	parent.parent.resizeIframe(height);
}

// Helper function, parse param from request string
function getParam(name) {
	name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	var regexS = "[\\?&]" + name + "=([^&#]*)";
	var regex = new RegExp(regexS);
	var results = regex.exec(window.location.href);
	if (results == null)
		return "";
	else
		return results[1];
}

function iframeResizePipe() {
	var height = document.body.parentNode.scrollHeight;

	// Going to 'pipe' the data to the parent through the helpframe.
	var pipe = document.getElementById('helpframe');

	// Cachebuster a precaution here to stop browser caching interfering
	pipe.src = '/helper.html?height=' + height + '&cacheb=' + Math.random();
}