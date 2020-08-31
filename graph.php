<!DOCTYPE html>
<?php
include("teDrejtaAdmin.php");
include('database_conn.php');

$sql = "SELECT titulli, IMDB FROM movies;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0){
	$data = '';
	while ($row = mysqli_fetch_assoc($result)){
		$data .= "{ titulli:'".$row["titulli"]."', IMDB:'".$row["IMDB"]."'}, ";
	}
	
	$data =  substr($data, 0, -2);

}else{
	die ("Could not execute query ".mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>chart me PHP & Mysql | lisenme.com </title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:900px;">
   <h2 align="center">Morris.js chart me PHP & Mysql</h2>
   <h3 align="center">10 vitet e fundit perfitim, Blerje  and Te dhena blerjesh</h3>   
   <br /><br />
   <div id="chart" style = "background-color: black;"></div>
  </div>
 </body>
</html>
	
<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $data; ?>],
 xkey:'titulli',
 ykeys:'IMDB',
 labels:'IMDB',
 hideHover:'auto',
 stacked:true
});	
</script>