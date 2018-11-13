<?php
    require '../prefabs/config.php';

    $idMovie = filter_input(INPUT_GET, 'id');
    $movieQuery = $database->prepare('SELECT * FROM movie WHERE id = ?');
    $movieQuery->execute(array($idMovie));
    $movie = $movieQuery->fetch();
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
				<p class="desc1">Film de <a class="presDirector" href="../director/director.php">Denis Villeneuve</a> - Science-fiction et film noir - 2 h 44 min - 4 octobre 2017</p>
				<p>Avec <a class="presActor" href="../actor/actor.php">Ryan Gosling</a>, <a class="presActor" href="../actor/actor.php">Harrison Ford</a>
				, <a class="presActor" href="../actor/actor.php">Jared Leto</a></p>
			</article>
			
			<article>
				<p>En 2049, la société est fragilisée par les nombreuses 
				tensions entre les humains et leurs esclaves créés par bioingénierie. 
				L’officier K est un Blade Runner : il fait partie d’une force d’intervention 
				d’élite chargée de trouver et d’éliminer ceux qui n’obéissent pas aux ordres
				 des humains. Lorsqu’il découvre un secret enfoui depuis longtemps et capable 
				 de changer le monde, les plus hautes instances décident que c’est à son tour 
				 d’être traqué et éliminé. Son seul espoir est de retrouver Rick Deckard, un 
				 ancien Blade Runner qui a disparu depuis des décennies...</p>
			</article>
			
			<article class="profils">
				<h2>Réalisateur</h2>
				<figure>
					<figcaption>Denis Villeneuve</figcaption>
					<img src="../img/Denis_Villeneuve.jpg" alt="" />
				</figure>				
				
				<h2>Casting : Acteurs principaux</h2>
				<figure>
					<figcaption>Ryan Gosling</figcaption>
					<img src="../img/Ryan_Gosling.jpg" alt="" />
				</figure>
				<figure>
					<figcaption>Harrison Ford</figcaption>
					<img src="../img/Harrison_Ford.jpg" alt="" />
				</figure>
				<figure>
					<figcaption>Jared Leto</figcaption>
					<img src="../img/Jared_Leto.jpg" alt="" />
				</figure>
				<figure>
					<figcaption>Ana de Armas</figcaption>
					<img src="../img/Ana_de_Armas.jpg" alt="" />
				</figure>
				<figure>
					<figcaption>Dave Bautista</figcaption>
					<img src="../img/Dave_Bautista.jpg" alt="" />
				</figure>
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
				<img src="../img/2.jpg" alt="" />
				<img src="../img/3.jpg" alt="" />
			</aside> 			
		</section>
	</main>
	
    <?php
        getBlock('footer');
    ?>

</body>
</html>