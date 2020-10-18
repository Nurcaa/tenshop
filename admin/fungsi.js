function getXMLHTTPRequest() {
	var req = false;
	try {
		/* for Firefox */
		req = new XMLHttpRequest();
	} catch (err) {
		try {
			/* for some versions of IE */
			req = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (err) {
			try {
				/* for some other versions of IE */
				req = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (err) {
				req = false;
			}
		}
	}
	return req;
}

function getsub() {		
	var xmlhttp = getXMLHTTPRequest();
	var id = encodeURI(document.getElementById('kategori').value);
	var url = "getsub.php?id="+id;
	var inner = "sub_kategori";
	//open request
	xmlhttp.open('GET', url, true);
	xmlhttp.onreadystatechange = function() {
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
			document.getElementById(inner).innerHTML = xmlhttp.responseText;
		}
		return false;
	}
	xmlhttp.send(null);
}