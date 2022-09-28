<?php

// Pepper hash
$pepper = 'c1isvFdxMDdmjOlvxpecFw';

// On se connecte à la base de données
$user = 'passrapa';
$pass = 'toto';

try
{
    // On se connecte à MySQL
    $dbh = new PDO('mysql:host=localhost;dbname=passrapa', $user, $pass);
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
    exit('Erreur : '.$e->getMessage());
}

?>
