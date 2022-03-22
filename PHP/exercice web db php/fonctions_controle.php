<?php
//**************************************
// Programmation Web IG1
// NOM 		: 
// PRENOM 	:
//**************************************

//#######################################################################################
// uploadCSV($file)																		#
// Entrée : array $file = tableau contenant le contenu et les infos du fichier uploadé	#
// Sortie : array = retourne un tableau contenant l'état et le message					#
//#######################################################################################
function uploadCSV(&$file)
{
	$retour = array();
	$retour['state'] = true;
	$retour['message'] = 'ras';
	
	$dossier = 'upload/';
	$fichier = basename($file['name']);
	$taille_maxi = 100000;
	$taille = filesize($file['tmp_name']);
	$extensions = array('.csv', '.txt');
	$extension = strrchr($file['name'], '.'); 
	//Début des vérifications de sécurité...
	if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
	{
		 $retour['message'] = 'Vous devez uploader un fichier de type txt ou csv';
		 $retour['state'] = false;
	}
	if($taille>$taille_maxi)
	{
		 $retour['message'] = 'Le fichier est trop gros...';
		 $retour['state'] = false;
	}
	if($retour['state'] !== false) //S'il n'y a pas d'erreur, on upload
	{
		 //On formate le nom du fichier ici...
		 $fichier = strtr($fichier, 
			  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
			  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		 $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
		 $file['name'] = $fichier; // le nom du fichier a été modifié alors on le met à jour dans le tableau $file
		 if(move_uploaded_file($file['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
		 {
		 	$retour['state'] = true;
			$retour['message'] =  'Upload effectué avec succès !';
		 }
		 else //Sinon (la fonction renvoie FALSE).
		 {
		 	$retour['state'] = false;
			$retour['message'] = 'Echec de l\'upload !';
		 }
	}
	return $retour;
}


//#######################################################################################
// formulaireImportation($_nom_fichier,$_pageEnCours)									#
// Entrée(s) : string $_nom_fichier = nom du fichier à manipuler						#
//			   string $_pageEnCours = la page php en cours d'exécution					#
// Sortie	 : string = retourne le formulaire avec les personnes pour importation		#
//#######################################################################################
function formulaireImportation($_nom_fichier,$_pageEnCours)
{
	//TODO
}


//#######################################################################################
// importer($_tableau_personnes,$_dbh)													#
// Entrée(s) : array $_tableau_personnes = tableau de personnes sérialisées				#
//			   handle $_dbh = objet de connexion à la DB								#
// Sortie	 : string = retourne message d'erreur										#
//#######################################################################################
function importer($_tableau_personnes,$_dbh)
{
	//TODO
}

//#######################################################################################
// formulaireExportation($_dbh, $_pageEnCours)											#
// Entrée(s) : handle $_dbh = objet de connexion à la DB								#
//			   string $_pageEnCours = la page php en cours d'exécution					#
// Sortie	 : string = retourne le formulaire avec les personnes pour exportation		#
//#######################################################################################
function formulaireExportation($_dbh,$_pageEnCours)
{
	//TODO
}

//#######################################################################################
// exporter($_personnes,$_dbh,$_nom_fichier_csv)										#
// Entrée(s) : array  $_personnes = ???													#
//			   handle $_dbh = objet de connexion à la DB								#
// Sortie	 : string = retourne message erreur											#
//#######################################################################################
function exporter($_personnes,$_dbh,$_nom_fichier_csv)
{
	//TODO
}