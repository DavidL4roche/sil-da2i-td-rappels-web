<?php

require 'config/config.php';

$url = explode('/', substr($_SERVER['REQUEST_URI'], 1));

switch ($url[1]) {
    case 'movies':
        MovieController::movies();
        break;
    case 'actors':
        ActorController::actors();
        break;
    case 'directors':
        DirectorController::directors();
        break;
    case 'movie':
        MovieController::index($url[2]);
        break;
    case 'actor':
        ActorController::index($url[2]);
        break;
    case 'director':
        DirectorController::index($url[2]);
        break;
    case 'gestion':
        GestionController::index();
        break;
    case 'faq':
        FAQController::index();
        break;
    default:
        HomeController::index();
        break;
}