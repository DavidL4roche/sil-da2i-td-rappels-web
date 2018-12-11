<?php
    $idDirector = $data[0];
    $director = $data[1];
    $movies = $data[2];
    $data = array($director, $movies);
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

getBlock('prefabs/descPerson', $data);
?>

<?php
getBlock('prefabs/footer');
?>

</body>
</html>