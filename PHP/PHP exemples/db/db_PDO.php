<!DOCTYPE html>
<html>
<head>
	<title>PDO</title>
	<meta charset="utf-8" />
</head>
<body>

<?php

// on défini les paramètres de connexion à la DB
$host='localhost';
$user='redacteur';
$pass='helb';
$db='ig1';

/*
 Structure de la DB :
	id 			: short int
	login		: varchar(50)
	passaword 	: varchar(50)
	level 		: short int
*/

/**************************************************************************/
// utilisation Mysql avec PHP5 (PDO)
/**************************************************************************/
echo '<hr style="background-color:blue;height:5px;" /><h1>modele objet PDO</h1><hr style="background-color:blue;height:5px;" />';

// Définition des variables de connexion
$dsn = "mysql:host=$host;dbname=$db";

//**************************************
// connexion à mysql et à la db
//**************************************
try 
{
	$dbh = new PDO($dsn, $user, $pass); //db handle
	$dbh->exec('SET NAMES utf8');
} 
catch (PDOException $e) 
{
	die( "Erreur ! : " . $e->getMessage() );
}


//**************************************
// Lecture d’enregistrements
//**************************************
echo '<hr style="background-color:red;height:3px;" /><b>Lecture : SELECT</b><br /><hr style="background-color:red;height:3px;" />';
$sql = "SELECT * FROM users";

// récupération ligne par ligne
//-----------------------------
echo '<hr />Résultat ligne par ligne : Fetch<hr />';
echo 'La requete : '.$sql.'<br />';

$resultat = $dbh->query($sql); 


// on peut généraliser que nous utiliserons les résultats en tant que tableau associatif
$resultat->setFetchMode(PDO::FETCH_ASSOC);
while($row = $resultat->fetch())
// sinon il faut le spécifier dans le fetch
//while ($row = $resultat->fetch(PDO::FETCH_OBJ))
//while ($row = $resultat->fetch(PDO::FETCH_ASSOC))
//while ($row = $resultat->fetch(PDO::FETCH_NUM))
//while ($row = $resultat->fetch(PDO::FETCH_BOTH))
//while ($row = $resultat->fetch(PDO::FETCH_LAZY))
{
        // affichage brut en vert
        echo '<pre style="color:green">';
        print_r($row);
        echo '</pre>';
        
        //utilisation en rouge ou orange selon modèle choisi
        // PDO::FETCH_ASSOC, PDO::FETCH_BOTH
        echo 'PDO::FETCH_ASSOC ou PDO::FETCH_BOTH';
        echo '<p style="color:red"> $row[\'login\'] : $row[\'password\']<br />';
        echo $row['login'].':'.$row['password'].'</p>';
        // PDO::FETCH_NUM, PDO::FETCH_BOTH
        //echo 'PDO::FETCH_NUM ou PDO::FETCH_BOTH';
        //echo '<p style="color:red"> $row[1] : $row[2]<br />';
        //echo $row[1].':'.$row[2].'</p>';
        // PDO::FETCH_LAZY
        //echo 'PDO::FETCH_LAZY';
        //echo '<p style="color:red"> $row->login : $row->password<br />';
        //echo $row->login.':'.$row->password.'</p>';
        // PDO::FETCH_OBJ
        //echo 'PDO::FETCH_OBJ';
        //echo '<p style="color:red"> $row->login : $row->password<br />';
        //echo $row->login.':'.$row->password.'</p>';
}

// récupération de tous les résultats en une fois (=> attention ressources mémoires)
//----------------------------------------------------------------------------------
echo '<hr />Résultat en une fois : FetchALL<hr />';
$resultat = $dbh->query($sql);
echo 'La requete : '.$sql.'<br />';
$result = $resultat->fetchAll(PDO::FETCH_ASSOC); // plusieurs options sur le format de sortie (tableau, associatof, objet, ...) 
$nombre = count($result);
echo 'nombre de lignes : '.$nombre.'<br />';
// affichage brut en vert
echo '<pre style="color:green">';
print_r($result);
echo '</pre>';

foreach ($result as $row)
{
        echo '<pre style="color:orange">';
        print_r($row);
        echo '</pre>';
        
        echo '<p style="color:red"> $row[\'login\'] : $row[\'password\']<br />';
	echo $row['login'].':'.$row['password'].'</p>';
}


//**************************************
// Insertion d’un enregistrement
//**************************************
echo '<hr style="background-color:red;height:3px;" /><b>Insertion : INSERT</b><br /><hr style="background-color:red;height:3px;" />';
$sql = "INSERT INTO users (login,password) VALUES ('gromme','gramme')";
echo 'La requete : '.$sql.'<br />';
$retour = $dbh->exec($sql);
// on utilise le triple === pour ne pas confondre le Zéro enregistrement avec le false (qui peut s'écrire 0). On vérifie donc le type
if($retour === FALSE) // si c'est un booléen
{
	die('Erreur dans la requête<br />') ;
}
elseif($retour === 0) // si c'est un entier
{
	echo 'Aucune modification effectuée<br />';
}
else
{
	echo $retour . ' lignes ont été affectées.<br />';
}

//**************************************
// suppression d’enregistrement
//**************************************
echo '<hr style="background-color:red;height:3px;" /><b>Suppression : DELETE</b><br /><hr style="background-color:red;height:3px;" />';
$sql = "DELETE FROM users WHERE login='gromme'";
echo 'La requete : '.$sql.'<br />';
$retour = $dbh->exec($sql);
// on utilise le triple === pour ne pas confondre le Zéro enregistrement avec le false (qui peut s'écrire 0). On vérifie donc le type
if($retour === FALSE) // si c'est un booléen
{
	die('Erreur dans la requête<br />') ;
}
elseif($retour === 0) // si c'est un entier
{
	echo 'Aucune modification effectuée<br />';
}
else
{
	echo $retour . ' lignes ont été affectées.<br />';
}

//**************************************
// modification d’enregistrement
//**************************************
echo '<hr style="background-color:red;height:3px;" /><b>Modification : UPDATE</b><br /><hr style="background-color:red;height:3px;" />';
$sql = "UPDATE users SET level='2', password='hazard' WHERE login='machine'";
echo 'La requete : '.$sql.'<br />';
$retour = $dbh->exec($sql);
// on utilise le triple === pour ne pas confondre le Zéro enregistrement avec le false (qui peut s'écrire 0). On vérifie donc le type
if($retour === FALSE) // si c'est un booléen
{
	die('Erreur dans la requête<br />') ;
}
elseif($retour === 0) // si c'est un entier
{
	echo 'Aucune modification effectuée<br />';
}
else
{
	echo $retour . ' lignes ont été affectées.<br />';
}



//***************************************
// requêtes paramétrées
//***************************************
echo '<hr style="background-color:red;height:3px;" /><b>Requêtes paramétrées</b><br /><hr style="background-color:red;height:3px;" />';

// bindValue anonyme
//------------------
echo '<hr /><b>bindValue anonyme</b><hr />';
$stmt = $dbh->prepare("SELECT * FROM users WHERE login= ? AND password= ?") ;
$stmt->bindValue(1, 'marie', PDO::PARAM_STR) ;
$stmt->bindValue(2, 'motdepasse', PDO::PARAM_STR) ;
$stmt->execute();
if ($utilisateur = $stmt->fetch(PDO::FETCH_ASSOC))
{
        echo '<pre style="color:green">';
        print_r($utilisateur);
        echo '</pre>';
	echo '<p style="color:red"> $utilisateur[\'login\'] : $utilisateur[\'password\']<br />';
	echo $utilisateur['login'].':'.$utilisateur['password'].'</p>';
}
else
{
	echo "Ce compte n'existe pas !<br />";
}

//bindParam anonyme
//-----------------
echo '<br /><hr /><b>bindParam anonyme</b><hr />';
$stmt = $dbh->prepare("SELECT * FROM users WHERE login= ?") ;
$stmt->bindParam(1, $param1,PDO::PARAM_STR) ;
$param1="machine";
$stmt->execute();
if ($utilisateur = $stmt->fetch(PDO::FETCH_ASSOC))
{
        echo '<pre style="color:green">';
        print_r($utilisateur);
        echo '</pre>';
	echo '<p style="color:red"> $utilisateur[\'login\'] : $utilisateur[\'password\']<br />';
	echo $utilisateur['login'].':'.$utilisateur['password'].'</p>';
}
else
{
	echo "Ce compte n'existe pas !<br />";
}
$param1="cuicui";
$stmt->execute();
$param1="pioupiou";
$stmt->execute();

// bindValue nommé
//----------------
echo '<br /><hr /><b>bindValue nommé</b><hr />';
$stmt = $dbh->prepare("SELECT * FROM users WHERE login= :medol") ;
$stmt->bindValue(':medol', 'roms',PDO::PARAM_STR) ;
$stmt->execute();
if ($utilisateur = $stmt->fetch(PDO::FETCH_ASSOC))
{
        echo '<pre style="color:green">';
        print_r($utilisateur);
        echo '</pre>';
	echo '<p style="color:red"> $utilisateur[\'login\'] : $utilisateur[\'password\']<br />';
	echo $utilisateur['login'].':'.$utilisateur['password'].'</p>';
}
else
{
	echo "Ce compte n'existe pas !<br />";
}

//bindParam nommé
//---------------
echo '<br /><hr /><b>bindParam nommé</b><hr />';
$stmt = $dbh->prepare("SELECT * FROM users WHERE login= :login") ;
$stmt->bindParam(':login', $param1,PDO::PARAM_STR) ;
$param1="paul";
$stmt->execute();
if ($utilisateur = $stmt->fetch(PDO::FETCH_ASSOC))
{
        echo '<pre style="color:green">';
        print_r($utilisateur);
        echo '</pre>';
	echo '<p style="color:red"> $utilisateur[\'login\'] : $utilisateur[\'password\']<br />';
	echo $utilisateur['login'].':'.$utilisateur['password'].'</p>';
}
else
{
	echo "Ce compte n'existe pas !<br />";
}

$param1="cuicui";
$stmt->execute();






//***************************************
// autres exemples
//***************************************
//////
// Requête normale
$sql = "INSERT INTO users (login, password) VALUES ('log1','pwd1')";

// Modèle de requête avec des paramètres nommés
$sql2 = 'INSERT INTO users (login, password) VALUES ( :login , :password)';
// Modèle de requête avec des points d’interrogation
$sql3 = 'INSERT INTO users (login, password) VALUES ( ?, ?)';

//
$stmt = $dbh->prepare($sql2);
$login = 'log2'; $password = 'pwd2' ;
$stmt->execute(array(':login'=>$login, ':password'=>$password));

// Requête paramétrées avec variables "bindées"
$unLogin = 'log3';
$unPassword = 'pwd3';
$stmt->bindParam ( ':login', $unLogin, PDO::PARAM_STR ) ;
$stmt->bindParam ( ':password', $unPassword, PDO::PARAM_STR ) ;
$stmt->execute();
// Un premier enregistrement a été inséré
$unPassword = 'pwdBis' ; 

$stmt->execute();

// affichage des erreurs avec les fonctions PDO
$sQuery = "INSERT INTO users (login,password,level) values (:login,:password,:level)";
$stmt = $dbh->prepare($sQuery);
$stmt->bindParam(':login',$sLogin,PDO::PARAM_STR,20);
$stmt->bindParam(':password',$sPassword,PDO::PARAM_STR,20);
$stmt->bindParam(':level',$iLevel,PDO::PARAM_INT);
if(!$stmt->execute())
{
	echo 'erreur<br />';
	echo '<pre>';
	print_r($dbh->errorInfo());
	print_r($stmt->errorInfo());
	echo '</pre>';
}

// affichage des erreurs avec exceptions
try
{
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // on force la génération d'exception pour les erreurs
	$sQuery = "INSERT INTO users (login,password,level) values (:login,:password,:level)";
	$stmt = $dbh->prepare($sQuery);
	$stmt->bindParam(':login',$sLogin,PDO::PARAM_STR,20);
	$stmt->bindParam(':password',$sPassword,PDO::PARAM_STR,20);
	$stmt->bindParam(':level',$iLevel,PDO::PARAM_INT);
	$stmt->execute();
}
catch (PDOException $e)
{
	echo $e->getMessage();
}

// Fermeture de la connexion
$dbh = NULL;
//////////
// ALTER TABLE users AUTO_INCREMENT=6
//////////