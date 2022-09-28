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
$mdp = $_POST['mdp'];
$urlsite = $_POST['urlsite'];
$username = $_POST['username'];
$directory = $_POST['directory'];
$commentaire = $_POST['commentaire'];
$mdp_id = $_POST['id'];

// On récupère les erreurs
$erreur = '';

// On créer la requête qui permet d'insérer les données dans la base
$sql = "UPDATE mdp SET mdp.mdp = '".$mdp."', mdp.urlsite = '".$urlsite."', mdp.username = '".$username."', mdp.directory_id = ".$directory.", mdp.commentaire = '".$commentaire."' WHERE mdp.id = ".$mdp_id;

// On exécute
$stmt = $dbh->prepare($sql);
$stmt->execute();


$_SESSION['erreur'] = $erreur;
include('welcome.php');

?>
