<?php

class Actor extends Person {

    // Renvoie tout les acteurs (données simples)
    public static function getAllSimpleActors() {

        // Tableau des acteurs
        $actors = array();

        $actorsQuery = getDatabase()->prepare('SELECT P.*
                                                          FROM movieHasPerson
                                                          LEFT JOIN person as P ON P.id=movieHasPerson.idPerson
                                                          WHERE  movieHasPerson.role = "actor"');
        $actorsQuery->execute();
        while ($real = $actorsQuery->fetch()) {
            array_push($actors, new Actor($real['id'], $real['lastname'], $real['firstname'], $real['birthDate'], $real['biography'], null));
        }
        return $actors;
    }

    // Renvoie tout les acteurs
    public static function getAllActors() {

        // Tableau des acteurs
        $actors = array();

        $actorsQuery = getDatabase()->prepare('SELECT DISTINCT P.*,PT.path
                                         FROM movieHasPerson
                                         LEFT JOIN person as P ON P.id=movieHasPerson.idPerson
                                         LEFT JOIN  personHasPicture as PHP ON PHP.idPerson = P.id
                                         LEFT JOIN picture as PT ON PT.id=PHP.idPicture
                                         WHERE  movieHasPerson.role = "actor"
                                         ORDER BY P.firstname');
        $actorsQuery->execute();
        while ($real = $actorsQuery->fetch()) {
            array_push($actors, new Actor($real['id'], $real['lastname'], $real['firstname'], $real['birthDate'], $real['biography'], $real['path']));
        }
        return $actors;
    }

    // Renvoie un acteur par son identifiant
    public static function getActorById($idActor) {

        $actorQuery = getDatabase()->prepare('SELECT person.*, PT.path
                                                 FROM person
                                                 LEFT JOIN personHasPicture AS PHP ON PHP.idPerson = person.id
                                                 LEFT JOIN picture AS PT ON PT.id = PHP.idPicture 
                                                 WHERE person.id = ?');
        $actorQuery->execute(array($idActor));
        $actorFetch = $actorQuery->fetch();

        $actor = new Actor($actorFetch["id"], $actorFetch["lastname"], $actorFetch["firstname"], $actorFetch["birthDate"], $actorFetch["biography"], $actorFetch["path"]);
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