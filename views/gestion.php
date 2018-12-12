<?php
    $movies = $data[0];
    $actors = $data[1];
    $directors = $data[2];
    $images = $data[3];
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
        <h1 id="titleSup">Suppression</h1>
        <table>
            <tr>
                <th>Film</th>
                <td>
                    <form method="post" class="btnGestion">
                        <SELECT name="movieDelete" size="1">
                            <?php
                            foreach ($movies as $movie) {
                                echo '<OPTION value="'.$movie->getId().'">' . $movie->getTitle() . '</OPTION>';
                            }
                            ?>
                        </SELECT>
                </td>
                <td>
                    <div class="btnGestion"><input type="submit" name="deleteMovie" value="Supprimer"></div>
                    </form>
                </td>
            </tr>

            <tr>
                <th>Acteur</th>
                <td>
                    <form method="post" class="btnGestion">
                        <SELECT name="actorDelete">
                            <?php
                            foreach ($actors as $actor) {
                                echo '<OPTION value="'.$actor->getId().'">' . $actor->getFirstName() . " " . $actor->getLastName() . '</OPTION>';
                            }
                            ?>
                        </SELECT>
                </td>
                <td>
                    <div class="btnGestion"><input type="submit" name="deleteActor" value="Supprimer"></div>
                    </form>
                </td>
            </tr>
            <tr>
                <th>Réalisateur</th>
                <td>
                    <form method="post" class="btnGestion">
                        <SELECT name="directorDelete">
                            <?php
                            foreach ($directors as $director) {
                                echo '<OPTION value="'.$director->getId().'">' . $director->getFirstName() . " " . $director->getLastName() . '</OPTION>';
                            }
                            ?>
                        </SELECT>
                </td>
                <td>
                    <div class="btnGestion"><input type="submit" name="deleteDirector" value="Supprimer"></div>
                    </form>
                </td>
            </tr>
        </table>
    </section>

    <section>
        <h1 id="titleAjout">Ajout</h1>
        <table>
            <tr>
                <th>Film</th>
                <td>
                    <form method="post" class="btnAjouter">
                        <div>Choisir un titre</div>
                        <input name="movieTitle" placeholder="Exemple : Le Roi Lion">

                        <div>Choisir une date de sortie</div>
                        <input name="movieReleaseDate" type="date" />

                        <div>Rédiger un synopsis</div>
                        <textarea name="movieSynopsis" placeholder="C'est l'histoire .."></textarea>

                        <div>Choisir une note</div>
                        <input name="movieRating" type="number" step="0.1" max="10" placeholder="Note sur 10"></input>
                </td>
                <td>
                    <div class="btnAjouter"><input type="submit" name="addMovie" value="Ajouter"></div>
                    </form>
                </td>
            </tr>

            <tr>
                <th>Personne</th>
                <td>
                    <form method="post" class="btnAjouter">
                        <div>Choisir un nom</div>
                        <input name="personFirstname" placeholder="Exemple : Bertin">

                        <div>Choisir un prénom</div>
                        <input name="personLastname" placeholder="Exemple : Joe">

                        <div>Choisir une date de naissance</div>
                        <input name="personBirthdate" type="date" />

                        <div>Rédiger une biographie</div>
                        <textarea name="personBiography" placeholder="C'est l'histoire .."></textarea>
                </td>
                <td>
                    <div class="btnAjouter"><input type="submit" name="addPerson" value="Ajouter"></div>
                    </form>
                </td>
            </tr>

            <tr>
                <th>Image</th>
                <td>
                    <form method="post" class="btnAjouter">
                        <div>Choisir un lien</div>
                        <input name="imagePath">

                        <div>Choisir une légende</div>
                        <input name="imageLegend" placeholder="Exemple : Photo Ryan Gosling">
                </td>
                <td>
                    <div class="btnAjouter"><input type="submit" name="addImage" value="Ajouter"></div>
                    </form>
                </td>
            </tr>
        </table>
    </section>

    <section>
        <h1 id="titleLiaison">Liaison</h1>
        <table>
            <tr>
                <th>Film - Personne</th>
                <td>
                    <form method="post" class="btnLiaison">
                        <div>Choisir un film</div>
                        <SELECT name="movieLiaisonPerson" size="1">
                            <?php
                            foreach ($movies as $movie) {
                                echo '<OPTION value="'.$movie->getId().'">' . $movie->getTitle() . '</OPTION>';
                            }
                            ?>
                        </SELECT>

                        <div>Choisir la personne liée</div>
                        <SELECT name="personLiaisonMovie">
                            <?php
                            foreach ($actors as $actor) {
                                echo '<OPTION value="'.$actor->getId().'">' . $actor->getFirstName() . " " . $actor->getLastName() . '</OPTION>';
                            }
                            ?>
                        </SELECT>

                        <div>Choisir le rôle de la personne</div>
                        <SELECT name="rolePerson">
                                <OPTION value="actor">Acteur</OPTION>
                                <OPTION value="director">Réalisateur</OPTION>
                        </SELECT>
                </td>
                <td>
                    <div class="btnLiaison"><input type="submit" name="moviePersonLiaison" value="Lier"></div>
                    </form>
                </td>
            </tr>

            <tr>
                <th>Personne - Image</th>
                <td>
                    <form method="post" class="btnLiaison">
                        <div>Choisir une image</div>
                        <SELECT name="imageLiaisonPerson" size="1">
                            <?php
                            foreach ($images as $image) {
                                echo '<OPTION value="'.$image->getId().'">' . $image->getLegend() . '</OPTION>';
                            }
                            ?>
                        </SELECT>

                        <div>Choisir la personne liée</div>
                        <SELECT name="personLiaisonImage">
                            <?php
                            foreach ($actors as $actor) {
                                echo '<OPTION value="'.$actor->getId().'">' . $actor->getFirstName() . " " . $actor->getLastName() . '</OPTION>';
                            }
                            ?>
                        </SELECT>
                </td>
                <td>
                    <div class="btnLiaison"><input type="submit" name="personImageLiaison" value="Lier"></div>
                    </form>
                </td>
            </tr>

            <tr>
                <th>Film - Image</th>
                <td>
                    <form method="post" class="btnLiaison">
                        <div>Choisir un film</div>
                        <SELECT name="movieLiaisonImage" size="1">
                            <?php
                            foreach ($movies as $movie) {
                                echo '<OPTION value="'.$movie->getId().'">' . $movie->getTitle() . '</OPTION>';
                            }
                            ?>
                        </SELECT>

                        <div>Choisir une image</div>
                        <SELECT name="imageLiaisonMovie" size="1">
                            <?php
                            foreach ($images as $image) {
                                echo '<OPTION value="'.$image->getId().'">' . $image->getLegend() . '</OPTION>';
                            }
                            ?>
                        </SELECT>

                        <div>Choisir le type de l'image</div>
                        <SELECT name="typeImage">
                            <OPTION value="affiche">Affiche</OPTION>
                            <OPTION value="poster">Image</OPTION>
                            <OPTION value="gallery">Fond d'écran</OPTION>
                        </SELECT>
                </td>
                <td>
                    <div class="btnLiaison"><input type="submit" name="movieImageLiaison" value="Lier"></div>
                    </form>
                </td>
            </tr>
        </table>
    </section>
</main>

<?php
getBlock('prefabs/footer');
?>

</body>
</html>