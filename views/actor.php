<?php
    $idActor = $data[0];
    $actor = $data[1];
    $movies = $data[2];
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

<?php

$data = array($actor, $movies);

    getBlock('prefabs/descPerson', $data);
?>

<?php
    getBlock('prefabs/footer');
?>

</body>
</html>