<?php

require '../config/functions.php';
require_once 'director.php';
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
        <article class="profils">
                        <h2>Liste des réalisateurs</h2>

                        <?php
                            foreach (Director::getAllDirectors() as $director) {
                        ?>
                                <figure>
                                        <a href="<?= 'infoDirector.php?id=' . $director->getId() ?>">
                                            <figcaption><?= $director->getFirstname() . ' ' . $director->getLastname()?></figcaption>
                                <img src="<?= $director->getPath() ?>" alt="" />
                                </a>
                                </figure>
                        <?php
                            }
                        ?>
        </article>
    </section>
</main>

<?php
getBlock('prefabs/footer');
?>

</body>
</html>