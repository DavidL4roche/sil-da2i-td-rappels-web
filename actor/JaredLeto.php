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
    $actorQuery = $database->prepare('SELECT * FROM person WHERE id = ?');
    $actorQuery->execute(array($idActor));
    $actor = $actorQuery->fetch();
?>

<main>
    <section>
        <?php
            getBlock('descActor', $actor);
        ?>

    </section>
</main>

<?php
    getBlock('footer');
?>

</body>
</html>