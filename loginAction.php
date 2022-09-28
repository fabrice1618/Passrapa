<?php

// On ramène le fichier config.php
include('config.php');

// On commence la session
session_start();

// On récupère les données user dans le formulaire
$mail = $_POST['email'];
$mdp = $_POST['password'];
$mdp_peppered = hash_hmac("sha256", $mdp, $pepper);

// On vérifie si un utilisateur existe avec le mail renseigné
$sql = "SELECT utilisateur.id, utilisateur.mdp FROM utilisateur WHERE utilisateur.mail = '" . $mail . "'";
$query = $dbh->query($sql);
$user = $query->fetch();

// Si le set de données existe, on vérifie que le mdp est juste
if($user != '')
{
	// On récupère son mot de passe
	$mdp_hashed = $user['mdp'];

	// Si le MDP est juste, on redirige vers la page d'accueil et on charge les mdp de l'utilisateur
	if(password_verify($mdp_peppered, $mdp_hashed))
	{
		// On injecte les données dans la session
		$_SESSION['id'] = $user['id'];
		$_SESSION['mail'] = $mail;
		$_SESSION['mdp'] = $mdp;
		
		$_SESSION['erreur'] = '';
		include('welcome.php');
	}
	// Sinon, on renvoie la page pour se connecter
	else
	{
		$_SESSION['erreur'] = "Mot de passe incorrect";
		include('index.html');
	}
	
}
// Sinon, on renvoie la page pour se connecter
else
{
	$_SESSION['erreur'] = "Adresse mail non reconnue, veuillez vérifier votre saisie ou vous inscrire";
	include('index.html');
}

?>
