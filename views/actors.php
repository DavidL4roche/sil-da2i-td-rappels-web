<?php
    $actors = $data[0]
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
            <h2>Liste des acteurs</h2>

            <?php
            foreach ($actors as $actor) {
                ?>
                <figure>
                    <a href="<?= 'actor/' . $actor->getId() ?>">
                        <figcaption><?= $actor->getFirstname() . ' ' . $actor->getLastname()?></figcaption>
                        <?php
                        if($actor->getPath() != null) {
                            echo "<img class=\"photoPerson\" src=\"" . $actor->getPath() . "\" alt=\"\" />";
                        }
                        else {
                            echo "<img class=\"photoPerson\" src=\"https://media.senscritique.com/missing/212/150_200/missing.jpg\" alt=\"\" />";
                        }
                        ?>
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