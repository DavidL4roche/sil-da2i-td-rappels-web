<?php
    $actor = $data[0];
    $movies = $data[1];
?>

<article>
    <h1><?php echo $actor->getFirstName() . ' ' . $actor->getLastname() ?></h1>
    <p><time>Né le <?php echo date('d/m/Y', strtotime($actor->getBirthDate())); ?></time><p>
        <img src="<?= $actor->getPath() ?>" alt="" />
</article>

<article>
    <h2>Biographie</h2>
    <p><?php echo $actor->getBiography() ?></p>
</article>

<article>
    <h2>Filmographie</h2>
    <h3>Acteur</h3>
    <h4>Longs métrages</h4>
    <ul>
        <?php
            foreach ($movies as $movie) {
                ?>
                <figure>
                    <a href="../movie/infoMovie.php?id=<?= $movie->getId() ?>">
                        <li><?php echo date('Y', strtotime($movie->getReleaseDate())) . ' : ' . $movie->getTitle(); ?></li>
                    </a>
                </figure>
                <?php
            }
        ?>
    </ul>
</article>