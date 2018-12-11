<?php

class HomeController {

    public static function index() {
        $movies = Movie::getAllMovies();
        $actors = Actor::getAllActors();
        $directors = Director::getAllDirectors();

        getBlock('views/home', [$movies, $actors, $directors]);
    }
}