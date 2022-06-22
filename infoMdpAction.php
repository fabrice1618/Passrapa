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

// On récupère les données user dans le formulaire
$mdp = $_POST['password'];
$mdp_peppered = hash_hmac("sha256", $mdp, $pepper);
// On hache le mot de passe
$mdp1 = $_POST['password1'];
$mdp_peppered1 = hash_hmac("sha256", $mdp1, $pepper);
$mdp_hashed1 = password_hash($mdp_peppered1, PASSWORD_DEFAULT);
$mdp2 = $_POST['password2'];
$mdp_peppered2 = hash_hmac("sha256", $mdp2, $pepper);
$mdp_hashed2 = password_hash($mdp_peppered2, PASSWORD_DEFAULT);

// On vérifie si un utilisateur existe avec le mail renseigné
$sql = "SELECT utilisateur.id, utilisateur.mdp FROM utilisateur WHERE utilisateur.id = '" . $_SESSION['id'] . "'";
$query = $dbh->query($sql);
$user = $query->fetch();

// On récupère son mot de passe
$mdp_hashed = $user['mdp'];

// Si l'ancien mot de passe correspond, on vérifie que les deux MDP correspondent
if(password_verify($mdp_peppered, $mdp_hashed))
{
   // Si les mots de passes ne correspondent pas
   if($mdp1 == $mdp2)
   {
      // On injecte les valeurs à la base
      $sql = "UPDATE utilisateur SET utilisateur.mdp = '" . $mdp_hashed1 . "' WHERE utilisateur.id = '" . $_SESSION['id'] . "'";

      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      $erreur = 'Mot de passe mise à jour !';
   }
   else
   {
      $erreur = "Les nouveaux mots de passe ne correspondent pas.";
   }
}
else
{
   $erreur = "L'ancien mot de passe ne correspond pas";
   
}

$_SESSION['erreur'] = $erreur;
include('info.php');
