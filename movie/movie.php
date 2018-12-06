<?php

// Accès à la BD
require_once ROOTPATH . '/config/functions.php';

require_once '../person/director.php';

class Movie {

    private $id;
    private $title;
    private $releaseDate;
    private $synopsis;
    private $rating;
    private $path;

    // Constructor
    public function __construct($id, $title, $releaseDate, $synopsis, $rating, $path)
    {
        $this->id = $id;
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->synopsis = $synopsis;
        $this->rating = $rating;
        $this->path = $path;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function getSynopsis()
    {
        return $this->synopsis;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function getPath()
    {
        return $this->path;
    }

    // Functions
    public static function getAllMovies() {

        // Accès à la BD
        require_once ROOTPATH . '/config/functions.php';

        // Tableau des films
        $movies = array();

        $realQuery = getDatabase()->prepare('SELECT * FROM movie');
        $realQuery->execute();
        while ($real = $realQuery->fetch()) {
            array_push($movies, new Movie($real['id'], $real['title'], $real['releaseDate'], $real['synopsis'], $real['rating'], null));
        }
        return $movies;
    }

    public static function getBaseInfos($id) {

        $realQuery = getDatabase()->prepare('SELECT idMovie, title, releaseDate, synopsis, rating, path
                                                       FROM movie, movieHasPicture, picture
                                                       WHERE movie.id = movieHasPicture.idMovie
                                                       AND movieHasPicture.idPicture = picture.id
                                                       AND movieHasPicture.type = "gallery" 
                                                       AND movie.id='.$id);
        $realQuery->execute();
        $real = $realQuery->fetch();

        // Film
        $movie = new Movie($real['idMovie'], $real['title'], $real['releaseDate'], $real['synopsis'], $real['rating'], $real['path']);

        return $movie;
    }

    // Retourne l'affiche du film
    public static function getPoster($id) {
        $posterQuery = getDatabase()->prepare('SELECT path 
                                                         FROM picture, movieHasPicture 
                                                         WHERE picture.id = movieHasPicture.idPicture 
                                                         AND movieHasPicture.type = "affiche" 
                                                         AND movieHasPicture.idMovie ='.$id);
        $posterQuery->execute();
        $movie = $posterQuery->fetch();

        // Affiche du film
        $poster = $movie['path'];

        return $poster;
    }

    // Retourne le directeur d'un film
    public static function getDirectorByMovieId($id) {
        $directorQuery = getDatabase()->prepare('SELECT *
                                                            FROM person, movieHasPerson, personHasPicture, picture
                                                            WHERE person.id = movieHasPerson.idPerson
                                                            AND movieHasPerson.role = "director"
                                                            AND person.id = personHasPicture.idPerson
                                                            AND personHasPicture.idPicture = picture.id
                                                            AND movieHasPerson.idMovie ='.$id);
        $directorQuery->execute();
        $directorFetch = $directorQuery->fetch();

        // Création du directeur
        $director =  $movie = new Director($directorFetch["idPerson"], $directorFetch["lastname"], $directorFetch["firstname"], $directorFetch["birthDate"], $directorFetch["biography"], $directorFetch["path"]);

        return $director;
    }

    // Retourne les acteurs d'un film
    public static function getActorsByMovieId($id) {
        // Tableau des acteurs
        $actors = array();

        $actorsQuery = getDatabase()->prepare('SELECT *
                                                             FROM person, movieHasPerson, personHasPicture, picture
                                                             WHERE person.id = movieHasPerson.idPerson 
                                                             AND movieHasPerson.role = "actor"
                                                             AND person.id = personHasPicture.idPerson
                                                             AND personHasPicture.idPicture = picture.id 
                                                             AND movieHasPerson.idMovie ='.$id);
        $actorsQuery->execute();
        while ($real = $actorsQuery->fetch()) {
            array_push($actors, new Actor($real['idPerson'], $real['lastname'], $real['firstname'], $real['birthDate'], $real['biography'], $real['path']));
        }
        return $actors;
    }

    // Retourne les images du film
    public static function getPicturesByMovieId($id) {
        // Tableau des images
        $pictures = array();

        $picturesQuery = getDatabase()->prepare('SELECT *
                                                              FROM movieHasPicture, picture
                                                              WHERE movieHasPicture.idPicture = picture.id
                                                              AND movieHasPicture.type = "poster"
                                                              AND movieHasPicture.idMovie ='.$id);
        $picturesQuery->execute();
        while ($path = $picturesQuery->fetch()) {
            array_push($pictures, $path['path']);
        }
        return $pictures;
    }
}