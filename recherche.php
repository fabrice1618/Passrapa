<?php

// On ramène le fichier config.php
include('config.php');

if (session_status() == PHP_SESSION_NONE)
{
	// On commence la session
  session_start();
}

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Informations - Passrapa</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<header class="button-header">
	<div class="button-div">
		<a href="welcome.php"><button class="button-head">Accueil</button></a>
		<a href="recherche.php"><button class="button-head">Recherche</button></a>
		<a href="newPassword.php"><button class="button-head">Nouveau</button></a>
		<a href="info.php"><button class="button-head">Informations</button></a>
		<a href="logoutAction.php"><button class="button-head">Déconnexion</button></a>
		<h1>Passrapa</h1>
		<h2>Rechercher un mot de passe</h2>
	</div>
</header>
<body>
	<div class="body_recherche">
		<?php
			//$password = $bdh->query('SELECT lib FROM mdp ORDER BY id DESC');
		?>
		<fieldset class="form_inscription">
		<legend>Recherche de mot de passe</legend>
		<form action="rechercheAction.php" method="post">
		<div class="form_info">	
			<br>
			<label for="recherche">Recherche : </label>
			<br>
			<input type="search" name="recherche"></input>	
		</div>
		<br>
		</form>
		</fieldset>
	</div>
</body>
<footer>
  <p class="footer">Solène CAGNOLATI - Florence EXTRAT © 2022</p>
</footer>
</html>