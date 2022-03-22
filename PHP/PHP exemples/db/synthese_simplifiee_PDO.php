<?php

// connection
$host='localhost';
$user='redacteur';
$pass='helb';
$db='ig1';

$dsn = "mysql:host={$host};dbname={$db}";

try 
{
	$dbh = new PDO($dsn, $user, $pass); //db handle
	$dbh->exec('SET NAMES utf8');
} 
catch (PDOException $e) 
{
	die( "Erreur ! coco: " . $e->getMessage() ); // arret de la mort
}

// lecture
$stmt = $dbh->prepare("SELECT * FROM users") ;
$stmt->execute();
while($row = $stmt->fetch())
{
	echo $row['nom_colonne'] ;
}

// lecture avec paramètres
$stmt = $dbh->prepare("SELECT * FROM users WHERE login = :login") ;
$stmt->execute();
while($row = $stmt->fetch())
{
	echo $row['nom_colonne'] ;
}

// insertion avec paramètres
// affichage des erreurs avec les fonctions PDO
$stmt = $dbh->prepare("INSERT INTO users (login,password,level) values (:login,:password,:level)");
$stmt->bindParam(':login',$sLogin,PDO::PARAM_STR,20);
$stmt->bindParam(':password',$sPassword,PDO::PARAM_STR,20);
$stmt->bindParam(':level',$iLevel,PDO::PARAM_INT);
// si il y a des erreurs alors on les affiche
if(!$stmt->execute())
{
	echo 'erreur<br />';
	echo '<pre>';
	print_r($dbh->errorInfo());
	print_r($stmt->errorInfo());
	echo '</pre>';
}
else
{
	echo 'ok';
}

// insertion avec paramètres et autre gestion des erreurs
// affichage des erreurs avec exceptions
$bflag = true;
try
{
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // on force la génération d'exception pour les erreurs
	$stmt = $dbh->prepare("INSERT INTO users (login,password,level) values (:login,:password,:level)");
	$stmt->bindParam(':login',$sLogin,PDO::PARAM_STR,20);
	$stmt->bindParam(':password',$sPassword,PDO::PARAM_STR,20);
	$stmt->bindParam(':level',$iLevel,PDO::PARAM_INT);
	$stmt->execute();
}
catch (PDOException $e)
{
	echo $e->getMessage();
	$bflag = false;
}

if($bflag==true)
{
	echo 'ok';
}
else
{
	echo 'ko';
}


