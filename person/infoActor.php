<?php
require '../config/functions.php';
require_once 'actor.php';
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

    $idActor = filter_input(INPUT_GET, 'id');

    $actor = Actor::getActorById($idActor);
?>

<main>
    <section>
        <?php
        $moviesQuery = $database->prepare('SELECT * 
                                                 FROM person, movieHasPerson, movie 
                                                 WHERE person.id = ?
                                                 AND person.id = movieHasPerson.idPerson 
                                                 AND movieHasPerson.idMovie = movie.id
                                                 ORDER BY movie.releaseDate');
        $moviesQuery->execute(array($idActor));

        $data = array($actor, $moviesQuery);

            getBlock('prefabs/descPerson', $data);
        ?>

    </section>
</main>

<?php
    getBlock('prefabs/footer');
?>

</body>
</html>