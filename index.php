<?php
    require 'prefabs/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SensCritik</title>
    <link rel="stylesheet" href="style/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
</head>

<body>
    <header>
        <a href="http://davidlaroche.alwaysdata.net/SensCritik/index.php"><img src="img/origami.png" alt=""/></a>
        <a href="http://davidlaroche.alwaysdata.net/SensCritik/index.php"><h1>SensCritik</h1></a>
        <nav>
            <ul>
                <li><a href="http://davidlaroche.alwaysdata.net/SensCritik/movie/movie.php?id=1">Film</a></li>
                <li><a href="http://davidlaroche.alwaysdata.net/SensCritik/actor/actor.php">Acteurs</a></li>
                <li><a href="http://davidlaroche.alwaysdata.net/SensCritik/director/director.php">Directeurs</a></li>
            </ul>
        </nav>
    </header>

	<main>
		<section>
			<article>
				<h1>Bienvenue sur SensCritik !</h1>
                <p>SensCritik est un service gratuit qui vous permet de découvrir, noter et classer des films.</p>
			</article>

			<article class="profils">
				<h2>Liste des réalisateurs</h2>
                <?php
                $realQuery = $database->prepare('SELECT DISTINCT movieHasPerson.idPerson, person.firstname, person.lastname, picture.path
                                                            FROM person, movieHasPerson, personHasPicture, picture
                                                            WHERE person.id = movieHasPerson.idPerson
									                        AND movieHasPerson.role = "director"
									                        AND person.id = personHasPicture.idPerson
									                        AND personHasPicture.idPicture = picture.id');
                $realQuery->execute();
                while ($real = $realQuery->fetch()) {
                    ?>
                    <figure>
                        <a href="<?php echo 'director/infoDirector.php?id=' . $real['idPerson'] ?>">
                            <figcaption><?php echo $real['firstname'] . ' ' . $real['lastname']?></figcaption>
                            <img src="<?php echo $real['path']; ?>" alt="" />
                        </a>
                    </figure>
                    <?php
                }
                ?>

				<h2>Liste des acteurs</h2>
                <?php
                $actorsQuery = $database->prepare('SELECT DISTINCT movieHasPerson.idPerson, person.firstname, person.lastname, picture.path
                                                              FROM person, movieHasPerson, personHasPicture, picture
                                                              WHERE person.id = movieHasPerson.idPerson
                                                              AND movieHasPerson.role = "actor"
                                                              AND person.id = personHasPicture.idPerson
                                                              AND personHasPicture.idPicture = picture.id');
                $actorsQuery->execute();
                while ($actor = $actorsQuery->fetch()) {
                    ?>
                    <figure>
                        <a href="<?php echo 'actor/infoActor.php?id=' . $actor['idPerson'] ?>">
                            <figcaption><?php echo $actor['firstname'] . ' ' . $actor['lastname']?></figcaption>
                            <img src="<?php echo $actor['path']; ?>" alt="" />
                        </a>
                    </figure>
                    <?php
                }
                ?>
			</article>
		</section>
	</main>

    <?php
        getBlock('footer');
    ?>

</body>
</html>