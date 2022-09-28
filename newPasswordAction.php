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

// On récupère les informations du formulaire
$username = $_POST['username'];
$mdp = $_POST['mdp'];
$urlsite = $_POST['urlsite'];
$lib = $_POST['lib'];
$directory = $_POST['directory'];
$commentaire = $_POST['commentaire'];
if(isset($_POST['favoris']))
{
  $favoris = 1;
}
else
{
  $favoris = 0;
}
// On hache le mot de passe
$mdp_peppered = hash_hmac("sha256", $mdp, $pepper);
$mdp_hashed = password_hash($mdp_peppered, PASSWORD_DEFAULT);

// On injecte les valeurs à la base
if(!empty($directory))
{
  $sql = "INSERT INTO mdp" . " (username, mdp, urlsite, lib, favoris, utilisateur_id, directory_id, commentaire) VALUES ('" . $username ."', '" . $mdp_hashed ."', '" . $urlsite ."', '" . $lib ."', '" . $favoris ."', '" . $_SESSION['id'] ."', '" . $directory ."', '" . $commentaire ."')";
}
else
{
  $sql = "INSERT INTO mdp" . " (username, mdp, urlsite, lib, favoris, utilisateur_id, commentaire) VALUES ('" . $username ."', '" . $mdp_hashed ."', '" . $urlsite ."', '" . $lib ."', '" . $favoris ."', '" . $_SESSION['id'] ."', '" . $commentaire ."')";
}
$stmt = $dbh->prepare($sql);
$stmt->execute();

$_SESSION['erreur'] = $erreur;
include('welcome.php');

?>