<?php

// Racine chemin absolu
define("ROOTURL", "http://davidlaroche.alwaysdata.net/SensCritik");
define("ROOTPATH", "/home/davidlaroche/www/SensCritik");

ini_set("error_reporting", -1);
ini_set("display_errors", "on");

require ROOTPATH . '/config/functions.php';
require ROOTPATH . '/config/db.php';

require ROOTPATH . '/models/Person.php';
require ROOTPATH . '/models/Actor.php';
require ROOTPATH . '/models/Director.php';
require ROOTPATH . '/models/Movie.php';
require ROOTPATH . '/models/Image.php';

require ROOTPATH . '/controllers/ActorController.php';
require ROOTPATH . '/controllers/DirectorController.php';
require ROOTPATH . '/controllers/HomeController.php';
require ROOTPATH . '/controllers/MovieController.php';
require ROOTPATH . '/controllers/FAQController.php';
require ROOTPATH . '/controllers/GestionController.php';