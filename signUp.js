// Got help from https://github.com/solodev/hide-show-fields-form/blob/master/hide-show-fields-form.js 
var type = document.getElementById("type");

document.getElementById("buyers").onclick = function () {
	document.getElementById("creditInfo").style.display = "block";
	document.getElementById("creditcard").setAttribute('required', '');
	document.getElementById("creditType").setAttribute('required', '');
	document.getElementById("securityCode").setAttribute('required', '');
};

document.getElementById("sellers").onclick = function () {
	document.getElementById("creditInfo").style.display = "none";
	document.getElementById("creditcard").removeAttribute('required');
	document.getElementById("creditType").removeAttribute('required');
	document.getElementById("securityCode").removeAttribute('required');
};
