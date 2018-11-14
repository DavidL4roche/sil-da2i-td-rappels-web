<?php
    require '../config/functions.php';
    require_once 'Director.php';
?>

<!DOCTYPE html>
<html>
<?php
    getBlock('prefabs/head');
?>
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