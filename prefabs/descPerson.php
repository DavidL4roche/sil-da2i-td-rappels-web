<?php
    $actor = $data[0];
    $movies = $data[1];
?>

<article class="headerPerson">
    <div class="corpsHeaderPerson">
        <?php
            if($actor->getPath() != null) {
                echo "<img class=\"imgActeur photoPerson\" src=" . $actor->getPath() . " alt=\"\" />";
            }
            else {
                echo "<img class=\"imgActeur\" src=\"https://media.senscritique.com/missing/212/150_200/missing.jpg\" alt=\"\" />";
            }
        ?>


        <div class="infosActeur">
            <h1><?php echo $actor->getFirstName() . ' ' . $actor->getLastname() ?></h1>
            <p><time>Né le <?php echo date('d/m/Y', strtotime($actor->getBirthDate())); ?></time></p>
        </div>
    </div>
</article>

<main>
    <section>
        <article>
            <h2>Biographie</h2>
            <p><?php echo $actor->getBiography() ?></p>
        </article>

        <article class="profilsMovies">
            <h2>Filmographie</h2>
            <h3>Longs métrages</h3>

                <?php
                foreach ($movies as $movie) {
                    ?>
                    <figure>
                        <a href="<?= ROOTURL . '/movie/' . $movie->getId() ?>">
                            <?php
                            $path = Movie::getPoster($movie->getId());
                            ?>
                            <img src="<?= $path ?>" alt="" />
                        </a>
                    </figure>
                    <?php
                }
                ?>

        </article>
    </section>
</main>