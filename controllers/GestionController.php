<?php

class GestionController {

    public static function index() {
        if (isset($_POST['deleteActor'])) {
            Person::deletePerson($_POST['actorDelete']);
        }

        if (isset($_POST['deleteDirector'])) {
            Person::deletePerson($_POST['directorDelete']);
        }

        if (isset($_POST['deleteMovie'])) {
            Movie::deleteMovie($_POST['movieDelete']);
        }

        if (isset($_POST['addMovie'])) {
            Movie::addMovie($_POST['movieTitle'], $_POST['movieReleaseDate'], $_POST['movieSynopsis'], $_POST['movieRating']);
        }

        if (isset($_POST['addPerson'])) {
            Person::addPerson($_POST['personFirstname'], $_POST['personLastname'], $_POST['personBirthdate'], $_POST['personBiography']);
        }

        if (isset($_POST['addImage'])) {
            Image::addImage($_POST['imagePath'], $_POST['imageLegend']);
        }

        if (isset($_POST['moviePersonLiaison'])) {
            Movie::linkMovieToPerson($_POST['movieLiaisonPerson'], $_POST['personLiaisonMovie'], $_POST['rolePerson']);
        }

        if (isset($_POST['personImageLiaison'])) {
            Person::linkPictureToPerson($_POST['imageLiaisonPerson'], $_POST['personLiaisonImage']);
        }

        if (isset($_POST['movieImageLiaison'])) {
            Movie::linkMovieToImage($_POST['movieLiaisonImage'], $_POST['imageLiaisonMovie'], $_POST['typeImage']);
        }

        $movies = Movie::getAllMovies();
        $actors = Actor::getAllSimpleActors();
        $directors = Director::getAllDirectors();
        $images = Image::getAllImages();
        getBlock('views/gestion', [$movies, $actors, $directors, $images]);
    }

    public static function deleteActor($idActor) {
        $isActorDeleted = Actor::deleteActor($idActor);
    }
}