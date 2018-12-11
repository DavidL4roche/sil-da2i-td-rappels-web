<?php
    $movies = $data[0];
    $actors = $data[1];
    $directors = $data[2];
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
        <h1>Suppression</h1>
        <p>Choisissez le film à supprimer</p>
        <form method="post">
            <SELECT name="filmDelete" size="1">
                <?php
                foreach ($movies as $movie) {
                    echo '<OPTION>' . $movie->getId();
                }
                ?>
            </SELECT>
            <p><input type="submit" value="Supprimer"></p>
        </form>
        <p>Choisissez l'acteur à supprimer</p>
        <form method="post">
            <SELECT name="actorDelete">
                <?php
                foreach ($actors as $actor) {
                    echo '<OPTION value="'.$actor->getId().'">' . $actor->getFirstName() . " " . $actor->getLastName() . '</OPTION>';
                }
                ?>
            </SELECT>
            <p><input type="submit" name="deleteActor" value="Supprimer"></p>
        </form>

        <p>Choisissez le réalisateur à supprimer</p>
        <SELECT name="directorDelete" size="1">
            <?php
            foreach ($directors as $director) {
                echo '<OPTION>' . $director->getFirstName() . " " . $director->getLastName();
            }
            ?>
        </SELECT>
    </section>
</main>

<?php
getBlock('prefabs/footer');
?>

</body>
</html>