<?php

// On ramène le fichier config.php
include('config.php');

if (session_status() == PHP_SESSION_NONE)
{
   // On commence la session
  session_start();
}

// On initialise les erreurs
$erreur = '';
?>