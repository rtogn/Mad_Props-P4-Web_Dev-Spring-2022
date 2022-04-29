// Got help from https://github.com/solodev/hide-show-fields-form/blob/master/hide-show-fields-form.js 
var type = document.getElementById("type");


// Hides and shows CC info based on what option is selected. 
type.addEventListener('change', function() {
		if(type.value == "seller" || type.value == "admin") {
			document.getElementById("creditInfo").style.display = "none";
			document.getElementById("creditcard").removeAttribute('required');
			document.getElementById("creditType").removeAttribute('required');
			document.getElementById("securityCode").removeAttribute('required');
		}
		if (type.value == "buyer") {
			document.getElementById("creditInfo").style.display = "block";
			document.getElementById("creditcard").setAttribute('required', '');
			document.getElementById("creditType").setAttribute('required', '');
			document.getElementById("securityCode").setAttribute('required', '');
		}
	});
	//document.getElementById("type").trigger("change");