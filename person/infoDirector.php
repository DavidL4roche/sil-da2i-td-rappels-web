<?php
require '../config/functions.php';
require_once 'director.php';
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

    $idDirector = filter_input(INPUT_GET, 'id');

    $director = Director::getDirectorById($idDirector);
?>

<main>
    <section>
        <?php
        $movies = Person::getMoviesByPersonId($idDirector);

        $data = array($director, $movies);

        getBlock('prefabs/descPerson', $data);
        ?>

    </section>
</main>

<?php
getBlock('prefabs/footer');
?>

</body>
</html>