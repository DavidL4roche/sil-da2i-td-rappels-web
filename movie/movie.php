<?php
    require '../config/functions.php';
    require_once 'Movie.php';
?>

<!DOCTYPE html>
<html>
<head>
    <?php
    getBlock('prefabs/head');
    ?>
</head>
<body>

<?php
getBlock('prefabs/header');
?>

<main>
    <section>
        <h2>Liste des films</h2>

        <?php
        foreach (Movie::getAllMovies() as $movie) {
            ?>
            <a class="movieListA" href="<?= 'infoMovie.php?id=' . $movie->getId() ?>">
                <li class="movieList">
                    <?= $movie->getTitle()?>
                </li>
            </a>
            <?php
        }
        ?>
    </section>
</main>

<?php
getBlock('prefabs/footer');
?>

</body>
</html>