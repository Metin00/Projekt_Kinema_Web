function shigjetat(n) {
  pozicionim(poz += n);
}

function rrathet(n) {
  pozicionim(poz = n);
}

function pozicionim(n) {
  var i;
  var x = document.getElementsByClassName("posterat");
  var y = document.getElementsByClassName("pikat");
  if (n > x.length) {poz = 1}    
  if (n < 1) {poz = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  for (i = 0; i < y.length; i++) {
     y[i].className = y[i].className.replace(" w3-white", "");
  }
  x[poz-1].style.display = "block";  
  y[poz-1].className += " w3-white";
}


function animacion() {
    var i;
    var x = document.getElementsByClassName("posterat");
	var y = document.getElementsByClassName("pikat");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
	for (i = 0; i < y.length; i++) {
     y[i].className = y[i].className.replace(" w3-white", "");
  }
    counter++;
    if (counter > x.length) {counter = 1}    
    x[counter-1].style.display = "block";  
	y[counter-1].className += " w3-white";
    setTimeout(animacion, 5000); 
}
function myFunction(event) { 
    alert(event.target.id);
}