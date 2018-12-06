<?php

require 'config.php';

// Connexion à la base de données
$dbhost = 'mysql-davidlaroche.alwaysdata.net';
$dbname = 'davidlaroche_senscritik';
$dbuser = '113162_admin';
$dbpassword = '113162_admin';

$database = new PDO('mysql:host=mysql-davidlaroche.alwaysdata.net;dbname=davidlaroche_senscritik', '113162_admin', '113162_admin');
$database->exec('SET CHARACTER SET utf8');

function getDatabase() {
    $database = new PDO('mysql:host=mysql-davidlaroche.alwaysdata.net;dbname=davidlaroche_senscritik', '113162_admin', '113162_admin');
    $database->exec('SET CHARACTER SET utf8');
    return $database;
}

setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

// Affiche le block d'un fichier PHP
function getBlock($file, $data = [])
{
    require ROOTPATH . '/' . $file . '.php';
}