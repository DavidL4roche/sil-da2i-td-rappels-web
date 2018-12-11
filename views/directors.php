<?php
    $directors = $data[0];
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
                            foreach ($directors as $director) {
                        ?>
                                <figure>
                                        <a href="<?= 'director/' . $director->getId() ?>">
                                            <figcaption><?= $director->getFirstname() . ' ' . $director->getLastname()?></figcaption>
                                            <?php
                                            if($director->getPath() != null) {
                                                echo "<img src=\"" . $director->getPath() . "\" alt=\"\" />";
                                            }
                                            else {
                                                echo "<img src=\"https://media.senscritique.com/missing/212/150_200/missing.jpg\" alt=\"\" />";
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