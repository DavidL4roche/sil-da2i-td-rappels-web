<?php

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

        // Tableau des films
        $movies = array();

        $realQuery = getDatabase()->prepare('SELECT * FROM movie ORDER BY releaseDate DESC');
        $realQuery->execute();
        while ($real = $realQuery->fetch()) {
            array_push($movies, new Movie($real['id'], $real['title'], $real['releaseDate'], $real['synopsis'], $real['rating'], null));
        }
        return $movies;
    }

    public static function getBaseInfos($id) {

        $realQuery = getDatabase()->prepare('SELECT id, title, releaseDate, synopsis, rating
                                                       FROM movie
                                                       WHERE movie.id='.$id);
        $realQuery->execute();
        $real = $realQuery->fetch();

        // Film
        $movie = new Movie($real['id'], $real['title'], $real['releaseDate'], $real['synopsis'], $real['rating'], null);

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
        $directorQuery = getDatabase()->prepare('SELECT person.*, PT.path
                                                            FROM person
                                                            LEFT JOIN movieHasPerson AS MHP ON MHP.idPerson = person.id
                                                            LEFT JOIN personHasPicture AS PHP ON person.id = PHP.idPerson
                                                            LEFT JOIN picture AS PT ON PT.id = PHP.idPicture
                                                            WHERE MHP.role = "director"
                                                            AND MHP.idMovie = '.$id);
        $directorQuery->execute();
        $directorFetch = $directorQuery->fetch();

        // Création du directeur
        $director =  $movie = new Director($directorFetch["id"], $directorFetch["lastname"], $directorFetch["firstname"], $directorFetch["birthDate"], $directorFetch["biography"], $directorFetch["path"]);

        return $director;
    }

    // Retourne les acteurs d'un film
    public static function getActorsByMovieId($id) {
        // Tableau des acteurs
        $actors = array();

        $actorsQuery = getDatabase()->prepare('SELECT person.*, PT.path
                                                            FROM person
                                                            LEFT JOIN movieHasPerson AS MHP ON MHP.idPerson = person.id
                                                            LEFT JOIN personHasPicture AS PHP ON person.id = PHP.idPerson
                                                            LEFT JOIN picture AS PT ON PT.id = PHP.idPicture
                                                            WHERE MHP.role = "actor"
                                                            AND MHP.idMovie = '.$id);
        $actorsQuery->execute();
        while ($real = $actorsQuery->fetch()) {
            array_push($actors, new Actor($real['id'], $real['lastname'], $real['firstname'], $real['birthDate'], $real['biography'], $real['path']));
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

    // Supprimer un film
    public static function deleteMovie($idMovie) {

        $actorQuery = getDatabase()->prepare('DELETE FROM movie WHERE id = ?');
        $actorQuery->execute(array($idMovie));
    }

    // Ajouter un film
    public static function addMovie($title, $releaseDate, $synopsis, $rating) {
        $movieQuery = getDatabase()->prepare('INSERT INTO `movie` (`title`, `releaseDate`, `synopsis`, `rating`) 
                                                         VALUES (?, ?, ?, ?)');
        $movieQuery->execute(array($title, $releaseDate, $synopsis, $rating));
    }

    // Lier un film à un acteur
    public static function linkMovieToPerson($idMovie, $idPerson, $role) {
        $movieQuery = getDatabase()->prepare('INSERT INTO `movieHasPerson` (`idMovie`, `idPerson`, `role`) 
                                                         VALUES (?, ?, ?)');
        $movieQuery->execute(array($idMovie, $idPerson, $role));
    }

    // Lier un film à une image
    public static function linkMovieToImage($idMovie, $idPicture, $type) {
        $movieQuery = getDatabase()->prepare('INSERT INTO `movieHasPicture` (`idMovie`, `idPicture`, `type`) 
                                                         VALUES (?, ?, ?)');
        $movieQuery->execute(array($idMovie, $idPicture, $type));
    }
}