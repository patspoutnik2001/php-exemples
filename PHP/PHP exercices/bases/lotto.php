<?php
//*****************************************
// 
//*****************************************
$sDebutHtml = <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<title>Lotto</title>
		<meta charset="utf-8" />
	</head>
	<body>
EOT;

$sContenuBody = '';

$sFinHtml = <<<EOT
	</body>
</html>
EOT;

//********************************************************************
// début du travail
//********************************************************************

$sContenuBody .= '<form action="" method="get">';
$sContenuBody .= '<table border="1">';
$iCompteur = 0;
// 9 lignes
for($iLigne=0 ; $iLigne<9 ; $iLigne++)
{
	$sContenuBody .= '<tr>';
	for($iColonne=0 ; $iColonne<5 ; $iColonne++)
	{
		$iCompteur++;
		$sContenuBody .= '<td>';
		$sContenuBody .= '<input type="checkbox" name="lotto[]" value="'.$iCompteur.'" '.check($iCompteur).'/>'.$iCompteur;
		$sContenuBody .= '</td>';
	}
	$sContenuBody .= '</tr>'."\n";
}
$sContenuBody .= '</table>';
//$sContenuBody .= '<input type="hidden" name="validation" />';
$sContenuBody .= '<input type="submit" name="validation" value="gogogo"/>';
$sContenuBody .= '</form>';

//**********************************************************
// action
//**********************************************************
// si le formulaire a été validé et que des cases ont été cochées alors...
if(isset($_GET['validation']) && !empty($_GET['lotto'])) // attention à la fonction empty : voir doc php => Aucune alerte n'est générée si la variable n'existe pas. Cela signifie que empty() est strictement équivalent à !isset($var) || $var == false. 
{
	// Si on a coché 6 numéros alors OK
	if(count($_GET['lotto'])==6)
	{
		$aGrilleGagnante = generer6Nb();
		$aMesNumerosGagnant = array();
		foreach($_GET['lotto'] as $iMonNumero)
		{
			if(in_array($iMonNumero,$aGrilleGagnante))
			{
				$aMesNumerosGagnant[] = $iMonNumero;
			}
		}
		$sContenuBody .= 'Le tirage gagnant : ';
		foreach($aGrilleGagnante as $iLeNumeroGagnant)
		{
			$sContenuBody .= $iLeNumeroGagnant.' ';
		}
		$sContenuBody .= '<br />';
		
		$sContenuBody .= 'vous avez '.count($aMesNumerosGagnant).' bon(s) numéro(s)<br />';
		foreach($aMesNumerosGagnant as $iLeNumeroGagnant)
		{
			$sContenuBody .= $iLeNumeroGagnant.' ';
		}
		$sContenuBody .= '<br />';
		
	}
	// Sinon message d'erreur
	else
	{
		$sContenuBody .= 'Veuillez cocher 6 cases SVP !';
	}
}



// affichage
echo $sDebutHtml.$sContenuBody.$sFinHtml;

//****************************************************
// mes fonctions
//****************************************************
//fonction de génération de 6 nombres aléatoires
// retourne un tableau de 6 nombres sans doublons
function generer6Nb()
{
	$aNbGeneres = array();
	$iCompteur = 0;
	while($iCompteur<6)
	{
		$iNb = rand(1,45);
		if(!in_array($iNb,$aNbGeneres))
		{
			$aNbGeneres[]=$iNb;
			$iCompteur++;
		}
	}
	return $aNbGeneres;
}


// check case cochée
// retourne une chaine
function check($iNb)
{
	if(isset($_GET['validation']) && !empty($_GET['lotto']))
	{
		if(in_array($iNb,$_GET['lotto']))
		{
			return 'checked';
		}
		else
		{
			return '';
		}
	}
}









