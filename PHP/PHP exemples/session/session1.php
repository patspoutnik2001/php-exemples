<?php
session_start();
$_SESSION['nom'] = 'med';
$_SESSION['prenom'] = 'fab';

echo 'session ok';