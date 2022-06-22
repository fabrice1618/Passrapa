<?php

// On ramène le fichier config.php
include('config.php');

if (session_status() == PHP_SESSION_NONE)
{
   // On commence la session
  session_start();
}

// On récupère les données users dans le formulaire
$id = $_SESSION['id'];
$nom = $_POST['lastname'];
$prenom = $_POST['firstname'];
$naissance = $_POST['birth'];
$mail = $_POST['email1'];
$telephone = $_POST['phone'];

// On récupère les erreurs
$erreur = '';

// Si le nom ou le prénom contient des chiffres
if(preg_match('/\d/', $nom) || preg_match('/\d/', $prenom))
{
   $erreur = "Le format du nom ou du prénom est incorrect.";
}
// Sinon, on renvoie la page des informations
else
{
   // On injecte les valeurs à la base
   $sql = "UPDATE utilisateur SET utilisateur.prenom = '" . $prenom . "', utilisateur.nom = '" . $nom . "', utilisateur.naissance = '" . $naissance . "', utilisateur.mail = '" . $mail . "', utilisateur.telephone = '" . $telephone . "' WHERE utilisateur.id = " . $id;

   $stmt = $dbh->prepare($sql);
   $stmt->execute();

   $erreur = 'Informations mises à jour !';
}

$_SESSION['erreur'] = $erreur;
include('info.php');

?>
