<?php
    $movie = $data[0];
    $background = $data[1];
?>

<section class="sectionHeader" style="background: linear-gradient(to left, transparent, black), url('<?= $background->getPath() ?>');
                                      background-size: cover;
                                      background-position: center;">
    <article class="texteTopHeader">
        <h1><?= $movie->getTitle() ?></h1>
        <p><time datetime="2017-10-04">(<?= date("Y", strtotime($movie->getReleaseDate())) ?>)</time><p>
    </article>
    <div class="texteBackHeader">
        <p class="note"><?= $movie->getRating() ?>/10</p>
    </div>
</section>