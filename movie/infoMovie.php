<?php
    require '../prefabs/config.php';

    $idMovie = filter_input(INPUT_GET, 'id');
    $movieQuery = $database->prepare('SELECT * 
                                                 FROM movie, movieHasPicture, picture
                                                 WHERE movie.id = ?
                                                 AND movie.id = movieHasPicture.idMovie
                                                 AND movieHasPicture.idPicture = picture.id
                                                 AND movieHasPicture.type = "gallery"');
    $movieQuery->execute(array($idMovie));
    $movie = $movieQuery->fetch();

    $directorQuery = $database->prepare('SELECT * 
                                                    FROM movieHasPerson, person
                                                    WHERE movieHasPerson.idPerson = person.id
                                                    AND movieHasPerson.idMovie = ?
                                                    AND movieHasPerson.role = "director"');
    $directorQuery->execute(array($idMovie));
    $director = $directorQuery->fetch();

    $actorQuery = $database->prepare('SELECT *
                                                  FROM movieHasPerson, person
                                                  WHERE movieHasPerson.idPerson = person.id
                                                  AND movieHasPerson.idMovie = ?
                                                  AND movieHasPerson.role = "actor"');
    $actorQuery->execute(array($idMovie));
    //$actors = $actorsQuery->fetch();

    //$actors

    //$images
?>

<!DOCTYPE html>
<html>
<?php
    getBlock('head');
?>

<body>

    <?php
        getBlock('header');
        getBlock('bannerMovie', $movie);
    ?>

	<main>
		<section>
			<article>
				<p class="desc1">Film de <a class="presDirector" href="../director/infoDirector.php?id=<?= $director['idPerson'] ?>"><?= $director['firstname'] . ' '
                         . $director['lastname']?></a> - <?= date('d/m/Y', strtotime($movie['releaseDate']))?></p>
				<p>Avec
                    <?php
                        while ($actor = $actorQuery->fetch()) {
                            ?>
                            <a class="presActor" href="../actor/infoActor.php?id=<?= $actor['idPerson'] ?>"><?= $actor['firstname'] . ' ' . $actor['lastname'] ?></a>,
                            <?php
                        }
                    ?>
                </p>
			</article>
			
			<article>
				<p><?= $movie['synopsis'] ?></p>
			</article>
			
			<article class="profils">
				<h2>Réalisateur</h2>

                <?php
                $realQuery = $database->prepare('SELECT *
                                                            FROM person, movieHasPerson, personHasPicture, picture
                                                            WHERE person.id = movieHasPerson.idPerson
                                                            AND movieHasPerson.idMovie = ?
                                                            AND movieHasPerson.role = "director"
                                                            AND person.id = personHasPicture.idPerson
                                                            AND personHasPicture.idPicture = picture.id');
                $realQuery->execute(array($idMovie));
                $real = $realQuery->fetch()
                ?>
                <figure>
                    <a href="<?php echo '../director/infoDirector.php?id=' . $real['idPerson'] ?>">
                        <figcaption><?php echo $real['firstname'] . ' ' . $real['lastname']?></figcaption>
                        <img src="<?php echo $real['path']; ?>" alt="" />
                    </a>
                </figure>
                <?php
                ?>
				
				<h2>Casting : Acteurs principaux</h2>
                <?php
                $actorsQuery = $database->prepare('SELECT *
                                                                  FROM person, movieHasPerson, personHasPicture, picture
                                                                  WHERE person.id = movieHasPerson.idPerson
                                                                  AND movieHasPerson.idMovie = ?
									                              AND movieHasPerson.role = "actor"
									                              AND person.id = personHasPicture.idPerson
									                              AND personHasPicture.idPicture = picture.id');
                $actorsQuery->execute(array($idMovie));
                while ($actor = $actorsQuery->fetch()) {
                    ?>
                    <figure>
                        <a href="<?php echo '../actor/infoActor.php?id=' . $actor['idPerson'] ?>">
                            <figcaption><?php echo $actor['firstname'] . ' ' . $actor['lastname']?></figcaption>
                            <img src="<?php echo $actor['path']; ?>" alt="" />
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
                $imagesQuery = $database->prepare('SELECT *
                                                              FROM movieHasPicture, picture
                                                              WHERE movieHasPicture.idPicture = picture.id
                                                              AND movieHasPicture.idMovie = ?
                                                              AND movieHasPicture.type = "poster"');
                $imagesQuery->execute(array($idMovie));
                while ($image = $imagesQuery->fetch()) {
                    ?>
                    <img src="<?= $image['path'] ?>" alt="" />
                    <?php
                }
                ?>
			</aside> 			
		</section>
	</main>
	
    <?php
        getBlock('footer');
    ?>

</body>
</html>