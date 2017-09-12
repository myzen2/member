<?php
session_start();
require '../tool/connect.php';
require 'menu.php';
$pseudo = $_SESSION['pseudo'];
?>

<h1>Bienvenue sur votre espace personnel <?= $pseudo ?></h1>
