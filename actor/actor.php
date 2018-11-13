<?php
    require '../prefabs/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <?php
        getBlock('head');
    ?>
</head>
<body>

    <?php
        getBlock('header');
    ?>
	
	<main>
        <section>
            <article class="profils">
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
                            <a href="<?php echo 'infoActor.php?id=' . $actor['idPerson'] ?>">
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