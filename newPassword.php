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
  <title>Ajouter un mot de passe - Passrapa</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<header class="button-header">
	<div class="button-div">
		<a href="welcome.php"><button class="button-head">Accueil</button></a>
		<a href="newPassword.php"><button class="button-head">Nouveau</button></a>
		<a href="infoAction.php"><button class="button-head">Informations</button></a>
		<a href="logoutAction.php"><button class="button-head">Déconnexion</button></a>
	</div>
  <h1>Passrapa</h1>
  <h2>Ajouter un mot de passe</h2>
</header>
<body>
 <br/>
	<div class="div_erreur">
	  <?php
	  	if(isset($_SESSION['erreur']))
	  	{
	    	echo "<div> " . $_SESSION['erreur'] . " </div>";
	    	$_SESSION['erreur'] = '';
	  	}
	  ?>
	</div>
	<div class="body_center">
	<fieldset class="form_inscription">
  <legend>Nouveau mot de passe</legend>
    <form action="newPasswordAction.php" method="post">
      <div class="form_info">
        <label for="username">Nom d'utilisateur</label>
        <br/>
        <input type="text" name="username" id="username" required>
      </div>
      <br/>
      <div class="form_info">
        <label for="mdp">Mot de passe</label>
        <br/>
        <input type="password" name="mdp" id ="mdp" required>
      </div>
      <br/>
      <div class="form_info">
        <label for="urlsite">Site web</label>
        <br/>
        <input type="text" name="urlsite" id ="urlsite">
      </div>
      <br/>
      <div class="form-inscription">
        <label for="lib">Libellé</label>
        <br/>
        <input type="text" name="lib" id="lib">
      </div>
      <br/>
      <div class="form-inscription">
        <label for="commentaire">Commentaire</label>
        <br/>
        <input type="longtext" name="commentaire" id="commentaire">
      </div>
      <br/>
      <div class="form-inscription">
        <label for="directory">Dossier</label>
        <br/>
        <select name="directory" id="directory">
          <option value="">--Choisir un répertoire--</option>
          <?php
            $sql = "SELECT directory.id, directory.lib FROM directory";
            $query = $dbh->query($sql);
            $directories = $query->fetchAll();

            foreach($directories as $directory)
            {
          ?>

          <option value="<?php echo $directory['id']; ?>" ><?php echo $directory['lib']; ?></option>

          <?php
            }
          ?>
        </select>
      </div>
      <br/>
      <div class="form-inscription">
        <label for="favoris">Favoris</label>
        <br/>
        <input type="checkbox" name="favoris" id="favoris"/>
      </div>
      <br/>
  	</fieldset>
  	<br/>
	  <div class="form-inscription">
		  <button type="submit">Ajouter</button>
		</div>
	</div>
</body>
<footer>
  <p class="footer">Solène CAGNOLATI - Florence EXTRAT © 2022</p>
</footer>
</html>