<?php

// On ramène le fichier config.php
include('config.php');

if (session_status() == PHP_SESSION_NONE)
{
   // On commence la session
  session_start();
}

// On récupère les données users dans le formulaire
$user_id = $_SESSION['id'];
$mdp_id = $_POST['id'];

// On récupère les erreurs
$erreur = '';

// On créer la requête qui permet de supprimer la ligne dans la base
$sql = "DELETE FROM mdp WHERE id = ".$mdp_id;
$stmt = $dbh->prepare($sql);
$stmt->execute();

$_SESSION['erreur'] = $erreur;
include('welcome.php');

?>
