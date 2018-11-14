<?php
require '../config/functions.php';
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
    $actorQuery = $database->prepare('SELECT * 
                                                 FROM person, personHasPicture, picture 
                                                 WHERE person.id = ?
                                                 AND person.id = personHasPicture.idPerson 
                                                 AND personHasPicture.idPicture = picture.id');
    $actorQuery->execute(array($idActor));
    $actor = $actorQuery->fetch();
?>


<?php
$moviesQuery = $database->prepare('SELECT * 
                                         FROM person, movieHasPerson, movie 
                                         WHERE person.id = ?
                                         AND person.id = movieHasPerson.idPerson 
                                         AND movieHasPerson.idMovie = movie.id
                                         ORDER BY movie.releaseDate');
$moviesQuery->execute(array($idActor));

$data = array($actor, $moviesQuery);

    getBlock('prefabs/descActor', $data);
?>


<?php
    getBlock('prefabs/footer');
?>

</body>
</html>