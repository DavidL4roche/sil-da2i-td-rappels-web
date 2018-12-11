<?php

class ActorController {

    public static function actors() {
        $actors = Actor::getAllActors();
        getBlock('views/actors', [$actors]);
    }

    public static function index($idActor) {
        $actor = Actor::getActorById($idActor);
        $movies = Person::getMoviesByPersonId($idActor);

        getBlock('views/actor', [$idActor, $actor, $movies]);
    }
}