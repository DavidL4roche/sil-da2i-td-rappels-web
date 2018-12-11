<?php

class GestionController {

    public static function index() {
        if (isset($_POST['deleteActor'])) {
            Actor::deleteActor($_POST['actorDelete']);
        }
        $movies = Movie::getAllMovies();
        $actors = Actor::getAllSimpleActors();
        $directors = Director::getAllDirectors();
        getBlock('views/gestion', [$movies, $actors, $directors]);
    }

    public static function deleteActor($idActor) {
        $isActorDeleted = Actor::deleteActor($idActor);
    }
}