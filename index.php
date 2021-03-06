<?php
    require_once 'config/functions.php';
    require_once 'movie/movie.php';
    require_once 'person/director.php';
    require_once 'person/actor.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SensCritik</title>
    <link rel="stylesheet" href="style/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= ROOTURL ?>/img/origami.png" />
</head>

<body>
    <header>
        <a href="<?= ROOTURL ?>/index.php"><img src="img/origami.png" alt=""/></a>
        <a href="<?= ROOTURL ?>/index.php"><h1>SensCritik</h1></a>
        <nav>
            <ul>
                <li><a href="<?= ROOTURL ?>/movie/movies.php">Films</a></li>
                <li><a href="<?= ROOTURL ?>/person/actors.php">Acteurs</a></li>
                <li><a href="<?= ROOTURL ?>/person/directors.php">Directeurs</a></li>
            </ul>
        </nav>
    </header>

	<main>
		<section>
			<article>
				<h1>Bienvenue sur SensCritik !</h1>
                <p>SensCritik est un service gratuit qui vous permet de découvrir, noter et classer des films.</p>
			</article>

            <article class="profilsMovies">
                <h2>Liste des films</h2>

                <?php
                foreach (Movie::getAllMovies() as $movie) {
                    ?>
                    <figure>
                        <a href="<?= 'movie/infoMovie.php?id=' . $movie->getId() ?>">
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

            <article class="profils">
				<h2>Liste des réalisateurs</h2>

                <?php
                    foreach (Director::getAllDirectors() as $director) {
                ?>
                        <figure>
                            <a href="<?= 'person/infoDirector.php?id=' . $director->getId() ?>">
                                <figcaption><?= $director->getFirstname() . ' ' . $director->getLastname()?></figcaption>
                                <img src="<?= $director->getPath() ?>" alt="" />
                            </a>
                        </figure>
                <?php
                    }
                ?>

				<h2>Liste des acteurs</h2>

                <?php
                foreach (Actor::getAllActors() as $actor) {
                    ?>
                    <figure>
                        <a href="<?= 'person/infoActor.php?id=' . $actor->getId() ?>">
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