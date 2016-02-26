/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var xmlhttp;
function ajaxGET(url,cfunc) { // Ajax Processor (not to be called from HTML)
	xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=cfunc;
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
	return xmlhttp;
}
function ajaxPOST(url,data,cfunc) { // Ajax Processor (not to be called from HTML)
	xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=cfunc;
	xmlhttp.open("POST",url,true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(data);
	return xmlhttp;
}
function loadPage(url,eid) { // Ajax LoadPage Handler
	ajaxGET(url,function(){
		if (xmlhttp.readyState===4 && xmlhttp.status===200) {
			document.getElementById([eid]).innerHTML=xmlhttp.responseText;
		}
	});
}

function postComment(form,url,eid) { // Ajax LoadPage Handle
	var input = document.getElementById("Email");
	var validformat=/^\S*@\S*\.\S*$/; //Basic check for format validity
	if (!validformat.test(input.value)) {
		alert("Invalid Email Format. Please correct and submit again.");
	} else {
		var data = "Nama=" + form.Nama.value + "&Email=" + form.Email.value + "&postid=" + form.postid.value + "&Komentar=" + form.Komentar.value;
		ajaxPOST(url, data, function(){
			if (xmlhttp.readyState===4 && xmlhttp.status===200) {
				document.getElementById([eid]).innerHTML=xmlhttp.responseText;
			}
		});
	}
	return false;
}