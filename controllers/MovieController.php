<?php

class MovieController {

    public static function movies() {
        $movies = Movie::getAllMovies();

        getBlock('views/movies', [$movies]);
    }

    public static function index($idMovie) {
        $movie = Movie::getBaseInfos($idMovie);
        $director = Movie::getDirectorByMovieId($idMovie);
        $actors = Movie::getActorsByMovieId($idMovie);
        $pictures = Movie::getPicturesByMovieId($idMovie);

        getBlock('views/movie', [$idMovie, $movie, $director, $actors, $pictures]);
    }
}