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
		<a href="newPassword.php"><button class="button-head">Nouveau</button></a>
		<a href="infoAction.php"><button class="button-head">Informations</button></a>
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
	<div class="body_mdp">

<?php
	// On récupère les MDP de l'utilisateur
	$sql = "SELECT mdp.id as mdp_id, mdp.username, mdp.mdp, mdp.urlsite, mdp.lib as mdp_lib, mdp.favoris, mdp.commentaire, directory.id as directory_id, directory.lib as directory_lib FROM mdp LEFT OUTER JOIN directory ON (directory.id = mdp.directory_id) JOIN utilisateur ON (utilisateur.id = mdp.utilisateur_id) WHERE utilisateur.id = ".$_SESSION['id']." ORDER BY mdp.favoris DESC, mdp.lib ASC";
	$query = $dbh->query($sql);
	$mdps = $query->fetchAll();

	if(!empty($mdps))
	{
		foreach($mdps as $mdp)
		{
?>


		<div class="body_mdp_flex">
			<fieldset class="form_inscription">
			<legend><?php echo $mdp['mdp_lib']; ?></legend>
			<form action="modifMdp.php" method="post">
				<div class="form-inscription">
					<label for="username">Utilisateur</label>
					<input type="text" name="username" value="<?php echo $mdp['username']; ?>">
				</div>
				<br>
				<div class="form-inscription">
					<label for="mdp">Mot de passe</label>
					<input type="password" name="mdp" value="<?php echo $mdp['mdp']; ?>">
				</div>
				<br>
				<div class="form-inscription">
					<label for="urlsite">URL du site</label>
					<input type="text" name="urlsite" value="<?php echo $mdp['urlsite']; ?>">
				</div>
				<br>
				<div class="form-inscription">
					<label for="directory">Dossier</label>
					<select name="directory" id="directory">
					<option value="">--Aucun répertoire--</option>
					<?php
						$sql = "SELECT directory.id, directory.lib FROM directory";
						$query = $dbh->query($sql);
						$directories = $query->fetchAll();

						foreach($directories as $directory)
						{
							$selected = "";
							if($mdp['directory_id'] == $directory['id'])
							{
								$selected = "selected";
							}
					?>

					<option value="<?php echo $directory['id']; ?>" <?php echo $selected; ?> ><?php echo $directory['lib']; ?></option>

					<?php
						}
					?>
					</select>
				</div>
				<br>
				<div class="form-inscription">
					<label for="commentaire">Commentaire</label>
					<input type="text" name="commentaire" value="<?php echo $mdp['commentaire']; ?>">
				</div>
				<br>
				<div class="form-inscription">
					<input name="id" type="hidden" value="<?php echo $mdp['mdp_id']; ?>" />
					<button type="submit">Modifier</button>
					</form>
					<form action="supprMdp.php" method="post">
					<input name="id" type="hidden" value="<?php echo $mdp['mdp_id']; ?>" />
					<button type="submit">Supprimer</button>
					</form>
				</div>
			<br>
			</form>
			</fieldset>
		</div>


<?php
		}
	}

?>

	</div>

</body>
<footer>
  <p class="footer">Solène CAGNOLATI - Florence EXTRAT © 2022</p>
</footer>
</html>