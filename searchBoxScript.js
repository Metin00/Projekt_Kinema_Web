//Using AJAX technology to build the search which will give suggestions
function showHint(str){
	var xhttp;
	if (str.length == 0){
		document.getElementById("txtHint").innerHTML = "";
		return;
	}
	//Create XMLHttpRequest object
	xhttp = new XMLHttpRequest();
	//Create the function to be executed when server response is ready
	xhttp.onreadystatechange = function(){
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("txtHint").innerHTML = this.responseText;
		}
	};
	//We send the request to a php file in the server
	xhttp.open("GET", "getHint.php?q="+str, true);
	xhttp.send();   
}
	    