<?php
    require '../config/functions.php';
    require_once  'movie.php';
    require_once '../person/director.php';
    require_once '../person/actor.php';

    $idMovie = filter_input(INPUT_GET, 'id');

    $movie = Movie::getBaseInfos($idMovie);
    $director = Movie::getDirectorByMovieId($idMovie);
    $actors = Movie::getActorsByMovieId($idMovie);
    $pictures = Movie::getPicturesByMovieId($idMovie);
?>

<!DOCTYPE html>
<html>
<?php
    getBlock('prefabs/head');
?>

<body>

    <?php
        getBlock('prefabs/header');
        getBlock('prefabs/bannerMovie', $movie);
    ?>

	<main>
		<section>
			<article>
				<p class="desc1">Film de <a class="presDirector" href="../person/infoDirector.php?id=<?= $director->getId() ?>"><?= $director->getFirstname() . ' '
                         . $director->getLastname()?></a> - <?= date('d/m/Y', strtotime($movie->getReleaseDate()))?></p>
				<p>Avec
                    <?php
                        foreach ($actors as $actor) {
                            ?>
                            <a class="presActor" href="../person/infoActor.php?id=<?= $actor->getId() ?>"><?= $actor->getFirstname() . ' ' . $actor->getLastname() ?></a>,
                            <?php
                        }
                    ?>
                </p>
			</article>

			<article>
				<p><?= $movie->getSynopsis() ?></p>
			</article>

			<article class="profils">
				<h2>Réalisateur</h2>

                <figure>
                    <a href="<?php echo '../person/infoDirector.php?id=' .$director->getId() ?>">
                        <figcaption><?php echo $director->getFirstname() . ' ' . $director->getLastname()?></figcaption>
                        <img src="<?php echo $director->getPath(); ?>" alt="" />
                    </a>
                </figure>
                <?php
                ?>

				<h2>Casting : Acteurs principaux</h2>
                <?php
                foreach ($actors as $actor) {
                    ?>
                    <figure>
                        <a href="<?php echo '../person/infoActor.php?id=' . $actor->getId() ?>">
                            <figcaption><?php echo $actor->getFirstname() . ' ' . $actor->getLastname()?></figcaption>
                            <img src="<?php echo $actor->getPath(); ?>" alt="" />
                        </a>
                    </figure>
                    <?php
                }
                ?>
			</article>

			<!--
			<aside>
				<h2>Note</h2>
				<p>3.7/5</p>
				<meter min="0" max="5"
		               low="1" high="4" optimum="3.5" value="3.7">
		            at 3.7/5
		        </meter>
			</aside>
			-->

            <aside class="imagesFilm">
                <h2>Images</h2>
                <?php
                foreach ($pictures as $picture) {
                    ?>
                    <img src="<?= $picture ?>" alt="" />
                    <?php
                }
                ?>
            </aside>
		</section>
	</main>
	
    <?php
        getBlock('prefabs/footer');
    ?>

</body>
</html>