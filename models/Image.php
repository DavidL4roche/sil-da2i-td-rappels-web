<?php

class Image {
    private $id;
    private $legend;
    private $path;

    public function getId()
    {
        return $this->id;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getLegend()
    {
        return $this->legend;
    }

    // Constructor
    public function __construct($id, $legend, $path)
    {
        $this->id = $id;
        $this->legend = $legend;
        $this->path = $path;
    }

    // Ajouter une personne
    public static function addImage($path, $legend) {
        $imageQuery = getDatabase()->prepare('INSERT INTO `picture` (`legend`, `path`) 
                                                         VALUES (?, ?)');
        $imageQuery->execute(array($legend, $path));
    }

    // Retourne toutes les images
    public static function getAllImages() {

        // Tableau des films
        $images = array();

        $realQuery = getDatabase()->prepare('SELECT * FROM picture');
        $realQuery->execute();
        while ($real = $realQuery->fetch()) {
            array_push($images, new Image($real['id'], $real['legend'], $real['path']));
        }
        return $images;
    }

    // Retourne le fond d'écran d'un film
    public static function getMovieWallpaper($idMovie, $type) {
        $realQuery = getDatabase()->prepare('SELECT DISTINCT * 
                                                       FROM movieHasPicture, picture
                                                       WHERE movieHasPicture.idMovie = ?
                                                         AND movieHasPicture.idPicture = picture.id
                                                         AND movieHasPicture.type = ?');
        $realQuery->execute(array($idMovie, $type));
        $real = $realQuery->fetch();

        $image = new Image($real['id'], $real['legend'], $real['path']);

        return $image;
    }
}