<?php

setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

// Affiche le block d'un fichier PHP
function getBlock($file, $data = [])
{
    require ROOTPATH . '/' . $file . '.php';
}