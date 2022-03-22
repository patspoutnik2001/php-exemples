<?php
$sFond='white';
$sTexte='black';
if(isset($_COOKIE['fond']) AND isset($_COOKIE['texte']) ) 
{
		$sFond=$_COOKIE['fond'];
		$sTexte=$_COOKIE['texte'];
}
if(!empty($_GET['fond']) AND !empty($_GET['texte']))
{
	$sFond=$_GET['fond'];
	$sTexte=$_GET['texte'];
	$expir=time() + 2*30*24*3600;
	setcookie("fond",$sFond,$expir);
	setcookie("texte",$sTexte,$expir);
}


?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Couleurs du site</title>
  		<style type="text/css" >
		<!--
			body{background-color:<?php echo $sFond ?> ;
			color: <?php echo $sTexte ?> ;}
			legend{font-weight:bold;font-family:cursive;}
			label{font-weight:bold;font-style:italic;} 
		-->
		</style>
	</head>
	<body>
		<form method="get" action="">
			<fieldset>
				<legend>Choisissez vos couleurs</legend> 
				<label>Couleur de fond <input type="text" name="fond" /> </label><br /><br /> 
				<label>Couleur de texte <input type="text" name="texte" /> </label><br />
				<input type="submit" value="Envoyer" />&nbsp;&nbsp; 
				<input type="reset" value="Effacer" />
			</fieldset>
		</form>
    </body>
</html>