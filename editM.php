<?php
include('teDrejtaAdmin.php');

include('database_conn.php');


function cleanseData($data){
		$data = htmlspecialchars($data);
		$data = trim($data);
		return $data;
}

	//Marrim id e filmit qe po ndryshohet
	$id = $_GET["id"];
	
	//Marrim te dhenat e ndryshuara pasi i pastrojme
	$title = cleanseData(mysqli_real_escape_string($conn, $_POST['title']));
	$r_date = $_POST['r_date'];
	$description = cleanseData(mysqli_real_escape_string($conn, $_POST['description']));
	$trailer = mysqli_real_escape_string($conn, $_POST['trailer']);
	$imbd = cleanseData(mysqli_real_escape_string($conn, $_POST['imbd']));
	$salla = cleanseData(mysqli_real_escape_string($conn, $_POST['salla']));
	$orari = cleanseData(mysqli_real_escape_string($conn, $_POST['orari']));
	$kohezgjatja = cleanseData(mysqli_real_escape_string($conn, $_POST['kohezgjatja']));
	
	//Krijojme query qe do te beje updatet perkatese
	$sql = "UPDATE movies ".
	"SET titulli ='".$title."', r_date='".$r_date."', pershkrim ='".$description."', trailer = '".$trailer."', IMDB='".$imbd."', salla ='".$salla."', "
	."orari='".$orari."', kohezgjatja='".$kohezgjatja."' 
	WHERE id = ".$id.";";

if (mysqli_query($conn, $sql)){
		//Nese administratori ka vendosur te ndryshoje edhe foton
		if (!empty($_FILES['avatar']['name'])){
			$image_path = mysqli_real_escape_string($conn, ''.$_FILES['avatar']['name']);
			//Kontrollojme a eshte foto
			if (preg_match("!image!", $_FILES['avatar']['type'])){
				//copy the image to our images folder
				if (copy($_FILES['avatar']['tmp_name'], $image_path)){
					//Shtojme imazhin
					$sql = "UPDATE movies SET foto = '".$image_path."' WHERE id =".$id.";";
						if(mysqli_query($conn, $sql))
							$_SESSION['message3']='Filmi u ndryshua me sukses';
						else{
							$_SESSION['message3']='Error ndekohe qe ndryshohej query'.mysqli_error($conn);
						}
				}else{
					$_SESSION['message3']="Imazhi nuk u kopjua dot. Deshtoi ndryshimi i filmit";
				}
			}else{
				$_SESSION['message3']="Pranohen vetem formate JPG, PNG ose GIF. Deshtoi ndryshimi i filmit";
			}
		}else{
			$_SESSION['message3']='Filmi u ndryshua me sukses';
		}
}else{
	//Kontrollojme nese te dhenat e reja gjenden ne databaze dhe per kete arsye nuk mund te behen dot update
	$MYSQL_CODE_DUPLICATE_KEY = 1062;
	if (mysqli_errno($conn) == $MYSQL_CODE_DUPLICATE_KEY){
		$_SESSION['message3'] = "Ndryshimi i te dhenave deshtoi. Te dhenat tuaj jane te rezervuara nga nje tjeter film. Provoni t'i ndryshoni.";
	}else{
		$_SESSION['message3']="Nuk mund te ekzekutohej query.... ".mysqli_error($conn);
	}
}

	//Ndajme inputin e perdoruesit sipas zhanreve individual
	$zhaner = cleanseData(mysqli_real_escape_string($conn, $_POST['zhan']));
	$zhanra = explode(" ", $zhaner, 3);
	
	//Marrim zhanrat e vjeter
	$sql = "SELECT zhanri FROM zhanret WHERE id = ".$id.";";
	$result = mysqli_query($conn, $sql);
	if ($result){
		while ($row = mysqli_fetch_assoc($result)){
			$filma_zhaner[] = $row;
		}
	}else {
		die ("Error ".mysqli_error($conn));
	}
	
	//Bejme update zhanrat duke zevendesuar te vjetrit me te rinjte
	//Deklarojme nje variabel counter i cili do te bredhi tek array $zhanri ku ndodhen edhe filmat
	$counter = 0;
	foreach ($filma_zhaner as $zhaner){
		$sql = "UPDATE zhanret SET zhanri = '".$zhanra[$counter]."' WHERE id = ".$id." AND zhanri = '".$zhaner['zhanri']."';";
		if (!mysqli_query($conn, $sql)){
			die ("Error while executing query ".mysqli_error($conn));
		}
		$counter ++;
	}
	header("location: movies_modify.php")
	
?>