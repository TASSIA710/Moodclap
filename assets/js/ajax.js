
/* AJAX */
function launchAJAX(script, data, callback) {
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if (xhttp.readyState != 4) return;
		var res = xhttp.responseText;
		if (xhttp.responseText.startsWith('{')) res = JSON.parse (xhttp.responseText);
		if (!callback(res, xhttp.status, xhttp.statusText)) {
			showAlertDanger('AJAX Error', 'Unexpected <code>' + xhttp.status + ' - ' + xhttp.statusText + '</code> @ <code>/api/' + script + '</code> | Please report this error.');
		}
	};

	xhttp.open('POST', '/api/' + script);
	xhttp.setRequestHeader('Content-Type', 'application/json');
	xhttp.send(JSON.stringify(data));
}
/* AJAX */





/* Show Alert */
function showAlertDanger(title, description) {
	var html = '';
	html += '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
		html += '<strong class="mr-2">' + title + '</strong>';
		html += description;
		html += '<button class="close" data-dismiss="alert">&times;</button>';
	html += '</div>';
	document.getElementById('error_container').innerHTML += html;
}
/* Show Alert */
