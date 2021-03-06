<?php

require_once ROOTPATH . '/movie/movie.php';

abstract class Person {

    private $id;
    private $lastname;
    private $firstname;
    private $birthDate;
    private $biography;
    private $path;

    public function __construct($id, $lastname, $firstname, $birthDate, $biography, $path)
    {
        $this->id = $id;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->birthDate = $birthDate;
        $this->biography = $biography;
        $this->path = $path;
    }

    // Getters

    public function getId()
    {
        return $this->id;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function getBiography()
    {
        return $this->biography;
    }

    public function getPath()
    {
        return $this->path;
    }

    // Renvoie tout les films dans lesquels une personne a joué / a réalisé
    public static function getMoviesByPersonId($id) {

        // Tableau des films
        $movies = array();

        $moviesQuery = getDatabase()->prepare('SELECT * 
                                                 FROM person, movieHasPerson, movie 
                                                 WHERE person.id ='.$id.' 
                                                 AND person.id = movieHasPerson.idPerson 
                                                 AND movieHasPerson.idMovie = movie.id
                                                 ORDER BY movie.releaseDate DESC');
        $moviesQuery->execute();

        while ($real = $moviesQuery->fetch()) {
            array_push($movies, new Movie($real['idMovie'], $real['title'], $real['releaseDate'], $real['synopsis'], $real['rating'], null));
        }

        return $movies;
    }

}