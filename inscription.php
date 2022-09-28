<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Inscription - Passrapa</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<header class="page-header">
  <h1>Passrapa</h1>
  <h2>Gestionnaire de mots de passe</h2>
  <h3>Inscription</h3>
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
  <br/>
  <fieldset class="form_inscription">
  <legend>Inscription</legend>
    <form action="inscriptionAction.php" method="post">
      <div class="form-inscription">
        <label for="lastname">Nom</label>
        <br/>
        <input type="text" name="lastname" id="lastname" required>
      </div>
      <br/>
      <div class="form-inscription">
        <label for="firstname">Prénom</label>
        <br/>
        <input type="text" name="firstname" id ="firstname" required>
      </div>
      <br/>
      <div class="form-inscription">
        <label for="birth">Date de naissance</label>
        <br/>
        <input type="date" name="birth" id="birth" required>
      </div>
      <br/>
      <div class="form-inscription">
        <label for="email1">Adresse mail</label>
        <br/>
        <input type="email" name="email1" id="email1" required>
      </div>
      <br/>
      <div class="form-inscription">
        <label for="email2">Confirmez votre adresse mail</label>
        <br/>
        <input type="email" name="email2" id="email2" required>
      </div>
      <br/>
      <div class="form-inscription">
        <label for="phone">Téléphone</label>
        <br/>
        <small>Format : 0612345678</small>
        <br/>
        <input type="tel" name="phone" id="phone" 
        pattern="0[0-9]{9}" required>
      </div>
      <br/>
      <div class="form-inscription">
        <label for="password1">Mot de passe</label>
        <br/>
        <input type="password" name="password1" id="password1" required>
      </div>
      <br/>
      <div class="form-inscription">
        <label for="password2">Confirmez votre mot de passe</label>
        <br/>
        <input type="password" name="password2" id="password2" required>
      </div>
      <br/>
  </fieldset>
  <br/>
  <div class="form_information">
      <div class="form-inscription">
        <input type="checkbox" name="checkbox" id="checkbox" required>
        <label for="checkbox">Je certifie que les informations ci-dessus sont exactes.</label>
      </div>
      <br/>
      <div class="form-inscription">
        <input type="checkbox" name="checkbox" id="checkbox" required>
        <label for="checkbox">J'ai lu et j'accepte les conditions d'inscriptions.</label>
      </div>
      <br/>
  </div>
  <div class ="form_validation">
      <div class="form-inscription">
        <button type="submit">M'inscrire</button>
        <a href="index.html"><button type="button">J'ai déjà un compte</button></a>
      </div>
      <br/>
    </div>
  </form>
</body>
<footer>
  <p class="footer">Solène CAGNOLATI - Florence EXTRAT © 2022</p>
</footer>
</html>
