<?php

require '../config/functions.php';
require_once 'movie.php';
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
        <article class="profilsMovies">
            <h2>Liste des films</h2>

            <?php
            foreach (Movie::getAllMovies() as $movie) {
                ?>
                <figure>
                    <a href="<?= 'infoMovie.php?id=' . $movie->getId() ?>">
                        <?php
                        $path = Movie::getPoster($movie->getId());
                        ?>
                        <img src="<?= $path ?>" alt="" />
                    </a>
                </figure>
                <?php
            }
            ?>
        </article>
    </section>
</main>

<?php
getBlock('prefabs/footer');
?>

</body>
</html>