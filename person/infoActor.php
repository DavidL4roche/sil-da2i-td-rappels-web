<?php
require '../config/functions.php';
require_once 'actor.php';
require_once 'Person.php';
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
        $movies = Person::getMoviesByPersonId($idActor);

        $data = array($actor, $movies);

            getBlock('prefabs/descPerson', $data);
        ?>

    </section>
</main>

<?php
    getBlock('prefabs/footer');
?>

</body>
</html>