<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="mainPageStyle.css">
<link rel="stylesheet" href="contactStyle.css">
<link rel="stylesheet" href="profili.css" type="text/css">
<script src="jquery-3.3.1.js"></script>
<script>
//jQuery function to change the color of the textarea onclick and onblur
$(document).ready(function(){
	$("textarea").focus(function(){
		$(this).css("background-color", "rgba(0, 0, 0, 0.5)");
	});
	$("textarea").blur(function(){
		$this.css("background-color", "rgba(0, 0, 0, 0)");
	});
});
</script>
</head>
<body>
<?php include("mainBar.php");?>


<?php
session_start();
//Nese kjo faqe hapet pa qene vizituar me pare mainPage.php atehere do te bejme
//redirect tek mainPage.php
if (!isset($_SESSION['mainPageVisited'])){
	header("location: mainPage.php");
}
?>


<?php
$name = $email = $message = "";
$nameErr = $emailErr = $messageErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if (empty($_POST["emri"])){
		$nameErr = "IU lutemi shkruani emrin tuaj.";
	}
	else{
		$name = cleanse_data($_POST["emri"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameErr = "Vetem germa dhe hapesira lejohen ketu.";
			$name = "";
		}
	}
	
	if (empty($_POST["email"])){
		$emailErr = "Iu lutem shkruani e-mailin tuaj.";
	}
	else{
		$email = cleanse_data($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Iu lutem jepni nje format te vlefshem e-maili"; 
			$email = "";
		}
	}
	
	if(empty($_POST["message1"])){
		$messageErr = "Iu lutem shkruani nje mesazh.";
	}
	else{
		$message = cleanse_data($_POST["message1"]);
	}
}
function cleanse_data ($data)
{
	$data = htmlspecialchars($data);
	$data = trim ($data);
	$data = stripslashes($data);
	return $data;
}

?>


<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
<fieldset>
<legend><h1 id = "header">Na kontaktoni:</h1></legend>
<div class = "poz1">
<img src = "photos/phoneLogo.jpg" alt = "phone logo" class = "image"><span class = "contactINF">&nbsp;&nbsp;&nbsp;Tel: 04 22 33 692</span><br>
<img src = "photos/phoneLogo.jpg" alt = "phone logo" class = "image"><span class = "contactINF">&nbsp;&nbsp;&nbsp;Cel: 069 369 1215</span><br>
<img src = "photos/mailLogo.png" alt = "mail logo" class = "image"><span class = "contactINF">&nbsp;&nbsp;
Email: <a href = "https://mail.google.com/mail/?view=cm&fs=1&tf=1&source=mailto&to=info@theglobetheater.com" target = "_BLANK">info@theglobetheater.com</a></span>
<br>
<img src = "photos/addressLogo.jpg" alt = "address logo" class = "image"><span class = "contactINF">&nbsp;&nbsp;&nbsp;Adresa: Bulevardi Zogu I, Tiranë</span><br>
</div>
<div class = "poz2">
<input type = "text" name = "emri" placeholder="Emri" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'" class = "text">
<input type = "email" name = "email" placeholder = "Emaili" onfocus = "this.placeholder = ''" onblur = "this.placeholder = 'Email'" class = "text">
<br>
<span class = "error"> <?php echo $nameErr;?></span><br>
<span class = "error"> <?php echo $emailErr?></span>
<br><br>
<div class = "s1">
<textarea cols = "55" id = "textarea" name = "message1" placeholder = "Mesazhi" onfocus = "this.placeholder = ''" onblur = "this.placeholder = 'Message'">
</textarea>
<input type = "submit" value = "Dergo" class = "button">
<br>
<span class = "error"> <?php echo $messageErr;?></span><br>
<p id = "notifier"></p>
</div>
<br><br><br><br><br><br>
</div>
</fieldset>
</form>

<script>
function notify(){
	alert("Message successfully sent");
}
</script>
<?php
/*
if ($name!="" && $email!="" && $message!="")
{
	$headers =  'MIME-Version: 1.0' . "\r\n"; 
	$headers .= 'From: Your name <markalem2@gmail.com>' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$message = wordwrap($message, 70);
	$to = "theglobetheateral@gmail.com";
	$subject = "Pyetje mbi kinemane";
	if (mail($to, $subject, $message, $headers)) {
		echo("<p>Email successfully sent!</p>");
	} else {
		echo("<p>Email delivery failed…</p>");
	}
}
*/ // If it was a server... Anyway

if ($name!="" && $email!="" && $message!="")
{
	echo '<script type="text/javascript">',
     'notify();',
     '</script>';
}

?>
</body>
</html>


<!--References:
https://www.w3schools.com/php/php_form_complete.asp
-->