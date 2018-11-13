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

    $idActor = filter_input(INPUT_GET, 'id');
    $actorQuery = $database->prepare('SELECT * 
                                                 FROM person, personHasPicture, picture 
                                                 WHERE person.id = ?
                                                 AND person.id = personHasPicture.idPerson 
                                                 AND personHasPicture.idPicture = picture.id');
    $actorQuery->execute(array($idActor));
    $actor = $actorQuery->fetch();
?>

<main>
    <section>
        <?php
        $moviesQuery = $database->prepare('SELECT * 
                                                 FROM person, movieHasPerson, movie 
                                                 WHERE person.id = ?
                                                 AND person.id = movieHasPerson.idPerson 
                                                 AND movieHasPerson.idMovie = movie.id');
        $moviesQuery->execute(array($idActor));

        $data = array($actor, $moviesQuery);

            getBlock('descActor', $data);
        ?>

    </section>
</main>

<?php
    getBlock('footer');
?>

</body>
</html>