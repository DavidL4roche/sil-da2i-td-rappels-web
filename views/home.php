<?php
    $movies = $data[0];
    $actors = $data[1];
    $directors = $data[2];
?>

<!DOCTYPE html>
<html>
<?php
getBlock('prefabs/head');
?>

<body>
<?php
getBlock('prefabs/header');
?>

<main>
    <section>
        <article>
            <h1>Bienvenue sur SensCritik !</h1>
            <p>SensCritik est un service gratuit qui vous permet de découvrir, noter et classer des films.</p>
        </article>

        <article class="profilsMovies">
            <h2>Liste des films</h2>

            <?php
            foreach ($movies as $movie) {
                ?>
                <figure>
                    <a href="<?= 'movie/' . $movie->getId() ?>">
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

        <article class="profils">
            <h2>Liste des réalisateurs</h2>

            <?php
            foreach ($directors as $director) {
                ?>
                <figure>
                    <a href="<?= 'director/' . $director->getId() ?>">
                        <figcaption><?= $director->getFirstname() . ' ' . $director->getLastname()?></figcaption>
                        <?php
                        if($director->getPath() != null) {
                            echo "<img src=\"" . $director->getPath() . "\" alt=\"\" />";
                        }
                        else {
                            echo "<img src=\"https://media.senscritique.com/missing/212/150_200/missing.jpg\" alt=\"\" />";
                        }
                        ?>
                    </a>
                </figure>
                <?php
            }
            ?>

            <h2>Liste des acteurs</h2>

            <?php
            foreach ($actors as $actor) {
                ?>
                <figure>
                    <a href="<?= 'actor/' . $actor->getId() ?>">
                        <figcaption><?= $actor->getFirstname() . ' ' . $actor->getLastname()?></figcaption>
                        <?php
                        if($actor->getPath() != null) {
                            echo "<img src=" . $actor->getPath() . " alt=\"\" />";
                        }
                        else {
                            echo "<img src=\"https://media.senscritique.com/missing/212/150_200/missing.jpg\" alt=\"\" />";
                        }
                        ?>
                    </a>
                </figure>
                <?php
            }
            ?>
        </article>
    </section>
</main>

<?php
getBlock('/prefabs/footer');
?>

</body>
</html>