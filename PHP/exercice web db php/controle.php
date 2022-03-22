<?php
//**************************************
// Contrôle Programmation Web IG1
// NOM 		: 
// PRENOM 	:
//**************************************

require_once("fonctions_controle.php");
require_once("connexion_pdo.php");

// déclaration et initialisation des variables d'environnement et d'affichage
$pageEnCours = $_SERVER['PHP_SELF'];
$body='';

//***************************************************************************************
// Partie traitement des ACTIONS 
//***************************************************************************************

// TO DO 

//***************************************************************************************
// Déclaration et initialisation des variables d'environnement et d'affichage
//***************************************************************************************
$contenuAnnuaire = formulaireExportation($dbh,$pageEnCours);


$debut_html = <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<title>Contrôle CSV&lt;=&gt;MySQL</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
	
EOT;

$menu = <<<EOT
<fieldset>
	<legend>Importation : CSV 2 MySQL</legend>
	<form method="POST" action="" enctype="multipart/form-data">
     	<!-- On limite le fichier à 100Ko -->
     	<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
     	Fichier : <input type="file" name="fichierCSV" />
     	<input type="hidden" name="actionPOST" value="uploadCSV">
     	<input type="submit" value="Envoyer le fichier" />
	</form>
</fieldset>
<p />
<fieldset>
	<legend>Exportation : MySQL 2 CSV</legend>
	{$contenuAnnuaire}
</fieldset>

<p />
EOT;
	

$fin_html = <<<EOT
	
	</body>
</html>
EOT;

//***************************************************************************************
// Partie Affichage
//***************************************************************************************
echo $debut_html.$menu.$body.$fin_html;

//***************************************************************************************
// Fermeture connexion SQL 
//***************************************************************************************

$dbh = NULL;
