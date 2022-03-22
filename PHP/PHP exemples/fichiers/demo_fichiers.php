<!DOCTYPE html>
<html>
	<head>
		<title>Fichiers</title>
		<meta charset="UTF-8" />
		<meta name="author" content="votre nom" />
	</head>
	<body>



<?php
//######################################################################################
// LECTURE
//######################################################################################
echo '<h1>LECTURE</h1>';
//**************************************************************************************
// string file_get_content(string filename)
//**************************************************************************************
echo '<hr /><h2>string file_get_content(string filename)</h2><hr />';

$sContenu_fichier = file_get_contents('monfichier.txt');
echo $sContenu_fichier;

//**************************************************************************************
// int readfile ( string filename )
//**************************************************************************************
echo '<hr /><h2>int readfile ( string filename )</h2><hr />';

if ($iNbOctetsLus = readfile('monfichier.txt')) 
{
	// Le fichier a été correctement affiché
	echo '<br />Nombre d\'octets lus : '.$iNbOctetsLus;
} 
else 
{
	// Rien n’a été affiché
}

//**************************************************************************************
// array file ( string filename )
//**************************************************************************************
echo '<hr /><h2>array file ( string filename )</h2><hr />';

$aTab = file('monfichier.txt');
foreach ($aTab as $iLigne_num => $sLigne) 
{
    echo "Ligne #<b>{$iLigne_num}</b> : " . $sLigne . "<br />\n";
}
echo '<pre>';
print_r($aTab);
echo '</pre>';

//**************************************************************************************
// resource fopen ( string filename, string mode )
// string fgets ( resource handle [, int length] )
//**************************************************************************************
echo '<hr /><h2>resource fopen ( string filename, string mode ) <br />string fgets ( resource handle [, int length] )</h2><hr />';

// on ouvre le fichier en lecture seule
$rFichier = @fopen('monfichiergfgdsfg.txt', "rb");	//@ permet de ne pas faire afficher l'erreur
if($rFichier) // si l'ouverture se passe bien
{
	$iLigne_num = 0;
	while (($sLigne = fgets($rFichier,10)) !== false) // fgetss supprime les balises HTML et les octets nuls
	{
		echo 'Ligne #<b>'.$iLigne_num++.'</b> :' . $sLigne . "<br />\n";
	} 
	fclose($rFichier) ;
}
else
{
	// pour DEBUG
	echo 'erreur ouverture fichier';
}

//**************************************************************************************
// resource fopen ( string filename, string mode )
// string fread ( resource handle, int length )
//**************************************************************************************
echo '<hr /><h2>resource fopen ( string filename, string mode )<br />string fread ( resource handle, int length )</h2><hr />';

$sNom_fichier = 'monfichier.txt';
// on ouvre le fichier en lecture seule
$rFichier = fopen($sNom_fichier, "rb"); 
if($rFichier !==false)
{
	$sContenu = fread($rFichier, /*filesize($sNom_fichier)*/ 10000);
	echo $sContenu;
	fclose($rFichier);
}
else
{
	// pour DEBUG
	echo 'erreur ouverture fichier';
}


//**************************************************************************************
// resource fopen ( string filename, string mode )
// string fgetc ( resource handle )
//**************************************************************************************
echo '<hr /><h2>resource fopen ( string filename, string mode )<br />string fgetc ( resource handle )</h2><hr />';

$sNom_fichier = 'monfichier.txt';
// on ouvre le fichier en lecture seule
$rFichier = fopen($sNom_fichier, "rb"); 
if($rFichier)
{
	while (($cChar = fgetc($rFichier)) !== false) 
	{
    	echo $cChar;
	}
	fclose($rFichier);
}
else
{
	// pour DEBUG
	echo 'erreur ouverture fichier';
}


//**************************************************************************************
// resource fopen ( string filename, string mode )
// array fgetcsv ( resource handle [, int length=0, string delimiter=‘,’ [, string enclosure=‘’’ [, string escape=‘\\’ ]]])
//**************************************************************************************
echo '<hr /><h2>resource fopen ( string filename, string mode )<br />array fgetcsv ( resource handle [, int length=0, string delimiter=‘,’ [, string enclosure=‘’’ [, string escape=‘\\’ ]]])</h2><hr />';

$iColonne = 1;
if (($rHandle = fopen("test_CSV.csv", "rb")) !== FALSE) 
{
    while (($aData = fgetcsv($rHandle, 1000, ";")) !== FALSE)  // on lit maximum 1000 caractères par ligne, le délimiteur de champs est le point-virgule 
    {
		echo '<pre>';
		print_r($aData);
		echo '</pre>';
		/*
        $iNum = count($aData);
        echo "<p> $iNum champs à la ligne $iColonne: <br /></p>\n";
        $iColonne++;
        for ($c=0; $c < $iNum; $c++) 
        {
            echo $aData[$c] . "<br />\n";
        }*/
    }
    fclose($rHandle);
}

//######################################################################################
//ECRITURE
//######################################################################################
echo '<h1>ECRITURE</h1>';

//**************************************************************************************
// string file_put_content(string filename, string data [, int flags])
//**************************************************************************************
echo '<hr /><h2>int file_put_contents ( string filename , mixed data , [int flags] )</h2><hr />';

$sVar = 'Bravo les gars !m';
$iNbCaracteres = file_put_contents('monfichierecritureqsqs.txt', "dghxdf $sVar"  );
if($iNbCaracteres !== false)
{
	echo 'nb caractères écrits : '.$iNbCaracteres.'<br />';
}
else
{
	// DEBUG
	echo 'erreur écriture';
}



//**************************************************************************************
// resource fopen ( string filename, string mode )
// int fwrite ( resource handle, string string [, int length] )
// ecrasement
//**************************************************************************************
echo '<hr /><h2>resource fopen ( string filename, string mode )<br />int fwrite ( resource handle, string string [, int length] )
<br />mode = write</h2><hr />';

// Ouvre le fichier
// Écrase le fichier actuel s’il existe ou le crée sinon 
$rFichier = fopen("monfichier2.txt", "wb");
if($rFichier)
{
	// Insère le texte « PHP 5 » dans le fichier
	$iNbCaracteres = fwrite( $rFichier , "PHP 5\n" ,2 ) ;
	if($iNbCaracteres !== false) // si l'écriture se passe bien
	{
		echo 'nb caractères écrits : '.$iNbCaracteres.'<br />';
	}
	else
	{
		// DEBUG
		echo 'erreur écriture';
	}
	fclose($rFichier);
}

//**************************************************************************************
// resource fopen ( string filename, string mode )
// int fwrite ( resource handle, string string [, int length] )
// ajouter à la suite
//**************************************************************************************
echo '<hr /><h2>resource fopen ( string filename, string mode )<br />int fwrite ( resource handle, string string [, int length] )
<br />mode = append</h2><hr />';

// Ouvre le fichier
// ajoute au fichier actuel s’il existe ou le crée sinon 
$rFichier = fopen("monfichier3.txt", "ab");
if($rFichier)
{
	// Insère le texte « PHP 5 » dans le fichier
	$iNbCaracteres = fwrite( $rFichier , "Et si on allait boire un verre !!\n", 21 ) ;
	if($iNbCaracteres !== false) // si l'écriture se passe bien
	{
		echo 'nb caractères écrits : '.$iNbCaracteres.'<br />';
	}
	else
	{
		// DEBUG
		echo 'erreur écriture';
	}
	fclose($rFichier);
}



//######################################################################################
//POINTEURS (lecture / ecriture)
//######################################################################################
echo '<h1>POINTEURS LECTURE/ECRITURE</h1>';


//**************************************************************************************
// resource fopen ( string filename, string mode )
// string fgets ( resource handle [, int length] )
// bool rewind ( resource handle )
//**************************************************************************************
echo '<hr /><h2>resource fopen ( string filename, string mode ) <br />string fgets ( resource handle [, int length] )<br />bool rewind ( resource handle )</h2><hr />';

$rFichier = fopen("monfichier.txt", "rb");
if($rFichier)
{
	// On affiche le fichier ligne par ligne 
	while($sLigne = fgets( $rFichier , 1024 ))
	{
		echo $sLigne ; 
	}
	// On se place au début :
	if(rewind($rFichier))
	{
		// On réaffiche la première ligne
		$sLigne1 = fgets( $rFichier , 3 ); 
		echo '<br />'.$sLigne1 ;
	}
	else
	{
		// debug
		echo 'erreur de positionnement de pointeur de lecture!';
	}
	fclose($rFichier);
}


//**************************************************************************************
// resource fopen ( string filename, string mode )
// string fgetc ( resource handle )
// int ftell ( resource handle )
// int fseek ( resource handle , int offset [, int whence = SEEK_SET ] )
// ATTENTION au codage utilisé : le déplacement du curseur se mesure en octet, hors
// certains codages nécessitent plusieurs octets pour représenter un caractère
// ex : en UTF-8 : "é" est codé sur 2 octets : C3A9
//                 "a" est codé sur 1 octet  : 61
//**************************************************************************************
echo '<hr /><h2>resource fopen ( string filename, string mode ) <br />string fgetc ( resource handle )<br />int ftell ( resource handle )<br />int fseek ( resource handle , int offset [, int whence = SEEK_SET ] )</h2><hr />';

// On ouvre le fichier
$rFichier = fopen("monfichierseek.txt", "rt") ;
if($rFichier)
{
	// On se positionne au 12e octet
	fseek( $rFichier, 12 );
	echo 'avant lecture la position est : '.ftell($rFichier).'<br />'; // on affiche la position
	echo '12è octet : '.fgetc($rFichier).'<br />';
	// On se positionne 10 octets plus loin, donc au 23è car la lecture du caractère précédent a entrainé le déplacement du pointeur de lecture
	echo 'après lecture la position devient : '.ftell($rFichier).'<br />'; // on affiche la nouvelle position
	fseek( $rFichier, 10, SEEK_CUR ) ;
	echo '12+10(+1) è octet : '.fgetc($rFichier).'<br />';
	// Puis 20 octets avant la fin du fichier
	fseek( $rFichier, -20, SEEK_END ) ;
	echo 'fin-20 è octet : '.fgetc($rFichier).'<br />';
	// On revient au 12e octet à partir du début
	fseek( $rFichier, 12, SEEK_SET ) ;
	echo '12è octet : '.fgetc($rFichier).'<br />';
	fclose($rFichier);
}
else
{
	//debug
	echo 'erreur ouverture fichier';
}




//**************************************************************************************
// DIVERS
//**************************************************************************************

// Dans certains cas l'écriture de données dans un fichier ne se fait pas directement
// si le fichier est utilisé à plusieurs endroits l'OS attend le bon moment pour écrire
// on peut forcer l'écriture avec :
// fflush($rFichier);

// Lors du parcours d'un fichier, il est possible de savoir si on atteint la fin de
// celui-ci sans effectuer de lecture grâce à la méthode :
// feof();

//**************************************************************************************
// ACCES DIRECT TYPE SIMPLE
// string pack ( string $format [, mixed $args] )
// array unpack ( string $format , string $sData )
//**************************************************************************************
echo '<hr /><h2>string pack ( string $format [, mixed $args] )<br />array unpack ( string $format , string $sData )</h2><hr />';
$aTabInt = array(12,8,14,15);
$rFichier = fopen("ecriture_direct.txt","w+b");
if($rFichier)
{
	// on écrit les valeurs du tableau sous leur forme binaire (ici un entier qui sera codé sur 
	foreach($aTabInt as $value)
	{
		$tt = pack("I",$value); // pack() encode la valeur $value selon le premier paramètre
		echo fwrite($rFichier,$tt);
	}
	
	rewind($rFichier);
	// on souhaite accéder au 3è entier
	$iPosition = 3;
	$iSizeofInt = 4; // 
	fseek($rFichier,($iPosition-1)*$iSizeofInt);
	echo 'position actuelle : '.ftell($rFichier).'<br />';
	if($iEntier_brut = fread($rFichier,$iSizeofInt))
	{
		$iEntier = unpack("I",$iEntier_brut);
		echo 'position '.$iPosition.' => valeur entière = '.$iEntier[1].'<br />';
	}
	else
	{
		//debug
		echo 'erreur de lecture';
	}
	fclose($rFichier);
	
}



//**************************************************************************************
?>


	</body>
</html>



