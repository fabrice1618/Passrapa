<?php

if (session_status() == PHP_SESSION_NONE)
{
	// On commence la session
  session_start();
}

// On ramène le fichier config.php
include('config.php');

// On récupère les mdp de l'utilisateur
$sql = 'SELECT
		mdp.id, mdp.username, mdp.mdp, mdp.urlsite, mdp.lib as mdplib, mdp.favoris, mdp.commentaire,
		directory.lib as directorylib
		FROM mdp
			LEFT JOIN directory ON (directory.id = mdp.directory_id)
		WHERE mdp.utilisateur_id = '
		.$_SESSION['id'].
		' GROUP BY mdp.id';

$query = $dbh->query($sql);
$mdp_user = $query->fetch();

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Bienvenue - Passrapa</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<header class="button-header">
	<div class="button-div">
		<a href="welcome.php"><button class="button-head">Accueil</button></a>
		<a href="recherche.php"><button class="button-head">Recherche</button></a>
		<a href="newPassword.php"><button class="button-head">Nouveau</button></a>
		<a href="info.php"><button class="button-head">Informations</button></a>
		<a href="logoutAction.php"><button class="button-head">Déconnexion</button></a>
	</div>
  <h1>Passrapa</h1>
  <h2>Gestionnaire de mots de passe</h2>
  <h3>Bienvenue sur votre espace</h3>
</header>
<body>
	<div class="body_welcome">

<?php

	// On récupère le nom et le prénom de l'user
	$sql = "SELECT utilisateur.id, utilisateur.prenom, utilisateur.nom, utilisateur.naissance, utilisateur.telephone, utilisateur.mail FROM utilisateur WHERE utilisateur.id = '" . $_SESSION['id'] . "'";

	$query = $dbh->query($sql);
	$user = $query->fetch();

	$_SESSION['prenom'] = $user['prenom'];
	$_SESSION['nom'] = $user['nom'];
	$_SESSION['naissance'] = $user['naissance'];
	$_SESSION['telephone'] = $user['telephone'];
	$_SESSION['mail'] = $user['mail'];

	echo "<h2>Bienvenue " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . " !</h2>";

?>

	</div>
</body>
<footer>
  <p class="footer">Solène CAGNOLATI - Florence EXTRAT © 2022</p>
</footer>
</html>