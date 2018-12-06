<?php

require_once 'Person.php';

// Accès à la BD
require_once ROOTPATH . '/config/functions.php';

class Director extends Person {

    // Renvoie tout les directeurs
    public static function getAllDirectors() {

        // Tableau des réalisateurs
        $directors = array();

        $realQuery = getDatabase()->prepare('SELECT DISTINCT movieHasPerson.idPerson, person.firstname, person.lastname, picture.path, person.birthDate, person.biography
                                         FROM person, movieHasPerson, personHasPicture, picture
                                         WHERE person.id = movieHasPerson.idPerson
                                         AND movieHasPerson.role = "director"
                                         AND person.id = personHasPicture.idPerson
                                         AND personHasPicture.idPicture = picture.id');
        $realQuery->execute();
        while ($real = $realQuery->fetch()) {
            array_push($directors, new Director($real['idPerson'], $real['lastname'], $real['firstname'], $real['birthDate'], $real['biography'], $real['path']));
        }
        return $directors;
    }

    // Renvoie un directeur par son identifiant
    public static function getDirectorById($idDirector) {

        $directorQuery = getDatabase()->prepare('SELECT * 
                                                 FROM person, personHasPicture, picture 
                                                 WHERE person.id = ?
                                                 AND person.id = personHasPicture.idPerson 
                                                 AND personHasPicture.idPicture = picture.id');
        $directorQuery->execute(array($idDirector));
        $directorFetch = $directorQuery->fetch();

        $director = new Director($directorFetch["idPerson"], $directorFetch["lastname"], $directorFetch["firstname"], $directorFetch["birthDate"], $directorFetch["biography"], $directorFetch["path"]);
        return $director;
    }

}