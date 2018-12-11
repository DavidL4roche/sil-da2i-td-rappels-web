<?php

// Connexion à la base de données
function getDatabase() {
    $database = new PDO('mysql:host=mysql-davidlaroche.alwaysdata.net;dbname=davidlaroche_senscritik', '113162_admin', '113162_admin');
    $database->exec('SET CHARACTER SET utf8');
    return $database;
}