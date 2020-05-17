
/* AJAX */
function launchAJAX(script, data, callback) {
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if (xhttp.readyState != 4) return;
		var res = xhttp.responseText;
		if (xhttp.responseText.startsWith('{')) res = JSON.parse (xhttp.responseText);
		if (!callback(res, xhttp.status, xhttp.statusText)) {
			showAlertDanger('AJAX Error', 'Unexpected <code>' + xhttp.status + ' - ' + xhttp.statusText + '</code> @ <code>' + script + '</code> | Please report this error.');
		}
	};

	xhttp.open('POST', script);
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





/* Remove Error Border */
function removeErrorBorder(e) {
	e.classList.remove('border-danger');
}
/* Remove Error Border */





/* Utility */
function isEmail(str) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(str);
}
/* Utility */
