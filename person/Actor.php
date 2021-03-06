<?php

require_once 'Person.php';
require_once ROOTPATH . '/movie/movie.php';

// Accès à la BD
require_once ROOTPATH . '/config/functions.php';

class Actor extends Person {

    // Renvoie tout les acteurs
    public static function getAllActors() {

        // Tableau des acteurs
        $actors = array();

        $actorsQuery = getDatabase()->prepare('SELECT DISTINCT movieHasPerson.idPerson, person.firstname, person.lastname, picture.path, person.birthDate, person.biography
                                         FROM person, movieHasPerson, personHasPicture, picture
                                         WHERE person.id = movieHasPerson.idPerson
                                         AND movieHasPerson.role = "actor"
                                         AND person.id = personHasPicture.idPerson
                                         AND personHasPicture.idPicture = picture.id');
        $actorsQuery->execute();
        while ($real = $actorsQuery->fetch()) {
            array_push($actors, new Actor($real['idPerson'], $real['lastname'], $real['firstname'], $real['birthDate'], $real['biography'], $real['path']));
        }
        return $actors;
    }

    // Renvoie un acteur par son identifiant
    public static function getActorById($idActor) {

        $actorQuery = getDatabase()->prepare('SELECT * 
                                                 FROM person, personHasPicture, picture 
                                                 WHERE person.id = ?
                                                 AND person.id = personHasPicture.idPerson 
                                                 AND personHasPicture.idPicture = picture.id');
        $actorQuery->execute(array($idActor));
        $actorFetch = $actorQuery->fetch();

        $actor = new Actor($actorFetch["idPerson"], $actorFetch["lastname"], $actorFetch["firstname"], $actorFetch["birthDate"], $actorFetch["biography"], $actorFetch["path"]);
        return $actor;
    }

    // Renvoie tout les films dans lesquels l'acteur a joué
    public static function getMoviesByActorId($idActor) {

        // Tableau des films
        $movies = array();

        $moviesQuery = getDatabase()->prepare('SELECT * 
                                                 FROM person, movieHasPerson, movie 
                                                 WHERE person.id ='.$idActor.' 
                                                 AND person.id = movieHasPerson.idPerson 
                                                 AND movieHasPerson.idMovie = movie.id
                                                 ORDER BY movie.releaseDate DESC');
        $moviesQuery->execute(array($idActor));

        while ($real = $moviesQuery->fetch()) {
            array_push($movies, new Movie($real['idMovie'], $real['title'], $real['releaseDate'], $real['synopsis'], $real['rating'], null));
        }

        return $movies;
    }
}