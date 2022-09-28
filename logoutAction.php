<?php

// On ramène le fichier config.php
include('config.php');

// On commence la session
session_start();

// On termine la session pour oublier les variables
session_destroy();

include ("index.html");

?>
