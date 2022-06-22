<?php

// On ramène le fichier config.php
include('config.php');

// On commence la session
session_start();

// On récupère les données user dans le formulaire
$nom = $_POST['lastname'];
$prenom = $_POST['firstname'];
$naissance = $_POST['birth'];
$mail = $_POST['email1'];
$mail2 = $_POST['email2'];
$telephone = $_POST['phone'];
// On hache le mot de passe
$mdp1 = $_POST['password1'];
$mdp_peppered1 = hash_hmac("sha256", $mdp1, $pepper);
$mdp_hashed1 = password_hash($mdp_peppered1, PASSWORD_DEFAULT);
$mdp2 = $_POST['password2'];
$mdp_peppered2 = hash_hmac("sha256", $mdp2, $pepper);
$mdp_hashed2 = password_hash($mdp_peppered2, PASSWORD_DEFAULT);

// On récupère les erreurs
$erreur = '';

// Si les mails ne correspondent pas
if($mail != $mail2)
{
   $erreur = "Les adresses mails ne correspondent pas.";
}
// Si les mots de passes ne correspondent pas
if($mdp1 != $mdp2)
{
   $erreur = "Les mots de passe ne correspondent pas.";
}
// Si le nom ou le prénom contient des chiffres
if(preg_match('/\d/', $nom) || preg_match('/\d/', $prenom))
{
   $erreur = "Le format du nom ou du prénom est incorrect.";
}

if($erreur != '')
{
   $_SESSION['erreur'] = $erreur;
   include('inscription.php');
}
// Sinon, on renvoie la page pour se connecter
else
{
   // On injecte les données dans la session
   $_SESSION['nom'] = $nom;
   $_SESSION['prenom'] = $prenom;
   $_SESSION['naissance'] = $naissance;
   $_SESSION['mail'] = $mail; 
   $_SESSION['telephone'] = $telephone;

   // On injecte les valeurs à la base
   $sql = "INSERT INTO utilisateur" . " (nom, prenom, naissance, mail, telephone, mdp) VALUES ('" . $nom . "', '" . $prenom . "', '" . $naissance . "', '" . $mail . "', '" . $telephone . "', '" . $mdp_hashed1 . "')";

   $stmt = $dbh->prepare($sql);
   $stmt->execute();

   // On récupère l'ID que l'on vient de créer
   $sql2 = "SELECT utilisateur.id FROM utilisateur WHERE utilisateur.nom = '" . $nom . "' AND utilisateur.prenom = '" . $prenom . "' AND utilisateur.naissance = '".$naissance."' AND utilisateur.mail = '" . $mail . "' AND utilisateur.telephone = '" . $telephone . "' AND utilisateur.mdp = '" . $mdp_hashed1 ."'";

   $query = $dbh->query($sql2);
   $user = $query->fetch();

   $_SESSION['id'] = $user['id'];

   $_SESSION['erreur'] = '';
   include('welcome.php');
}

?>
