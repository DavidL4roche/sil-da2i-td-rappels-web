<?php
    require '../prefabs/config.php';
?>

<!DOCTYPE html>
<html>
<?php
    getBlock('head');
?>
<body>

    <?php
        getBlock('header');
    ?>
	
	<main>
		<section>
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
                        <a href="<?php echo 'infoDirector.php?id=' . $real['idPerson'] ?>">
                            <figcaption><?php echo $real['firstname'] . ' ' . $real['lastname']?></figcaption>
                            <img src="<?php echo $real['path']; ?>" alt="" />
                        </a>
                    </figure>
                    <?php
                }
                ?>
            </article>
		</section>
	</main>
	
	<footer>
		<p><a href="https://www.joebertin.fr">David LAROCHE</a></p>
	</footer>
	
</body>
</html>