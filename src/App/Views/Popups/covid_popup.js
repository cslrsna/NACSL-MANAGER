'use Strict';

function covid_advice () {
	var covid_form = document.forms["covid_advice"]["covid_validation"];
	if (covid_form.checked) {
		document.getElementById('covid-advice').style["display"] = "none";
		var expires = new Date(Date.now() + (7*24*60*60*1000 /*7 jour*/) );
		document.cookie = 'covid-check=' + true + ';expires=' + expires.toUTCString() + ';path=/';
	}
}

(function () {
	var covid_cookie;
	if (document.cookie.search("covid-check") >= 0) {
		var cookies = document.cookie.split(";");
		cookies.forEach(function (c) {
			var cookie = c.split("=");
			cookie[0] = cookie[0].replace(/\s/g, '');
			if (cookie[0] == "covid-check" && eval(cookie[1]) == true) {				
				covid_cookie = true;
			}
		})
	}
	if (!covid_cookie) {	
		document.getElementById('covid-advice').style["height"] = document.body.clientHeight + "px";	
		document.getElementById('covid-advice').style["display"] = "block";
	}

})();