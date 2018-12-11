<?php

class DirectorController {

    public static function directors() {
        $directors = Director::getAllDirectors();

        getBlock('views/directors', [$directors]);
    }

    public static function index($idDirector) {
        $director = Director::getDirectorById($idDirector);
        $movies = Person::getMoviesByPersonId($idDirector);

        getBlock('views/actor', [$idDirector, $director, $movies]);
    }
}