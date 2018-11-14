<?php
    require '../config/functions.php';
    require_once 'Actor.php';
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
                foreach (Actor::getAllActors() as $actor) {
                    ?>
                    <figure>
                        <a href="<?= 'infoActor.php?id=' . $actor->getId() ?>">
                            <figcaption><?= $actor->getFirstname() . ' ' . $actor->getLastname()?></figcaption>
                            <img src="<?= $actor->getPath() ?>" alt="" />
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