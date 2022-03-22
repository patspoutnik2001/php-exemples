<?php
session_start();
echo 'Bonjour '.$_SESSION['nom'];
session_destroy();