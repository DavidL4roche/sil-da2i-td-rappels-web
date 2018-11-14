<?php
    $actor = $data[0];
    $movies = $data[1];
?>

<article class="articleActor">
    <article class="articleActorCorps">
        <img src="<?= $actor['path'] ?>" alt="" />
        <div class="articleActorText">
            <h1><?php echo $actor['firstname'] . ' ' . $actor['lastname'] ?></h1>
            <p><time>Né le <?php echo date('d/m/Y', strtotime($actor['birthDate'])); ?></time><p>
        </div>
    </article>
</article>

<main>
    <section>
       <article>
            <h2>Biographie</h2>
            <p><?php echo $actor['biography'] ?></p>
        </article>

        <article>
            <h2>Filmographie</h2>
            <h3>Acteur</h3>
            <h4>Longs métrages</h4>
            <ul>
                <?php
                    while ($movie = $movies->fetch()) {
                        ?>
                        <figure>
                            <a href="../movie/infoMovie.php?id=<?= $movie['id'] ?>">
                                <li><?php echo date('Y', strtotime($movie['releaseDate'])) . ' : ' . $movie['title']; ?></li>
                            </a>
                        </figure>
                        <?php
                    }
                ?>
            </ul>
        </article>
    </section>
</main>