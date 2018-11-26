<?php

require_once 'Person.php';

class Actor extends Person {

    // Renvoie tout les acteurs
    public static function getAllActors() {

        // Accès à la BD
        require_once ROOTPATH . '/config/functions.php';

        // Tableau des acteurs
        $actors = array();

        $realQuery = getDatabase()->prepare('SELECT DISTINCT movieHasPerson.idPerson, person.firstname, person.lastname, picture.path, person.birthDate, person.biography
                                         FROM person, movieHasPerson, personHasPicture, picture
                                         WHERE person.id = movieHasPerson.idPerson
                                         AND movieHasPerson.role = "actor"
                                         AND person.id = personHasPicture.idPerson
                                         AND personHasPicture.idPicture = picture.id');
        $realQuery->execute();
        while ($real = $realQuery->fetch()) {
            array_push($actors, new Actor($real['idPerson'], $real['lastname'], $real['firstname'], $real['birthDate'], $real['biography'], $real['path']));
        }
        return $actors;
    }
}