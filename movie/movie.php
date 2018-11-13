<?php
require '../prefabs/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <?php
    getBlock('head');
    ?>
</head>
<body>

<?php
getBlock('header');
?>

<main>
    <section>
        <h2>Liste des films</h2>
        <?php
        $moviesQuery = $database->prepare('SELECT *
                                                      FROM movie, movieHasPicture, picture
                                                      WHERE movie.id = movieHasPicture.idMovie
                                                      AND movieHasPicture.type = "gallery"
                                                      AND movieHasPicture.idPicture = picture.id');
        $moviesQuery->execute();
        while ($movie = $moviesQuery->fetch()) {
            ?>
            <li>
                <a href="<?php echo 'infoMovie.php?id=' . $movie['idMovie'] ?>"><?php echo $movie['title']?></a>
            </li>
            <?php
        }
        ?>
    </section>
</main>

<?php
getBlock('footer');
?>

</body>
</html>