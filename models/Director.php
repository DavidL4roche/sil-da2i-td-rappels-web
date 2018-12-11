<?php

// Accès à la BD
require_once ROOTPATH . '/config/functions.php';

class Director extends Person {

    // Renvoie tout les directeurs
    public static function getAllDirectors() {

        // Tableau des réalisateurs
        $directors = array();

        $realQuery = getDatabase()->prepare('SELECT DISTINCT P.*,PT.path
                                         FROM movieHasPerson
                                         LEFT JOIN person as P ON P.id=movieHasPerson.idPerson
                                         LEFT JOIN  personHasPicture as PHP ON PHP.idPerson = P.id
                                         LEFT JOIN picture as PT ON PT.id=PHP.idPicture
                                         WHERE  movieHasPerson.role = "director"
                                         ORDER BY P.firstname');
        $realQuery->execute();
        while ($real = $realQuery->fetch()) {
            array_push($directors, new Director($real['id'], $real['lastname'], $real['firstname'], $real['birthDate'], $real['biography'], $real['path']));
        }
        return $directors;
    }

    // Renvoie un directeur par son identifiant
    public static function getDirectorById($idDirector) {

        $directorQuery = getDatabase()->prepare('SELECT  person.*, PT.path
                                                 FROM person
                                                 LEFT JOIN personHasPicture AS PHP ON PHP.idPerson = person.id
                                                 LEFT JOIN picture AS PT ON PT.id = PHP.idPicture 
                                                 WHERE person.id = ?');
        $directorQuery->execute(array($idDirector));
        $directorFetch = $directorQuery->fetch();

        $director = new Director($directorFetch["id"], $directorFetch["lastname"], $directorFetch["firstname"], $directorFetch["birthDate"], $directorFetch["biography"], $directorFetch["path"]);
        return $director;
    }

}