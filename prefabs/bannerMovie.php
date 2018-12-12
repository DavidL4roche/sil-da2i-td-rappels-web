<section class="sectionHeader" style="background: linear-gradient(to left, transparent, black), url('<?= $data->getPath() ?>');
                                      background-size: cover;
                                      background-position: center;">
    <article class="texteTopHeader">
        <h1><?= $data->getTitle() ?></h1>
        <p><time datetime="2017-10-04">(<?= date("Y", strtotime($data->getReleaseDate())) ?>)</time><p>
    </article>
    <div class="texteBackHeader">
        <p class="note"><?= $data->getRating() ?>/10</p>
    </div>
</section>